<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\ProjectTaskArchive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::with('projects')->get();
        return response()->json($tasks);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id'
        ]);

        $task = Task::create($request->only('name', 'description', 'start_date', 'due_date'));
        $task->projects()->attach($request->project_id);

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    public function archive($id)
    {
        $task = Task::findOrFail($id);
        $project = $task->projects()->first();

        DB::table('project_task_archive')->insert([
            'name' => $task->name,
            'description' => $task->description,
            'start_date' => $task->start_date,
            'due_date' => $task->due_date,
            'original_project_id' => $project ? $project->id : null,
            'archived_by' => Auth::id(),
            'archived_at' => Carbon::now(),
        ]);

        $task->projects()->detach();
        $task->delete();

        return response()->json(['message' => 'Task archived successfully']);
    }

    public function restore($id)
    {
        $archivedTask = DB::table('project_task_archive')->where('id', $id)->first();

        if (!$archivedTask) {
            return response()->json(['message' => 'Archived task not found'], 404);
        }

        $task = Task::create([
            'name' => $archivedTask->name,
            'description' => $archivedTask->description,
            'start_date' => $archivedTask->start_date,
            'due_date' => $archivedTask->due_date,
        ]);

        if ($archivedTask->original_project_id) {
            $task->projects()->attach($archivedTask->original_project_id);
        }

        DB::table('project_task_archive')->where('id', $id)->delete();

        return response()->json(['message' => 'Task restored successfully']);
    }

    public function archived(Request $request)
    {
        $projectId = $request->input('original_project_id');

        $archivedTasks = DB::table('project_task_archive')
            ->where('original_project_id', $projectId)
            ->get();

        return response()->json($archivedTasks);
    }

}

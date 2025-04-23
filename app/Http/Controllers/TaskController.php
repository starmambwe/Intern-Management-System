<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\ProjectTaskArchive;
use App\Models\TaskLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $query = Task::with('projects');
        
        // Filter by project if project_id is provided
        if ($request->has('project_id')) {
            $query->whereHas('projects', function($q) use ($request) {
                $q->where('projects.id', $request->project_id);
            });
        }
        
        $tasks = $query->get();
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

    /**
     * Store a new log for a task (intern, supervisor, or admin)
     */
    public function storeLog(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'project_id' => 'required|exists:projects,id',
            'log_text' => 'required|string',
        ]);

        $user = Auth::user();
        // Optionally: check if user is allowed to log for this task/project

        $log = TaskLog::create([
            'user_id' => $user->id,
            'task_id' => $request->task_id,
            'project_id' => $request->project_id,
            'log_text' => $request->log_text,
        ]);

        return response()->json(['message' => 'Log submitted', 'log' => $log->load('user')], 201);
    }

    /**
     * Get all logs for a given task (optionally filtered by project)
     */
    public function getLogs(Request $request, $task_id)
    {
        $query = TaskLog::with(['user'])
            ->where('task_id', $task_id);
        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }
        $logs = $query->orderBy('created_at', 'asc')->get();
        return response()->json($logs);
    }

}
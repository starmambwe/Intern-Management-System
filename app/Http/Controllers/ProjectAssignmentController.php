<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectAssignmentController extends Controller
{
    /**
     * Get all projects for dropdown
     */
    public function getProjects()
    {
        return response()->json(
            Project::select('id', 'name')->get()
        );
    }

    /**
     * Get all users with supervisor role
     */
    public function getSupervisors()
    {
        return response()->json(
            User::whereHas('roles', fn($q) => $q->where('name', 'supervisor'))
                ->select('id', 'name')
                ->get()
        );
    }

    /**
     * Get all users with intern role
     */
    public function getInterns()
    {
        return response()->json(
            User::whereHas('roles', fn($q) => $q->where('name', 'intern'))
                ->select('id', 'name')
                ->get()
        );
    }

    /**
     * Get all project assignments with supervisors and interns
     * Now includes tasks assigned to interns
     */
    public function getAssignments()
    {
        return response()->json(
            Project::with(['supervisors', 'interns'])->get()
                ->map(function($project) {
                    return [
                        'id' => $project->id,
                        'project_name' => $project->name,
                        'supervisors' => $project->supervisors,
                        'interns' => $project->interns->map(function($intern) use ($project) {
                            // Load tasks assigned to this intern for this project
                            $tasks = DB::table('project_task_user')
                                ->join('project_task', 'project_task_user.project_task_id', '=', 'project_task.id')
                                ->join('tasks', 'project_task.task_id', '=', 'tasks.id')
                                ->where('project_task.project_id', $project->id)
                                ->where('project_task_user.user_id', $intern->id)
                                ->select('tasks.id', 'tasks.name')
                                ->get();
                            
                            return [
                                'id' => $intern->id,
                                'name' => $intern->name,
                                'tasks' => $tasks
                            ];
                        })
                    ];
                })
        );
    }

    /**
     * Create new project assignment
     * Now handles task assignments for interns
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:supervisor,intern',
            'task_ids' => 'nullable|string' // Comma-separated list of task IDs
        ]);

        DB::transaction(function () use ($request) {
            // Assign user to project (original functionality)
            $project = Project::find($request->project_id);
            $project->users()->syncWithoutDetaching([
                $request->user_id => ['role' => $request->role]
            ]);

            // For interns, handle task assignments
            if ($request->role === 'intern' && $request->task_ids) {
                $taskIds = explode(',', $request->task_ids);
                
                // Get all project_task IDs for these tasks
                $projectTaskIds = DB::table('project_task')
                    ->where('project_id', $request->project_id)
                    ->whereIn('task_id', $taskIds)
                    ->pluck('id');

                // Create entries in project_task_user
                foreach ($projectTaskIds as $projectTaskId) {
                    DB::table('project_task_user')->updateOrInsert(
                        [
                            'project_task_id' => $projectTaskId,
                            'user_id' => $request->user_id
                        ],
                        ['created_at' => now(), 'updated_at' => now()]
                    );
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Assignment created successfully!'
        ]);
    }

    /**
     * Remove project assignment
     * Now also removes task assignments for interns
     */
    public function destroy(Request $request, $projectId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:supervisor,intern'
        ]);

        DB::transaction(function () use ($request, $projectId) {
            // Remove user from project (original functionality)
            Project::find($projectId)->users()
                ->wherePivot('role', $request->role)
                ->detach($request->user_id);

            // For interns, also remove task assignments
            if ($request->role === 'intern') {
                $projectTaskIds = DB::table('project_task')
                    ->where('project_id', $projectId)
                    ->pluck('id');

                DB::table('project_task_user')
                    ->whereIn('project_task_id', $projectTaskIds)
                    ->where('user_id', $request->user_id)
                    ->delete();
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Assignment removed successfully!'
        ]);
    }

    /**
     * New method to get tasks assigned to an intern for a project
     */
    public function getInternTasks(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $tasks = DB::table('project_task_user')
            ->join('project_task', 'project_task_user.project_task_id', '=', 'project_task.id')
            ->join('tasks', 'project_task.task_id', '=', 'tasks.id')
            ->where('project_task.project_id', $request->project_id)
            ->where('project_task_user.user_id', $request->user_id)
            ->select('tasks.id', 'tasks.name', 'tasks.due_date')
            ->get();

        return response()->json($tasks);
    }
}
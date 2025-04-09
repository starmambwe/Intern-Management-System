<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

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
                        'interns' => $project->interns
                    ];
                })
        );
    }

    /**
     * Create new project assignment
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:supervisor,intern'
        ]);

        $project = Project::find($request->project_id);
        $project->users()->syncWithoutDetaching([
            $request->user_id => ['role' => $request->role]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Assignment created successfully!'
        ]);
    }

    /**
     * Remove project assignment
     */
    public function destroy(Request $request, $projectId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:supervisor,intern'
        ]);

        Project::find($projectId)->users()
            ->wherePivot('role', $request->role)
            ->detach($request->user_id);

        return response()->json([
            'success' => true,
            'message' => 'Assignment removed successfully!'
        ]);
    }
}
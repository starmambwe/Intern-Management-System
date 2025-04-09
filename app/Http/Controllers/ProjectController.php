<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectsArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Get all projects (for table)
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    // Get archived projects
    public function archived()
    {
        try {
            $archivedProjects = ProjectsArchive::all(); // Fetch all archived projects
            return response()->json($archivedProjects);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Archive a project (soft delete + move to archive)
    // Archive method
    public function archive($id)
    {
        $project = Project::findOrFail($id);
        
        ProjectsArchive::create([
            'name' => $project->name,
            'description' => $project->description,
            'start_date' => $project->start_date,
            'end_date' => $project->end_date,
            'archived_by' => Auth::user()->id,
            'archived_at' => now()
        ]);

        $project->delete();

        return response()->json(['success' => true, 'message' => 'Project archived!']);
    }

    // View archived project method
    public function showArchived($id)
    {
        $project = ProjectsArchive::with(['archivedBy.roles'])->findOrFail($id);
        
        return response()->json([
            'name' => $project->name,
            'description' => $project->description,
            'duration' => $project->duration,
            'archived_by' => [
                'name' => $project->archivedBy->name,
                'role' => $project->archivedBy->roles->first()->name ?? 'N/A'
            ],
            'archived_at' => $project->archived_at->format('Y-m-d H:i:s')
        ]);
    }

    // Restore from archive
    public function restore($id)
    {
        $archivedProject = ProjectsArchive::findOrFail($id);
        
        // Copy back to projects table
        Project::create([
            'name' => $archivedProject->name,
            'description' => $archivedProject->description,
            'start_date' => $archivedProject->start_date,
            'end_date' => $archivedProject->end_date,
        ]);

        // Delete from archive
        $archivedProject->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project restored!'
        ]);
    }

    // Create/Update project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        $project = Project::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );

        return response()->json([
            'success' => true,
            'project' => $project,
            'message' => $request->id ? 'Project updated!' : 'Project created!'
        ]);
    }

    // Delete project
    public function destroy($id)
    {
        Project::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'Project deleted!']);
    }


    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }
}

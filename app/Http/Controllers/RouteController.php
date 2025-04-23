<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RouteController extends Controller
{
    //
    public function loadPageIntoElement(Request $request)
    {
        $page = $request->input('viewUrl');

        Log::info("Requested view: $page");

        switch ($page) {
            case 'admin.manageUsers':
                $users = User::with('roles')->get(); // Eager load roles
                $roles = Role::all();
                return view($page, compact('users', 'roles'));


            case 'admin.assignSupervisors':
                $currentUser = Auth::check() ? User::find(Auth::id())->load('roles') : null;
                $roles = Role::all();
                $roleNames = $currentUser ? $currentUser->roles->pluck('name')->toArray() : [];
                $isAdmin = in_array('Admin', $roleNames);
                $isSupervisor = in_array('Supervisor', $roleNames);
                $isIntern = in_array('Intern', $roleNames);

                if ($isAdmin) {
                    $users = User::with('roles')->get();
                    $viewType = 'Admin';
                } elseif ($isSupervisor) {
                    $users = User::with('roles')->get(); // or filter as needed
                    $viewType = 'Supervisor';
                } elseif ($isIntern) {
                    // Get all projects where this user is assigned as intern
                    $assignedProjects = \DB::table('project_user')
                        ->where('user_id', $currentUser->id)
                        ->where('role', 'Intern')
                        ->pluck('project_id');

                    $projects = \App\Models\Project::whereIn('id', $assignedProjects)->get();

                    // Structure: project_id => [project, supervisors, tasks]
                    $internProjects = [];
                    foreach ($projects as $project) {
                        // Supervisors for this project
                        $supervisorIds = \DB::table('project_user')
                            ->where('project_id', $project->id)
                            ->where('role', 'Supervisor')
                            ->pluck('user_id');
                        $supervisors = \App\Models\User::whereIn('id', $supervisorIds)->get();

                        // Tasks assigned to this intern for this project
                        $taskIds = \DB::table('project_task_user')
                            ->join('project_task', 'project_task_user.project_task_id', '=', 'project_task.id')
                            ->where('project_task.project_id', $project->id)
                            ->where('project_task_user.user_id', $currentUser->id)
                            ->pluck('project_task.task_id');
                        $tasks = \App\Models\Task::whereIn('id', $taskIds)->get();

                        $internProjects[$project->id] = [
                            'project' => $project,
                            'supervisors' => $supervisors,
                            'tasks' => $tasks,
                        ];
                    }

                    $viewType = 'Intern';
                    return view('admin.assignSupervisors', compact('internProjects', 'currentUser', 'roles', 'viewType'));
                } else {
                    $users = [];
                    $viewType = 'unknown';
                }

                return view('admin.assignSupervisors', compact('users', 'roles', 'currentUser', 'viewType'));

            case 'supervisor.assignedProjects':
                $currentUser = Auth::check() ? User::find(Auth::id())->load('roles') : null;
                $roles = Role::all();
                $roleNames = $currentUser ? $currentUser->roles->pluck('name')->toArray() : [];
                $isAdmin = in_array('Admin', $roleNames);
                $isSupervisor = in_array('Supervisor', $roleNames);
                $isIntern = in_array('Intern', $roleNames);

                if ($isAdmin) {
                    $users = User::with('roles')->get();
                    $viewType = 'Admin';
                } elseif ($isSupervisor) {
                    $users = User::with('roles')->get(); // or filter as needed
                    $viewType = 'Supervisor';
                } elseif ($isIntern) {
                    // Get all projects where this user is assigned as intern
                    $assignedProjects = \DB::table('project_user')
                        ->where('user_id', $currentUser->id)
                        ->where('role', 'Intern')
                        ->pluck('project_id');

                    $projects = \App\Models\Project::whereIn('id', $assignedProjects)->get();

                    // Structure: project_id => [project, supervisors, tasks]
                    $internProjects = [];
                    foreach ($projects as $project) {
                        // Supervisors for this project
                        $supervisorIds = \DB::table('project_user')
                            ->where('project_id', $project->id)
                            ->where('role', 'Supervisor')
                            ->pluck('user_id');
                        $supervisors = \App\Models\User::whereIn('id', $supervisorIds)->get();

                        // Tasks assigned to this intern for this project
                        $taskIds = \DB::table('project_task_user')
                            ->join('project_task', 'project_task_user.project_task_id', '=', 'project_task.id')
                            ->where('project_task.project_id', $project->id)
                            ->where('project_task_user.user_id', $currentUser->id)
                            ->pluck('project_task.task_id');
                        $tasks = \App\Models\Task::whereIn('id', $taskIds)->get();

                        $internProjects[$project->id] = [
                            'project' => $project,
                            'supervisors' => $supervisors,
                            'tasks' => $tasks,
                        ];
                    }

                    $viewType = 'Intern';
                    $page = 'admin.assignSupervisors';
                    return view($page, compact('internProjects', 'currentUser', 'roles', 'viewType'));
                } else {
                    $users = [];
                    $viewType = 'unknown';
                }
                $page = 'admin.assignSupervisors';
                return view($page, compact('users', 'roles', 'currentUser', 'viewType'));

            case 'supervisor.createTasks':
                $projects = Project::all();
                $roles = Role::all();
                $currentUser = Auth::check() ? User::find(Auth::id())->load('roles') : null;
                return view($page, compact('projects', 'roles', 'currentUser'));
                
            default:
                return view($page);
        }
    }
}

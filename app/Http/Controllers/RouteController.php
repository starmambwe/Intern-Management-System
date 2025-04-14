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
                $users = User::with('roles')->get(); // Eager load roles
                $roles = Role::all();
                $currentUser = Auth::check() ? User::find(Auth::id())->load('roles') : null;
                $page = 'admin.assignSupervisors';
                return view($page, compact('users', 'roles', 'currentUser'));

            case 'supervisor.assignedProjects':
                $users = User::with('roles')->get(); // Eager load roles
                $roles = Role::all();
                $currentUser = Auth::check() ? User::find(Auth::id())->load('roles') : null;
                $page = 'admin.assignSupervisors';
                return view($page, compact('users', 'roles', 'currentUser'));

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

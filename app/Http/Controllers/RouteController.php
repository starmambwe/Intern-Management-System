<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //
    public function loadPageIntoElement(Request $request)
    {
        $page = $request->input('viewUrl');

        switch ($page) {
            case 'admin.manageUsers':
                $users = User::with('roles')->get(); // Eager load roles
                $roles = Role::all();
                return view($page, compact('users', 'roles'));

            default:
                return view($page);
        }
    }
}

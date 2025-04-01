<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //
    public function loadPageIntoElement(Request $request)
    {
        $page = $request->input('viewUrl');

        switch ($page) {
            case 'admin.manageUsers':
                $roles = Role::all(); // Better to use all() instead of get() for simple queries
                return view($page, compact('roles')); // compact() is cleaner for simple arrays

            default:
                return view($page);
        }
    }
}

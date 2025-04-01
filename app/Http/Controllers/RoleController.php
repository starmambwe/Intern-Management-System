<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'role' => $role,
            'message' => 'Role created successfully!'
        ]);
    }
}

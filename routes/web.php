<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController; // Import RouteController


Route::get('/', function () {
    if (Auth::check()) {
        return view('welcome'); // Authenticated users see 'welcome' page
    } else {
        return redirect('/login'); // Unauthenticated users go to login
    }
});


// Login Page Route
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/loadPageIntoElement', [RouteController::class, 'loadPageIntoElement'])->name('loadPageIntoElement');

Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');

// In your routes/web.php file
Route::post('/users', [UserController::class, 'store'])->name('saveUser');

Route::get('/users', [UserController::class, 'store'])->name('saveUser');

// Get user's current roles
Route::get('/users/{user}/roles', [UserController::class, 'getRoles'])
    ->name('users.roles.get');

// Update user's roles
Route::put('/users/{user}/roles', [UserController::class, 'updateRoles'])
    ->name('users.roles.update');


// Projects routes
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');  
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects_archive', [ProjectController::class, 'archived'])->name('projects.archived');
Route::post('/projects_archive/{id}', [ProjectController::class, 'archive'])->name('projects.archive');
Route::post('/projects/restore/{id}', [ProjectController::class, 'restore'])->name('projects.restore');
Route::get('/projects_archive/{id}', [ProjectController::class, 'showArchived'])->name('projects.archive.show');
Route::post('projects/archive/{id}', [ProjectController::class, 'archive']);
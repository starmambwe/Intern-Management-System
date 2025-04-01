<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

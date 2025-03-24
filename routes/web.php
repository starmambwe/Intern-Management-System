<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

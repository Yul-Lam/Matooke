<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\HarvestBatchController;
use App\Models\HarvestBatch;



Route::resource('harvest-batches', HarvestBatchController::class);
Route::get('/dashboard', function () {
    $harvestBatches = HarvestBatch::with('coffeeGrade')->get();
    return view('dashboard', compact('harvestBatches'));
});



// Show login page

Route::get('/', function () {
    return redirect('/admin-dashboard');
});

// Handle login form submission
Route::post('/login', [LoginController::class, 'login'])->name('login');



// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/forgot-password', function () {
    return view('auth.forgot-password'); // Create this view if needed
})->name('password.request');

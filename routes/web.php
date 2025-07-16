<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HarvestBatchController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\CoffeeGradeController;

// Home page (if needed)
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (optional if using Laravel Breeze or Jetstream)
Auth::routes();

// Protected routes (must be logged in and verified)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // ✅ Cooperative Dashboard
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    // ✅ Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Harvest Batch Routes
    Route::resource('harvest-batches', HarvestBatchController::class);

    // ✅ Optional: Farm Profiles
    Route::get('/farms/{farm}', [FarmController::class, 'show'])->name('farms.show');

    // ✅ Optional: Grade View
    Route::get('/grades/{grade}', [CoffeeGradeController::class, 'show'])->name('grades.show');
});
=======

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\SupplyController;

Route::resource('supplies', SupplyController::class); 


>>>>>>> 1b843c810ec3fd48d1bd3bcd733da4568b6c576f

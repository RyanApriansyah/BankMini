<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanage:user'])->name('dashboard');

Route::get('/officer/dashboard', function () {
    return view('Officer/officer');
})->middleware(['auth', 'verified', 'rolemanage:officer'])->name('Officer/officer');

Route::get('/admin/dashboard', function () {
    return view('Admin/admin');
})->middleware(['auth', 'verified', 'rolemanage:admin'])->name('Admin/admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

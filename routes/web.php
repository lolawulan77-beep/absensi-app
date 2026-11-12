<?php

use App\Http\Controllers\Admin\AttendanceController as AdminAttendance;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AttendanceController::class, 'index'])->name('dashboard');
    Route::post('/absen/masuk', [AttendanceController::class, 'masuk'])->name('absen.masuk');
    Route::post('/absen/pulang', [AttendanceController::class, 'pulang'])->name('absen.pulang');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/absensi', [AdminAttendance::class, 'index'])->name('absensi');
});

require __DIR__ . '/auth.php';
Route::get('/whoami', fn () => auth()->user()
    ? auth()->user()->only('name', 'email', 'role')
    : 'belum login');

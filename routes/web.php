<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/alumni', [ProfileController::class, 'updateAlumni'])
    ->name('profile.update.alumni');

});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
         Route::resource('alumni', AlumniController::class);

});



Route::middleware(['auth', 'role:alumni'])->name('alumni.')->group(function () {
    Route::resource('loker', LokerController::class);
});


Route::middleware('auth')->group(function () {
        Route::get('/notifications', [NotificationController::class, 'list'])->name('notifications.list');
        Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');
        Route::resource('loker', LokerController::class);


});


require __DIR__.'/auth.php';

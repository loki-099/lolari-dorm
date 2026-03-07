<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\BoarderController;
use App\Http\Controllers\Staff\RoomController;
use App\Http\Controllers\Staff\PaymentController;
use App\Http\Controllers\Staff\ReportsController;
use App\Http\Controllers\Staff\AnalyticsController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
})->middleware('redirect.role');

// AUTH ROUTES
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// ADMIN ROUTES
Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('admin.dashboard');

// STAFF ROUTES
Route::middleware(['auth', 'check.staff.role'])->prefix('staff')->name('staff.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Boarders
    Route::resource('/boarders', BoarderController::class);

    // Rooms
    Route::resource('/rooms', RoomController::class)->except('update');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::get('/rooms/assign/form', [RoomController::class, 'assignForm'])->name('rooms.assign-form');
    Route::post('/rooms/assign', [RoomController::class, 'assign'])->name('rooms.assign')->middleware('permission:assign-room');

    // Payments (Read-only for staff)
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store')->middleware('permission:process-payment');
    Route::get('/payments/{transaction}', [PaymentController::class, 'show'])->name('payments.show');

    // Reports
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index')->middleware('permission:view-basic-analytics');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index')->middleware('permission:view-basic-analytics');
});


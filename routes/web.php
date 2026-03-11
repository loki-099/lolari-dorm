<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\BoarderController;
use App\Http\Controllers\Staff\RoomController;
use App\Http\Controllers\Staff\PaymentController;
use App\Http\Controllers\Staff\ReportsController;
use App\Http\Controllers\Staff\AnalyticsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Boarder\BoarderDashboardController;

Route::get('/', function () {
    return view('welcome');
})->middleware('redirect.role')->name('home');

// AUTH ROUTES
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// ADMIN ROUTES
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Boarders
    Route::resource('/boarders', App\Http\Controllers\Admin\BoarderController::class);

    // Rooms
    Route::resource('/rooms', App\Http\Controllers\Staff\RoomController::class)->except('update');
    Route::put('/rooms/{room}', [App\Http\Controllers\Staff\RoomController::class, 'update'])->name('rooms.update');
    Route::get('/rooms/assign/form', [App\Http\Controllers\Staff\RoomController::class, 'assignForm'])->name('rooms.assign-form');
    Route::post('/rooms/assign', [App\Http\Controllers\Staff\RoomController::class, 'assign'])->name('rooms.assign')->middleware('permission:assign-room');
});

// STAFF ROUTES
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Boarders
    Route::resource('/boarders', BoarderController::class);

    // Rooms
    Route::resource('/rooms', RoomController::class)->except('update');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::get('/rooms/assign/form', [RoomController::class, 'assignForm'])->name('rooms.assign-form');
    Route::post('/rooms/assign', [RoomController::class, 'assign'])->name('rooms.assign')->middleware('permission:assign-room');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store')->middleware('permission:process-payment');
    Route::get('/payments/{transaction}', [PaymentController::class, 'show'])->name('payments.show');

    
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index')->middleware('permission:view-basic-analytics');
    
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index')->middleware('permission:view-basic-analytics');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
});

// BOARDER ROUTES
Route::middleware(['auth', 'role:boarder'])->prefix('boarder')->name('boarder.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [BoarderDashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [BoarderDashboardController::class, 'transactions'])->name('transactions');
    Route::get('/sample', [BoarderDashboardController::class, 'sample'])->name('sample');
});

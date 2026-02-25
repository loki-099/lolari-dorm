<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ADMIN ROUTES
Route::get('/admin/dashboard', function() { // Add Middleware in the future
    return view('admin.dashboard');
})->name('admin.dashboard');

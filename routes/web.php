<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RemoveRoleFromUserController;
use App\Http\Controllers\RevokePermissionFromRoleController;
use App\Http\Controllers\RevokePermissionFromUserController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified', 'adminDashboardAccess'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/posts', PostController::class);

    Route::delete('/roles/{role}/permissions/{permission}', RevokePermissionFromRoleController::class)->name('roles.permissions.destroy');
    Route::delete('/users/{user}/permissions/{permission}', RevokePermissionFromUserController::class)->name('users.permissions.destroy');
    Route::delete('/users/{user}/roles/{role}', RemoveRoleFromUserController::class)->name('users.roles.destroy');
});

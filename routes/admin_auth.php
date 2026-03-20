<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;

// Admin Default Route
Route::get('/admin', [App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'create']);

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });

    // Authenticated routes
    Route::middleware('auth:admin')->group(function () {

        // Dashboard Route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Logout Route
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Change Password Route
        Route::get('/change-password', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/change-password', [PasswordController::class, 'update'])->name('password.update');


    });
});

?>
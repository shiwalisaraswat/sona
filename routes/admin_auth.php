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
use App\Http\Controllers\Admin\RoomTypeController;

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

        // Change Password Routes
        Route::get('/change-password', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/change-password', [PasswordController::class, 'update'])->name('password.update');

        // RoomType Routes
        Route::get('/room-types', [RoomTypeController::class, 'index'])->name('room_types.index');
        Route::get('/room-types/create',[RoomTypeController::class, 'create'])->name('room_types.create');
        Route::post('/room-types/store',[RoomTypeController::class, 'store'])->name('room_types.store');
        Route::get('/room-types/edit/{id}',[RoomTypeController::class, 'edit'])->name('room_types.edit');
        Route::put('/room-types/update/{id}',[RoomTypeController::class, 'update'])->name('room_types.update');
        Route::delete('/room-types/destroy/{id}',[RoomTypeController::class, 'destroy'])->name('room_types.destroy');
        Route::post('/room-types/restore/{id}',[RoomTypeController::class, 'restore'])->name('room_types.restore');
        Route::delete('/room-types/force-delete/{id}', [RoomTypeController::class, 'forceDelete'])->name('room_types.force_delete');
        Route::post('/room-types/change-status/{id}',[RoomTypeController::class, 'changeStatus'])->name('room_types.change_status');

    });
});

?>
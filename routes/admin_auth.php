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
use App\Http\Controllers\Admin\RoomTypesController;
use App\Http\Controllers\Admin\RoomsController;

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
        Route::get('/room-types', [RoomTypesController::class, 'index'])->name('room_types.index');
        Route::get('/room-types/create',[RoomTypesController::class, 'create'])->name('room_types.create');
        Route::post('/room-types/store',[RoomTypesController::class, 'store'])->name('room_types.store');
        Route::get('/room-types/edit/{id}',[RoomTypesController::class, 'edit'])->name('room_types.edit');
        Route::put('/room-types/update/{id}',[RoomTypesController::class, 'update'])->name('room_types.update');
        Route::delete('/room-types/destroy/{id}',[RoomTypesController::class, 'destroy'])->name('room_types.destroy');
        Route::post('/room-types/restore/{id}',[RoomTypesController::class, 'restore'])->name('room_types.restore');
        Route::delete('/room-types/force-delete/{id}', [RoomTypesController::class, 'forceDelete'])->name('room_types.force_delete');
        Route::post('/room-types/change-status/{id}',[RoomTypesController::class, 'changeStatus'])->name('room_types.change_status');

        // Room Routes
        Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create',[RoomsController::class, 'create'])->name('rooms.create');
        Route::post('/rooms/store',[RoomsController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/edit/{id}',[RoomsController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/update/{id}',[RoomsController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/destroy/{id}',[RoomsController::class, 'destroy'])->name('rooms.destroy');
        Route::post('/rooms/restore/{id}',[RoomsController::class, 'restore'])->name('rooms.restore');
        Route::delete('/rooms/force-delete/{id}', [RoomsController::class, 'forceDelete'])->name('rooms.force_delete');
        Route::post('/rooms/change-status/{id}',[RoomsController::class, 'changeStatus'])->name('rooms.change_status');

        
    });
});

?>
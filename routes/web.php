<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ContactsController;

require __DIR__.'/admin_auth.php';

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/about-us', function () {
    return view('about_us');
})->name('cms.about_us');

Route::get('/blog', function () {
    return view('blog');
})->name('cms.blog');

Route::get('/blog-detail', function () {
    return view('blog_detail');
})->name('cms.blog_detail');


// Room Routes
Route::get('/room-detail/{id}', [RoomsController::class, 'detail'])->name('rooms.detail');
Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms.index');

// Contact Routes
Route::get('/contact', [ContactsController::class, 'index'])->name('contact.index');
Route::post('/contact/store', [ContactsController::class, 'store'])->name('contact.store');



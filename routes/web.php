<?php

use App\Http\Controllers\Forums;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

// Public Route
Route::get('/', function () {return view('welcome');});
// Route::get('/', [UserController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Admin-only routes
Route::get('/admin/forum', [Forums::class, 'adminForum'])->middleware(['auth', 'admin'])->name('admin.forum');



// Group all authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/post', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(Forums::class)->group(function () {
        Route::get('/dashboard', 'showDash')->name('dashboard'); //show only the current user activities

        Route::get('/forum', 'ForumsShow')->name('forum.show'); // Show forum (if needed separately)
        Route::get('/forum/create', 'CreatePosting')->name('forum.create'); // Show forum (if needed separately)
        Route::post('/forum/create/post', 'PostingStore')->name('forum.post');

        Route::get('/forum/{forum}/edit', 'editPost')->name('forum.edit');
        Route::put('/forum/{forum}/update', 'updatePost')->name('forum.update');
        Route::delete('/forum/{forum}/delete', 'deletePost')->name('forum.destroy');
    });
});



require __DIR__ . '/auth.php';

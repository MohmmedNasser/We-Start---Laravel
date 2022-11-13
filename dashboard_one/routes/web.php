<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\InvoicesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('auth', 'type')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    // /posts/{post}
    Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::get('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore')->withTrashed();
    Route::get('posts/{post}/forcedelete', [PostController::class, 'forcedelete'])->name('posts.forcedelete')->withTrashed();
    Route::resource('posts', PostController::class);

    Route::resource('invoices', InvoicesController::class);

});


// Route::fallback(function() {
//     return 'dddddd';
// });

Auth::routes();

//not allowed route
Route::view('/not-allowed', 'not_allowed');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
 * Auth
 *
 * Auth::login($user)
 * Auth::logout()
 * Auth::loginUsingId(1)
 * Auth::attempt([email, password])
 * Auth::user()
 * Auth::id()
 * Auth::check()
 *
 * */

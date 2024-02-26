<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/latest');

Route::controller(\App\Http\Controllers\ListingController::class)->group(static function () {
    Route::get('latest/{topic?}', 'posts')->name('home');
    Route::get('relevant/{topic?}', 'posts')->name('home.relevant');
    Route::get('top/{topic?}', 'posts')->name('home.top');

    Route::get('user/{user:id}', 'author')->name('user.show');
});

Route::controller(\App\Http\Controllers\PostController::class)->group(static function () {
    Route::get('post/{post}-{slug}', 'show')->name('post.show');

    Route::group(['middleware' => 'auth'], static function () {
        Route::get('post', 'create')->name('post.create');
        Route::post('post', 'store')->name('post.store');
        Route::get('post/{post}/edit', 'edit')->name('post.edit');
        Route::put('post/{post}', 'update')->name('post.update');
        Route::delete('post/{post}', 'destroy')->name('post.delete');
    });
});

Route::controller(\App\Http\Controllers\CommentController::class)->group(static function () {
    Route::group(['middleware' => 'auth'], static function () {
        Route::post('comment', 'store')->name('comment.store');
        Route::put('comment/{comment}', 'update')->name('comment.update');
        Route::delete('comment/{comment}', 'destroy')->name('comment.delete');
    });
});

Route::controller(\App\Http\Controllers\TopicController::class)->group(static function () {
    Route::group(['middleware' => 'auth'], static function () {
        Route::get('topic', 'create')->name('topic.create');
    });
});

Route::get('api/embed', [\App\Http\Controllers\Api\EmbedController::class, 'show'])->name('embed.show');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::controller(\App\Http\Controllers\Api\UploadController::class)->group(static function () {
    Route::post('api/upload-image', 'image')->name('image.upload');
});

require __DIR__ . '/auth.php';

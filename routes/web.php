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

Route::controller(\App\Http\Controllers\HomeController::class)->group(static function () {
    Route::get('/', 'latest')->name('home');
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

Route::controller(\App\Http\Controllers\UserController::class)->group(static function () {
    Route::get('user/{user}', 'show')->name('user.show');
});

Route::get('topic/{topic}', static function (\App\Models\Topic $topic) {
    dd($topic->toArray());
})->name('topic');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::controller(\App\Http\Controllers\Api\UploadController::class)->group(static function () {
    Route::post('api/upload-image', 'image')->name('image.upload');
});

require __DIR__ . '/auth.php';

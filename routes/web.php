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

Route::get('/', static function () {
    return view('posts', [
        'posts' => \App\Models\Post::published()
            ->newest()
            ->with(['author', 'topic'])
            ->cursorPaginate(10),
    ]);
})->name('posts');

Route::controller(\App\Http\Controllers\UserController::class)->group(static function () {
    Route::get('user/{user}', 'show')->name('user.show');
});

Route::get('/post', static function () {
    return view('posts.create');
})->name('post.create');

Route::get('topic/{topic}', static function (\App\Models\Topic $topic) {
    dd($topic->toArray());
})->name('topic');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('api/upload-image', static function (Illuminate\Http\Request $request) {
    if ($request->hasFile('image')) {
        $uploadedFile = $request->file('image');
        $path = $uploadedFile
            ->storePublicly('images', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    return response()->json([
        'error' => 'No image uploaded',
    ], 400);
})->name('image.upload');

require __DIR__ . '/auth.php';

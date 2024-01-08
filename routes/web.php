<?php

use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class ,'index'])->name('home');
Route::get('/posts/{slug}', [HomeController::class ,'show'])->name('home.show');

Route::get('/about', function () {
    return view('frontend.about.index');
})->name('about');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    Route::resource('post', PostController::class);
    Route::get('trash', [PostController::class ,'trash'])->name('post.trash');
    Route::delete('force-delete/{id}', [PostController::class ,'delete'])->name('post.force-delete');
    Route::get('restore/{id}', [PostController::class ,'restore'])->name('post.restore');
    Route::get('admin/about',[AboutController::class,'index']);

});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Middleware\CheckImage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Image\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web', CheckImage::class]], function() {
    Route::get('/', [ImageController::class, 'index'])->name('image.create');
    Route::post('/image/store', [ImageController::class, 'store'])->name('image.store');
    Route::get('/image/display/{slug}', [ImageController::class, 'display'])->name('image.display');
    Route::get('/{slug}', [ImageController::class, 'show'])->name('image.show');
});

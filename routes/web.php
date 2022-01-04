<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FavoriteController;

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
Route::group(['middleware' => 'auth'], function () {
    Route::post('message/{message}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('message/{message}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::get('/message/mypage', [MessageController::class, 'mydata'])->name('message.mypage');
    Route::resource('message', MessageController::class);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

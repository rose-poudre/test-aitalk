<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AxiosController;

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
    Route::get('/message/favorite', [MessageController::class, 'favorite'])->name('message.favorite');
    Route::resource('message', MessageController::class);
});

Route::get('/talk/{query}', 'App\Http\Controllers\AxiosController@talk');

Route::get('/emotion/{reply}', 'App\Http\Controllers\AxiosController@emotion');

Route::post('/insert', 'App\Http\Controllers\MessageController@store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

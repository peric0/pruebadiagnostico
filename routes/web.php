<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('redirect/{driver}', [LoginController::class, 'redirectToProvider'])
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

//Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
//    ->name('login.provider')
//   ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::get('{driver}/callback', [LoginController::class, 'handleProviderCallback'])
    ->name('login.callback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

//Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')
//    ->name('login.callback')
//    ->where('driver', implode('|', config('auth.socialite.drivers')));

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


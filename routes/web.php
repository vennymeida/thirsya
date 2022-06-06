<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('beranda.index');
// });
Route::get('/login', function () {
  return view('auth/login');
});

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Auth::routes();


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/admin', 'AdminController@index');
//Route::get('/user', 'UserController@index');
Route::get('/user', [UserController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index']);

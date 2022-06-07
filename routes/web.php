<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HomeController;
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

Auth::routes();
Route::get('/', [BerandaController::class, 'index'])->name('beranda');



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/admin', 'AdminController@index');
//Route::get('/user', 'UserController@index');
// Route::get('/home', [HomeController::class, 'index']);
Route::get('/dashboardU', [UserController::class, 'dashboardU'])->name('user');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin');
Route::get('/profil', [AdminController::class, 'profil'])->name('Adminprofil');


// Route::get('admin', function () { return view('admin'); })->middleware('checkRole:admin');
// Route::get('user', function () { return view('user'); })->middleware(['checkRole:user,admin']);

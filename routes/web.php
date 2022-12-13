<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AlamatPengirimanController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Artisan;

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



Auth::routes();
Route::get('/mysql', function () {
  Artisan::call('migrate:fresh --seed');
});
Route::get('/home', [BerandaController::class, 'index']);
Route::get('/', [BerandaController::class, 'index'])->name('berandaindex');
Route::get('/shopBeranda', [BerandaController::class, 'shop'])->name('berandashop');
Route::get('/aboutBeranda', [BerandaController::class, 'about'])->name('berandaabout');


Route::group(['middleware' => 'auth'], function () {
  Route::resource('barang',  BarangController::class);
  Route::resource('transaksi',  TransaksiController::class);
  Route::resource('pembeli',  PembeliController::class);
  Route::resource('kategori',  KategoriController::class);
  Route::get('barang/kategori/{id}', [BarangController::class, 'listBarangKategori'])->name('list.withCategory');
  Route::resource('dashboard', AdminController::class);
  Route::get('/profil', [AdminController::class, 'profil'])->name('Adminprofil');
  Route::post('/doupdate', [ProfilController::class, 'doupdate'])->name('doUpdateProfil');
  Route::get('pembeli/role/{id}', [PembeliController::class, 'listUserRole'])->name('list.role');
  Route::get('cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
  Route::get('cetaksatu/{id}', [TransaksiController::class, 'cetak1'])->name('transaksi.cetak1');
  Route::get('searchBarang', [BarangController::class, 'searchBarang'])->name('searchBarang');
  Route::get('/search', [KategoriController::class, 'search'])->name('search');
  Route::get('/searchUser', [PembeliController::class, 'searchUser'])->name('searchUser');



  Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboardU', [UserController::class, 'dashboardU'])->name('user');
    Route::resource('shop',  ShopController::class);
    Route::resource('user',  UserController::class);
    Route::get('shop/{id}', [ShopController::class, 'index']);
    Route::post('add-to-cart/{id}', [ShopController::class, 'pesan']);
    Route::get('cart', [ShopController::class, 'cart']);
    Route::delete('cart/{id}', [ShopController::class, 'delete']);
    Route::get('checkout', [ShopController::class, 'checkoutAmount'])->name('checkout');
    Route::resource('alamat-pengiriman', AlamatPengirimanController::class);
    Route::get('placeorder', [ShopController::class, 'placeorderPesanan'])->name('placeorder');
    Route::get('upload/{id}', [OrderController::class, 'showUpload'])->name('showupload');
    Route::post('upload', [OrderController::class, 'uploadBukti'])->name('uploadBukti');
    Route::resource('order',  OrderController::class);
    Route::get('cetak/{id}', [OrderController::class, 'cetak'])->name('order.cetak');
    Route::post('/profilUser', [ProfilController::class, 'doupdate1'])->name('doUpdateProfilUser');
    Route::get('/profilUser', [UserController::class, 'profil'])->name('Userprofil');
  });
});

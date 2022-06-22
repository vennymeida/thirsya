<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AlamatPengirimanController;
use App\Http\Controllers\OrderController;



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

Route::get('/', [BerandaController::class, 'index'])->name('berandaindex');
Route::get('/shopBeranda', [BerandaController::class, 'shop'])->name('berandashop');
Route::get('/aboutBeranda', [BerandaController::class, 'about'])->name('berandaabout');


Route::group(['middleware' => 'auth'], function () {
  // Route::resource('profil', ProfilController::class);
  Route::resource('barang',  BarangController::class);
  Route::resource('transaksi',  TransaksiController::class);
  Route::resource('pembeli',  PembeliController::class);
  Route::resource('kategori',  KategoriController::class);
  Route::get('barang/kategori/{id}', [BarangController::class, 'listBarangKategori'])->name('list.withCategory');
  //Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin');
  Route::resource('dashboard', AdminController::class);
  Route::get('/profil', [AdminController::class, 'profil'])->name('Adminprofil');
  Route::post('/doupdate', [ProfilController::class, 'doupdate'])->name('doUpdateProfil');
  Route::get('pembeli/role/{id}', [PembeliController::class, 'listUserRole'])->name('list.role');
  // Route::get('userfilter/{id}', [PembeliController::class, 'getUserFilter'])->name('pembeli.filter');
  // Route::patch('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
  // Route::get('/barang', [BarangController::class, 'index'])->name('Adminbarang');
  // Route::get('/barang', [BarangController::class, 'create']);
  // Route::get('/pembeli', [AdminController::class, 'pembeli'])->name('Adminpembeli');
  // Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('Admintransaksi');
  Route::get('cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
  Route::get('searchBarang', [BarangController::class, 'searchBarang'])->name('searchBarang');
  Route::get('/search', [KategoriController::class, 'search'])->name('search');
  Route::get('/searchUser', [PembeliController::class, 'searchUser'])->name('searchUser');

  Route::group(['middleware' => 'auth'], function () {
    Route::resource('shop',  ShopController::class);
    Route::resource('user',  UserController::class);
    Route::get('shop/{id}',[ShopController::class,'index']);
    Route::post('add-to-cart/{id}',[ShopController::class,'pesan']);
    Route::get('cart',[ShopController::class,'cart']);
    Route::delete('cart/{id}', [ShopController::class,'delete']);
    Route::get('checkout',[ShopController::class,'checkoutAmount'])->name('checkout');
    Route::resource('alamat-pengiriman', AlamatPengirimanController::class);
    Route::get('placeorder',[ShopController::class,'placeorderPesanan'])->name('placeorder');
    Route::get('upload/{id}', [OrderController::class, 'showUpload'])->name('showupload');
    Route::post('upload', [OrderController::class, 'uploadBukti'])->name('uploadBukti');
    Route::resource('order',  OrderController::class);
    Route::get('cetak/{id}', [OrderController::class, 'cetak'])->name('order.cetak');
  });
});




// Route::get('admin', function () { return view('admin'); })->middleware('checkRole:admin');
// Route::get('user', function () { return view('user'); })->middleware(['checkRole:user,admin']);

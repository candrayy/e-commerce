<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ElektronikController;
use App\Http\Controllers\PakaianController;
use App\Http\Controllers\TransaksiController;


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
//     return view('welcome');
// });

Route::middleware(['auth', 'cekRole'])->group(function () {
    // Beranda Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::get('/tambah-produk', [ProdukController::class, 'create'])->name('tambah-produk');
    Route::post('/simpan-produk', [ProdukController::class, 'store'])->name('simpan-produk');
    Route::get('/edit-produk/{id}', [ProdukController::class, 'edit'])->name('edit-produk');
    Route::post('/ubah-produk/{id}', [ProdukController::class, 'update'])->name('ubah-produk');
    Route::get('/hapus-produk/{id}', [ProdukController::class, 'destroy'])->name('hapus-produk');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/tambah-kategori', [KategoriController::class, 'create'])->name('tambah-kategori');
    Route::post('/simpan-kategori', [KategoriController::class, 'store'])->name('simpan-kategori');
    Route::get('/edit-kategori/{id}', [KategoriController::class, 'edit'])->name('edit-kategori');
    Route::post('/ubah-kategori/{id}', [KategoriController::class, 'update'])->name('ubah-kategori');
    Route::get('/hapus-kategori/{id}', [KategoriController::class, 'destroy'])->name('hapus-kategori');

    // User Admin
    Route::get('/akun', [AkunController::class, 'index'])->name('akun');
    Route::get('/tambah-akun', [AkunController::class, 'create'])->name('tambah-akun');
    Route::post('/simpan-akun', [AkunController::class, 'store'])->name('simpan-akun');
    Route::get('/edit-akun/{id}', [AkunController::class, 'edit'])->name('edit-akun');
    Route::post('/ubah-akun/{id}', [AkunController::class, 'update'])->name('ubah-akun');
    Route::get('/hapus-akun/{id}', [AkunController::class, 'destroy'])->name('hapus-akun');

    
});


Route::middleware(['auth'])->group(function () {
    
    // Beranda User
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/detail/{slug}', [BerandaController::class, 'detail']);

    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::post('/tambah-keranjang/{id}', [KeranjangController::class, 'keranjangadd'])->name('tambah-keranjang');
    Route::get('/hapus-keranjang/{id}', [KeranjangController::class, 'destroy'])->name('hapus-keranjang');

    // Kategori User
    Route::get('/elektronik', [ElektronikController::class, 'index'])->name('elektronik');
    Route::get('/pakaian', [PakaianController::class, 'index'])->name('pakaian');

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::post('/beli', [TransaksiController::class, 'beli'])->name('beli');

});


// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/postregister', [RegisterController::class, 'store'])->name('postregister');
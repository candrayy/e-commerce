<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

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



// Beranda User
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/detail/{slug}', [BerandaController::class, 'detail']);
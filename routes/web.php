<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginControler;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WaController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [LoginControler::class, 'index'])->name('login');
Route::post('/aksiLogin', [LoginControler::class, 'aksiLogin'])->name('aksiLogin');
Route::get('/logout', [LoginControler::class, 'logout'])->name('logout');

Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('auth');
Route::post('/tambahUser', [UserController::class, 'tambahUser'])->name('tambahUser')->middleware('auth');
Route::post('/ubahUser', [UserController::class, 'ubahUser'])->name('ubahUser')->middleware('auth');
Route::get('/hapusUser', [UserController::class, 'hapusUser'])->name('hapusUser')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// wa
Route::get('/wa', [WaController::class, 'index'])->name('wa')->middleware('auth');
Route::post('/ubahWa', [WaController::class, 'ubahWa'])->name('ubahWa')->middleware('auth');

// produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware('auth');
Route::post('/tambahProduk', [ProdukController::class, 'tambahProduk'])->name('tambahProduk')->middleware('auth');
Route::post('/ubahProduk', [ProdukController::class, 'ubahProduk'])->name('ubahProduk')->middleware('auth');
Route::get('/hapusProduk', [ProdukController::class, 'hapusProduk'])->name('hapusProduk')->middleware('auth');
Route::post('/tbhDistribusi', [ProdukController::class, 'tbhDistribusi'])->name('tbhDistribusi')->middleware('auth');
Route::get('/uploadImages', [ProdukController::class, 'uploadImages'])->name('uploadImages')->middleware('auth');
Route::post('/importProduk', [ProdukController::class, 'importProduk'])->name('importProduk')->middleware('auth');
Route::get('/exportFormat', [ProdukController::class, 'exportFormat'])->name('exportFormat')->middleware('auth');
Route::get('/hapusLinkV', [ProdukController::class, 'hapusLinkV'])->name('hapusLinkV')->middleware('auth');
Route::get('/bestSeller', [ProdukController::class, 'bestSeller'])->name('bestSeller')->middleware('auth');
Route::get('/bestSellerInput', [ProdukController::class, 'bestSellerInput'])->name('bestSellerInput')->middleware('auth');
Route::post('/tbhKategoriProduk', [ProdukController::class, 'tbhKategoriProduk'])->name('tbhKategoriProduk')->middleware('auth');

// transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi')->middleware('auth');
Route::get('/setStatus', [TransaksiController::class, 'setStatus'])->name('setStatus')->middleware('auth');

// about
Route::get('/about', [AboutController::class, 'index'])->name('about')->middleware('auth');
Route::post('/tambahAbout', [AboutController::class, 'tambahAbout'])->name('tambahAbout')->middleware('auth');
Route::post('/ubahAbout', [AboutController::class, 'ubahAbout'])->name('ubahAbout')->middleware('auth');
Route::get('/hapusAbout', [AboutController::class, 'hapusAbout'])->name('hapusAbout')->middleware('auth');

// footer
Route::get('/footer', [FooterController::class, 'index'])->name('footer')->middleware('auth');
Route::post('/tambahFooter', [FooterController::class, 'tambahFooter'])->name('tambahFooter')->middleware('auth');
Route::post('/ubahFooter', [FooterController::class, 'ubahFooter'])->name('ubahFooter')->middleware('auth');

// banner
Route::get('/banner', [BannerController::class, 'index'])->name('banner')->middleware('auth');
Route::post('/tambahBanner', [BannerController::class, 'tambahBanner'])->name('tambahBanner')->middleware('auth');
Route::post('/ubahBanner', [BannerController::class, 'ubahBanner'])->name('ubahBanner')->middleware('auth');
Route::get('/hapusBanner', [BannerController::class, 'hapusBanner'])->name('hapusBanner')->middleware('auth');

// lokasi
Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi')->middleware('auth');
Route::post('/tambahLokasi', [LokasiController::class, 'tambahLokasi'])->name('tambahLokasi')->middleware('auth');
Route::post('/ubahLokasi', [LokasiController::class, 'ubahLokasi'])->name('ubahLokasi')->middleware('auth');
Route::get('/hapusLokasi', [LokasiController::class, 'hapusLokasi'])->name('hapusLokasi')->middleware('auth');

// kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori')->middleware('auth');
Route::post('/tambahKategori', [KategoriController::class, 'tambahKategori'])->name('tambahKategori')->middleware('auth');
Route::post('/ubahKategori', [KategoriController::class, 'ubahKategori'])->name('ubahKategori')->middleware('auth');
Route::get('/hapusKategori', [KategoriController::class, 'hapusKategori'])->name('hapusKategori')->middleware('auth');

// satuan
Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan')->middleware('auth');
Route::post('/tambahSatuan', [SatuanController::class, 'tambahSatuan'])->name('tambahSatuan')->middleware('auth');
Route::post('/ubahSatuan', [SatuanController::class, 'ubahSatuan'])->name('ubahSatuan')->middleware('auth');
Route::get('/hapusSatuan', [SatuanController::class, 'hapusSatuan'])->name('hapusSatuan')->middleware('auth');

// distribusi
Route::get('/distribusi', [DistribusiController::class, 'index'])->name('distribusi')->middleware('auth');
Route::post('/tambahDistribusi', [DistribusiController::class, 'tambahDistribusi'])->name('tambahDistribusi')->middleware('auth');
Route::post('/ubahDistribusi', [DistribusiController::class, 'ubahDistribusi'])->name('ubahDistribusi')->middleware('auth');
Route::get('/hapusDistribusi', [DistribusiController::class, 'hapusDistribusi'])->name('hapusDistribusi')->middleware('auth');

// voucher
Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher')->middleware('auth');
Route::post('/tambahVoucher', [VoucherController::class, 'tambahVoucher'])->name('tambahVoucher')->middleware('auth');
Route::post('/ubahVoucher', [VoucherController::class, 'ubahVoucher'])->name('ubahVoucher')->middleware('auth');
Route::get('/hapusVoucher', [VoucherController::class, 'hapusVoucher'])->name('hapusVoucher')->middleware('auth');
Route::get('/setVoucher', [VoucherController::class, 'setVoucher'])->name('setVoucher')->middleware('auth');

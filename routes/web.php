<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenangkaranController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\ReportProduksiController;
use App\Http\Controllers\ProduksiController;

Route::get('/', function () {
    return view('page');
});
//auth
Route::get('/login', [LoginController::class, 'viewlogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'viewregister'])->name('register');
Route::post('/register', [RegisterController::class, 'createuser'])->name('register');
Route::get('/pengguna/delete/{id}', [UserController::class, 'deletepengguna']);

// read
Route::get('/dashboard', [AdminController::class, 'readdashboard'])->name('dashboard');
Route::get('/pengguna', [UserController::class, 'readuser'])->name('pengguna');
Route::get('/penangkaran', [PenangkaranController::class, 'readpenangkaran'])->name('penangkaran');
Route::get('/penangkaran/{id}/{lokasi_penangkaran}', [PenangkaranController::class, 'detailpenangkaran'])->name('detail.kandang');
Route::get('/readkandang/{id}', [PenangkaranController::class, 'detailkandang'])->name('read.kandang');
Route::get('/kandang',[KandangController::class,'readkandang'])->name('kandang');
Route::get('/kandang/{id}/{namakandang}',[KandangController::class,'detail_kandangs'])->name('detail.kandangs');
Route::get('/kategoriproduksi',[AdminController::class,'readkategoriproduksi'])->name('kategori.produksi');
Route::get('/report-inkubator',[ReportProduksiController::class,'report_inkubator'])->name('report-inkubator');
Route::get('/report-hidup',[ReportProduksiController::class,'report_hidup'])->name('report-hidup');
Route::get('/produksi-inkubator',[ProduksiController::class,'produksi_inkubator'])->name('produksi-inkubator');
Route::get('/produksi-hidup',[ProduksiController::class,'produksi_hidup'])->name('produksi-hidup');
Route::get('/produksi-mati',[ProduksiController::class,'produksi_mati'])->name('produksi-mati');
Route::get('/detail-kandang',[KandangController::class,'detail_kandang'])->name('detail-kandang');
Route::get('/pakan',[AdminController::class,'readpakan'])->name('pakan');

// delete
Route::get('/kategori/delete/{id}', [AdminController::class, 'deletekategori']);
Route::get('/penangkaran/delete/{id}', [PenangkaranController::class, 'deletepenangkaran']);
Route::get('/kandang/delete/{id}',[KandangController::class,'deletekandang']);
Route::get('/pakan/delete/{id}', [AdminController::class, 'deletepakan']);
//create
Route::post('/pengguna', [UserController::class, 'createuser'])->name('pengguna');
Route::post('/penangkaran', [PenangkaranController::class, 'createpenangkaran'])->name('penangkaran');
Route::post('/kandang',[KandangController::class,'createkandang'])->name('kandang');
Route::post('/kategori',[AdminController::class,'createkategori'])->name('kategori');
Route::post('/pakan',[AdminController::class,'createpakan'])->name('pakan');
//update
Route::post('/pengguna/update/{id}', [UserController::class, 'updateuser'])->name('update.pengguna');





// Route::get('penangkaran/delete/{id}', [AdminController::class, 'deletepenangkaran']);








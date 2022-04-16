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
Route::get('/login', [LoginController::class, 'ViewLogin'])->name('login');
Route::post('/login', [LoginController::class, 'Login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'ViewRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'CreateUser'])->name('register');
Route::get('/pengguna/delete/{id}', [UserController::class, 'DeleteUser']);

// read
Route::get('/dashboard', [AdminController::class, 'ReadDashboard'])->name('dashboard');
Route::get('/pengguna', [UserController::class, 'ReadUser'])->name('pengguna');
Route::get('/penangkaran', [PenangkaranController::class, 'ReadPenangkaran'])->name('penangkaran');
Route::get('/penangkaran/{id}/{lokasi_penangkaran}', [PenangkaranController::class, 'DetailPenangkaran'])->name('detail.kandang');
Route::get('/readkandang/{id}', [PenangkaranController::class, 'DetailKandang'])->name('read.kandang');
Route::get('/kandang',[KandangController::class,'ReadKandang'])->name('kandang');
Route::get('/kandang/{id}/{namakandang}',[KandangController::class,'DetailKandangs'])->name('detail.kandangs');
Route::get('/kategoriproduksi',[AdminController::class,'ReadKategoriproduksi'])->name('kategori.produksi');
Route::get('/report-inkubator',[ReportProduksiController::class,'ReportInkubator'])->name('report.inkubator');
Route::get('/report-hidup',[ReportProduksiController::class,'ReportHidup'])->name('report.hidup');
Route::get('/produksi-inkubator',[ProduksiController::class,'ProduksiInkubator'])->name('produksi.inkubator');
Route::get('/produksi-hidup',[ProduksiController::class,'ProduksiHidup'])->name('produksi.hidup');
Route::get('/produksi-mati',[ProduksiController::class,'ProduksiMati'])->name('produksi.mati');
Route::get('/detail-kandang',[KandangController::class,'DetailKandang'])->name('detail.kandang');
Route::get('/pakan',[AdminController::class,'ReadPakan'])->name('pakan');

// delete
Route::get('/kategori/delete/{id}', [AdminController::class, 'deletekategori']);
Route::get('/penangkaran/delete/{id}', [PenangkaranController::class, 'deletepenangkaran']);
Route::get('/kandang/delete/{id}',[KandangController::class,'DeleteKandang']);
Route::get('/pakan/delete/{id}', [AdminController::class, 'DeletePakan']);
//create
Route::post('/pengguna', [UserController::class, 'CreateUser'])->name('pengguna');
Route::post('/penangkaran', [PenangkaranController::class, 'CreatePenangkaran'])->name('penangkaran');
Route::post('/kandang',[KandangController::class,'CreateKandang'])->name('kandang');
Route::post('/kategori',[AdminController::class,'createkategori'])->name('kategori');
Route::post('/pakan',[AdminController::class,'CreatePakan'])->name('pakan');
Route::post('/produksi-telur/{id}/{nama_kandang}',[ProduksiController::class,'CreateProduksiTelur'])->name('produksi-telur');
//update
Route::post('/pengguna/update/{id}', [UserController::class, 'UpdateUser'])->name('update.pengguna');





// Route::get('penangkaran/delete/{id}', [AdminController::class, 'deletepenangkaran']);








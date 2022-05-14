<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenangkaranController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\HasilProduksiController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\KebersihanController;


Route::resource('users','UserController');

Route::get('/', function () {
    return view('page');
});
//auth
Route::get('/login', [LoginController::class, 'ReadLogin'])->name('login');
Route::post('/login', [LoginController::class, 'Login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'ViewRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'CreateUser'])->name('register');

// dashboard
Route::get('/dashboard', [AdminController::class, 'ReadDashboard'])->name('dashboard');

// Pengguna [V]
Route::get('/modal-read/{id}', [UserController::class, 'ModalRead']);
Route::get('/modal-create', [UserController::class, 'ModalCreate']);
Route::get('/modal-update/{id}', [UserController::class, 'ModalUpdate']);
Route::get('/modal-delete/{id}', [UserController::class, 'ModalDelete']);
Route::get('/table-pemilik', [UserController::class, 'ReadTablePemilik']);
Route::get('/table-pekerja', [UserController::class, 'ReadTablePekerja']);
Route::get('/pengguna-pemilik', [UserController::class, 'ReadUserPemilik'])->name('pengguna.pemilik');
Route::get('/pengguna-pekerja', [UserController::class, 'ReadUserPekerja'])->name('pengguna.pekerja');
Route::post('/pengguna', [UserController::class, 'CreateUser'])->name('create.pengguna');
Route::patch('/pengguna/update/{id}', [UserController::class, 'UpdateUser'])->name('update.pengguna');
Route::delete('/pengguna/delete/{id}', [UserController::class, 'DeleteUser'])->name('delete.pengguna');

// Penangkaran [X] Selanjutnya
Route::get('/modal-read-penangkaran/{id}', [PenangkaranController::class, 'ModalRead']);
Route::get('/modal-create-penangkaran', [PenangkaranController::class, 'ModalCreate']);
Route::get('/modal-update-penangkaran/{id}', [PenangkaranController::class, 'ModalUpdate']);
Route::get('/modal-delete-penangkaran/{id}', [PenangkaranController::class, 'ModalDelete']);
Route::get('/show-penangkaran', [PenangkaranController::class, 'ShowPenangkaran']);

Route::get('/penangkaran', [PenangkaranController::class, 'ReadPenangkaran'])->name('read.penangkaran');
Route::post('/penangkaran', [PenangkaranController::class, 'CreatePenangkaran'])->name('create.penangkaran');
Route::patch('/penangkaran/update/{id}', [PenangkaranController::class, 'UpdatePenangkaran'])->name('update.penangkaran');
Route::delete('/penangkaran/delete/{id}', [PenangkaranController::class, 'DeletePenangkaran'])->name('delete.penangkaran');

// Kandang [X]
Route::get('/penangkaran/{id}/{lokasi_penangkaran}', [PenangkaranController::class, 'DetailPenangkaran'])->name('detail.penangkaran');
Route::get('/modal-read-kandang/{id}', [KandangController::class, 'ModalRead']);
Route::get('/modal-create-kandang/{id}', [KandangController::class, 'ModalCreate']);
Route::get('/modal-update-kandang/{id}', [KandangController::class, 'ModalUpdate']);
Route::get('/modal-delete-kandang/{id}', [KandangController::class, 'ModalDelete']);
Route::get('/show-kandang/{id}', [KandangController::class, 'ShowKandang']);
Route::post('/kandang',[KandangController::class,'CreateKandang'])->name('create.kandang');
Route::patch('/kandang/update/{id}', [KandangController::class, 'UpdateKandang'])->name('update.kandang');
Route::delete('/kandang/delete/{id}',[KandangController::class,'DeleteKandang'])->name('delete.kandang');

Route::get('/readkandang/{id}', [PenangkaranController::class, 'DetailKandang'])->name('riwayat.kandang');

Route::get('/kandang',[KandangController::class,'ReadKandang'])->name('kandang');
Route::get('/kandang/{id}/{namakandang}',[KandangController::class,'DetailKandangs'])->name('detail.kandangs');
Route::get('/detail-kandang',[KandangController::class,'DetailKandang'])->name('detail.kandang');


// Pakan [X]
Route::get('/modal-read-pakan/{id}', [PakanController::class, 'ModalRead']);
Route::get('/modal-create-pakan/{id}', [PakanController::class, 'ModalCreate']);
Route::get('/modal-update-pakan/{id}', [PakanController::class, 'ModalUpdate']);
Route::get('/modal-delete-pakan/{id}', [PakanController::class, 'ModalDelete']);
Route::get('/show-pakan/{id}', [PakanController::class, 'ShowPakan']);
Route::post('/pakan',[PakanController::class,'CreatePakan'])->name('create.pakan');
Route::patch('/pakan/update/{id}', [PakanController::class, 'UpdateKandang'])->name('update.pakan');
Route::delete('/pakan/delete/{id}', [PakanController::class, 'DeletePakan'])->name('delete.pakan');


Route::get('/pakan',[AdminController::class,'ReadPakan'])->name('pakan');
//Kebersihan [X]
Route::post('/kebersihan/create',[KebersihanController::class,'CreateKebersihan'])->name('create.kebersihan');
// Produksi [X]
Route::post('/produksi-telur/{id}',[ProduksiController::class,'CreateProduksiTelur'])->name('produksi.telur');
Route::post('/produksi-inkubator/update/{id}', [ProduksiController::class, 'UpdateProduksiInkubator'])->name('update.produksi.inkubator');
Route::post('/produksi-hidup/update/{id}', [ProduksiController::class, 'UpdateProduksiHidup'])->name('update.produksi.hidup');
Route::get('/produksi-inkubator',[ProduksiController::class,'ProduksiInkubator'])->name('produksi.inkubator');
Route::get('/produksi-hidup',[ProduksiController::class,'ProduksiHidup'])->name('produksi.hidup');
Route::get('/produksi-mati',[ProduksiController::class,'ProduksiMati'])->name('produksi.mati');

// Report Produksi [X]
Route::get('/report-inkubator',[HasilProduksiController::class,'ReportInkubator'])->name('report.inkubator');
Route::get('/report-hidup',[HasilProduksiController::class,'ReportHidup'])->name('report.hidup');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', function () {
    return view('page');
});
//auth
Route::get('/login', [LoginController::class, 'viewlogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'viewregister'])->name('register');
Route::post('/register', [RegisterController::class, 'createuser'])->name('register');
Route::get('pengguna/delete/{id}', [AdminController::class, 'deletepengguna']);

// read
Route::get('/dashboard', [AdminController::class, 'readdashboard'])->name('dashboard');
Route::get('/pengguna', [AdminController::class, 'readuser'])->name('pengguna');
Route::get('/penangkaran', [AdminController::class, 'readpenangkaran'])->name('penangkaran');
Route::get('/penangkaran/{id}', [AdminController::class, 'detailpenangkaran'])->name('detailkandang');
Route::get('/kandang',[AdminController::class,'readkandang'])->name('kandang');
Route::get('/kategori',[AdminController::class,'readkategori'])->name('kategori');
Route::get('/kategoriproduksi',[AdminController::class,'readkategoriproduksi'])->name('kategoriproduksi');
// delete
Route::get('/kategori/delete/{id}', [AdminController::class, 'deletekategori']);
Route::get('/penangkaran/delete/{id}', [AdminController::class, 'deletepenangkaran']);
Route::get('/kandang/delete/{id}',[AdminController::class,'deletekandang']);
//create
Route::post('/pengguna', [AdminController::class, 'createuser'])->name('pengguna');
Route::post('/penangkaran', [AdminController::class, 'createpenangkaran'])->name('penangkaran');
Route::post('/penangkaran/createdetailkandang', [AdminController::class, 'createdetailkandang'])->name('detailkandang');
Route::post('/kandang',[AdminController::class,'createkandang'])->name('kandang');
Route::post('/kategori',[AdminController::class,'createkategori'])->name('kategori');







// Route::get('penangkaran/delete/{id}', [AdminController::class, 'deletepenangkaran']);








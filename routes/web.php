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

Route::get('/login', [LoginController::class, 'viewlogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'viewregister'])->name('register');
Route::post('/register', [RegisterController::class, 'createuser'])->name('register');
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::get('/pengguna', [AdminController::class, 'user'])->name('pengguna');
Route::post('/pengguna', [AdminController::class, 'createuser'])->name('pengguna');
Route::get('pengguna/delete/{id}', [AdminController::class, 'deletepengguna']);
Route::get('/penangkaran', [AdminController::class, 'viewpenangkaran'])->name('penangkaran');
Route::post('/penangkaran', [AdminController::class, 'createpenangkaran'])->name('penangkaran');
Route::get('/penangkaran/{Penangkaran::kode_penangkaran}', [AdminController::class, 'detailpenangkaran']);
Route::get('/kategori',[AdminController::class,'readkategori'])->name('kategori');
Route::post('/kategori',[AdminController::class,'createkategori'])->name('kategori');
Route::get('kategori/delete/{id}', [AdminController::class, 'deletekategori']);

// Route::get('/kandang', [AdminController::class, 'viewkandang'])->name('penangkaran');
// Route::post('/penangkaran', [AdminController::class, 'createpenangkaran'])->name('penangkaran');

// Route::post('/penangkaran', [AdminController::class, 'createpenangkaran'])->name('penangkaran');

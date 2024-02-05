<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\ProfileController;
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
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'] )->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'] );
Route::get('/logout', [AuthController::class, 'logout'] );

Route::get('/home', [HomeController::class, 'index'] )->middleware('auth');

/* 
*  Menampilkan View halaman reimbursement
*  Terdapat validasi departemen di dalamnya
*/
Route::get('/reimbursement', [ReimbursementController::class, 'index'] )->middleware('auth');

/* 
*  Menampilkan View form input reimbursement
*  Form input claim hanya boleh digunakan selain HR dan Finance 
*/
Route::get('/claim', [ReimbursementController::class, 'claimForm'] )->middleware('auth', 'department:PEGAWAI');

/* 
*  Fungsi menambah data reimbursement
*  Fungsi claim hanya boleh digunakan selain HR dan Finance
*/
Route::post('/claim', [ReimbursementController::class, 'claim'] )->middleware('auth', 'department:PEGAWAI');

/* 
*  Menampilkan View detail reimbursement
*  Terdapat validasi departemen di dalamnya
*/
Route::get('/reimbursement/{id}', [ReimbursementController::class, 'claimFormFilled'] )->middleware('auth');


/* 
*  Dapat digunakan HR untuk menerima / tolak reimbursement
*  Dapat digunakan FINANCE untuk mengubah status menjadi claimed
*  Fungsi updateStatus boleh digunakan HR & FINANCE
*/
Route::post('/updateStatus', [ReimbursementController::class, 'updateStatus'] )->middleware('auth', 'department:HR,FINANCE' );


Route::post('/cancelClaim', [ReimbursementController::class, 'cancelClaim'] )->middleware('auth', 'department:PEGAWAI' );
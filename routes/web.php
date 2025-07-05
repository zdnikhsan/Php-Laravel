<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\manageController;
use App\Http\Controllers\pesananController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [dashboardController::class,'showLandingPage'])->name('showLandingPage');

Route::get('login', [authController::class, 'showLogin'])->name('showLogin');
Route::post('login/submit', [authController::class,'submitLogin'])->name('submitLogin');

Route::post('logout', [authController::class, 'logout'])->name('logout');

Route::get('dashboard', [dashboardController::class,'showDashboard'])->name('showDashboard');

Route::get('pesanan', [pesananController::class,'showPesanan'])->name('showPesanan');
Route::post('tambahTransaksi', [pesananController::class, 'tambahTransaksi'])->name('tambahTransaksi');
Route::get('detailTransaksi/{id}', [pesananController::class, 'detailTransaksi'])->name('detailTransaksi');
Route::put('/transaksi/{id}/update', [pesananController::class, 'editTransaksi'])->name('editTransaksi');
Route::delete('/transaksi/{id}/delete', [pesananController::class, 'hapusTransaksi'])->name('hapusTransaksi');


Route::get('manage', [manageController::class,'showManage'])->name('showManage');
Route::get('addPelanggan', [manageController::class, 'showFormPelanggan'])->name('showFormPelanggan');
Route::post('pelangganAction', [manageController::class, 'pelangganAction'])->name('pelangganAction');
Route::get('pelangganDetail/{id}', [manageController::class, 'pelangganDetail'])->name('pelangganDetail');
Route::post('pelangganDetailEdit', [manageController::class, 'pelangganDetailEdit'])->name('pelangganDetailEdit');
Route::post('/pelanggan/{id}', [manageController::class, 'destroy'])->name('pelanggan.destroy');


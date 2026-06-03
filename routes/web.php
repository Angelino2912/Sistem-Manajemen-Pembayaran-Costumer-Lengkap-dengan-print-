<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

// Customer mengirim bukti pembayaran lewat form upload.
Route::post('/upload', [UploadController::class, 'store'])
    ->name('upload');

Route::get('/pelanggan/bayar', [CustomerPaymentController::class, 'create'])->name('customer.payments.create');
Route::get('/', fn () => redirect()->route('customer.payments.create'))->name('home');

Route::put('/pelanggan/{id}/status', [PelangganController::class, 'updateStatus'])->name('pelanggan.status.update');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.store');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->group(function () {
    // Dashboard admin menampilkan data pembayaran customer.
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Admin memverifikasi pembayaran customer menjadi lunas.
    Route::post('/admin/verifikasi/{id}', [AdminController::class, 'verifyPayment'])
        ->name('admin.verify');
    Route::patch('/admin/pelanggan/{id}/status', [PelangganController::class, 'updateStatus'])->name('admin.pelanggan.status');

    // Admin bisa edit data pembayaran dan cetak bukti pembayaran.
    Route::get('/admin/pembayaran/{id}/edit', [AdminController::class, 'editPayment'])->name('admin.payments.edit');
    Route::put('/admin/pembayaran/{id}', [AdminController::class, 'updatePayment'])->name('admin.payments.update');
    Route::get('/admin/pembayaran/{id}/print', [AdminController::class, 'printPayment'])->name('admin.payments.print-single');
    Route::get('/admin/pembayaran/cetak', [AdminController::class, 'printPayments'])->name('admin.payments.print');
});

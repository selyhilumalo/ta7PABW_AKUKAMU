<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ManageCampaignController;
use Illuminate\Support\Facades\Route;

// Beranda
Route::redirect('/', '/campaigns')->name('home');

// Publik: campaign dan donasi
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');

Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
Route::post('/campaigns/{campaign}/donations', [DonationController::class, 'store'])->name('donations.store');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Pengelolaan campaign: hanya untuk pengguna yang sudah login
Route::middleware('auth')->prefix('manage')->name('manage.')->group(function () {
    Route::get('campaigns/{campaign}/download', [ManageCampaignController::class, 'download'])->name('campaigns.download');
    Route::resource('campaigns', ManageCampaignController::class)->except('show');
});
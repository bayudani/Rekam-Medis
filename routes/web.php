<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('tentang-puskesmas', 'tentangPuskesmas')
    ->name('tentangPuskesmas');

Route::view('jadwal-dokter', 'JadwalDokter')
    ->name('JadwalDokter');
    
Route::view('cara-berobat', 'CaraBerobat')
    ->name('CaraBerobat');

Route::view('kontak', 'kontak')
    ->name('kontak');
require __DIR__.'/auth.php';

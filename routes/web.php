<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
    Route::view('accounts', 'livewire.accounts.index')->name('accounts.index');
    Route::view('categories', 'livewire.categories.index')->name('categories.index');
});



require __DIR__.'/auth.php';



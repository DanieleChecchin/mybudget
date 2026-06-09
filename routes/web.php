<?php

use App\Livewire\Accounts\Create as CreateAccount;
use App\Livewire\Accounts\Edit as EditAccount;
use App\Livewire\Accounts\Index as AccountsIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
    Route::get('accounts', AccountsIndex::class)->name('accounts.index');
    Route::get('accounts/create', CreateAccount::class)->name('accounts.create');
    Route::get('accounts/{account}/edit', EditAccount::class)->name('accounts.edit');
    Route::view('categories', 'livewire.categories.index')->name('categories.index');
});

require __DIR__.'/auth.php';

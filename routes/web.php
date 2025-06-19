<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Listings;
use App\Livewire\Categories;
use App\Livewire\Index;
use App\Livewire\Locations;
use App\Livewire\Users;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/crud/produk', Listings::class) -> name('listings');
Route::get('/crud/kategori', Categories::class) -> name('categories');
Route::get('/crud/lokasi', Locations::class) -> name('locations');
Route::get('/crud/user', Users::class) -> name('users');
Route::get('/', Index::class) -> name('index');

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
Route::get('/produk', Listings::class) -> name('listings');
Route::get('/kategori', Categories::class) -> name('categories');
Route::get('/lokasi', Locations::class) -> name('locations');
Route::get('/user', Users::class) -> name('users');
Route::get('/', Index::class) -> name('index');

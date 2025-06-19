<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Listings;
use App\Livewire\Categories;
use App\Livewire\Index;
use App\Livewire\Locations;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/produk', Listings::class);
Route::get('/kategori', Categories::class);
Route::get('/lokasi', Locations::class);
Route::get('/', Index::class);

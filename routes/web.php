<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Listings;
use App\Livewire\Categories;
use App\Livewire\Locations;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/produk', Listings::class)->name('listings');
Route::get('/kategori', Categories::class)->name('category');
Route::get('/lokasi', Locations::class)->name('location');
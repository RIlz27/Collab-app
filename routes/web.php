<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Listings;
use App\Livewire\Category;
use App\Livewire\Location;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/produk', Listings::class)->name('listings.index');
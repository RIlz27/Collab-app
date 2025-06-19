<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Listings;
use App\Livewire\Categories;
use App\Livewire\Locations;

// Route::get('/', function () {
//     return view('welcome');
// });
<<<<<<< HEAD
Route::get('/produk', Listings::class);
Route::get('/kategori', Categorys::class);
Route::get('/lokasi', Locations::class);
Route::get('/', function () {
    return redirect('/produk');
});
=======
Route::get('/produk', Listings::class)->name('listings');
Route::get('/kategori', Categories::class)->name('category');
Route::get('/lokasi', Locations::class)->name('location');
>>>>>>> 3c8e17838aa1ab5b2c7e8a3f68b3358e80e1312b

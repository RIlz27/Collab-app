<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Listings;
use App\Livewire\Categorys;
use App\Livewire\Locations;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/produk', Listings::class);
Route::get('/kategori', Categorys::class);
Route::get('/lokasi', Locations::class);
Route::get('/', function () {
    return redirect('/produk');
});
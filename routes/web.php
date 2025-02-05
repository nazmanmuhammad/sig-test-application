<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.master');
});

Route::get('test', function() {
    $data = Http::get("https://bsby.siglab.co.id/api/test-programmer", [
        'email' => 'nazman.nadev@gmail.com'
    ]);

    return $data;   
});

Route::get('dashboard', function() {
    return view('dashboard');
})->name('dashboard');
Route::get('product', [ProductController::class,'index'])->name('product');
Route::get('product-from-db', [ProductController::class,'indexFromDb'])->name('productFromDb');
Route::get('fetch-data-from-api', [ProductController::class,'fetcDataFromApi'])->name('fetchDataFromApi');

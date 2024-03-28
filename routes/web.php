<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::controller(ProductController::class)->group(function(){
    Route::get('/products/create','create') -> name('products.create');
    Route::get('/products','index') -> name('products.index');
    Route::get('/products/{product}/edit','edit') -> name('products.edit');
    Route::put('/products/{product}','update') -> name('products.update');
    Route::post('/products/create','store') -> name('products.store');
    Route::delete('/products/{product}','destroy') -> name('products.destroy');

});


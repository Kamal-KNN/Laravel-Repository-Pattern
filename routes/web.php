<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
Route::get('/', function () {
    return view('welcome');
});


Route::get('kamal/{product:name}',function(Product $product) {
    return view('product',['product'=>$product]);
});

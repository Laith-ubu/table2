<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\recipetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});

Route::post('/newData', [productController::class,'add']);
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/editData', [ProductController::class,'edit']);
Route::put('/updateData', [ProductController::class,'update']);
Route::get('/delete', [ProductController::class,'delete']);
Route::get('/products/data', [ProductController::class, 'getProducts'])->name('products.data');

Route::post('/newDataRecipet', [recipetController::class,'store']);
Route::get('/index', [recipetController::class, 'index'])->name('recipet.index');
Route::get('/editDataIndex/{id}', [recipetController::class, 'edit']);
Route::put('/updateDataIndex/{id}', [recipetController::class,'update']);
Route::get('/delete/{id}', [recipetController::class, 'destroy']);
Route::get('/recipets/data', [RecipetController::class, 'getRecipets'])->name('Recipets.data');

Route::view('/test', 'test');
Route::view('/addNewItem', 'addNew');
Route::view('/profile', 'profile');
Route::view('/contactUs', 'contactUs');
Route::view('/addNewRecipet','newRecipet'); 
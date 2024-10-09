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
Route::get('/delete', [ProductController::class,'delete']);
Route::get('/products/data', [ProductController::class, 'getProducts'])->name('products.data');
Route::get('/productNewItem', [ProductController::class, 'showAddForm'])->name('products.add'); 
Route::get('/api/products', [ProductController::class, 'getProductsName'])->name('products.api');
Route::match(['get','put'], '/editData', [ProductController::class, 'editOrUpdate']);

Route::post('/newDataRecipet', [recipetController::class,'store']);
Route::get('/index', [recipetController::class, 'index'])->name('recipet.index');
Route::get('/delete/{id}', [recipetController::class, 'destroy']);
Route::get('/recipets/data', [RecipetController::class, 'getRecipets'])->name('Recipets.data');
Route::post('/recipetWithSelect', [recipetController::class,'storeSelect']);
Route::match(['get','post'], '/editRecipet/{id}', [RecipetController::class, 'editOrUpdate'])->name('recipet.editOrUpdate');
Route::get('/reciepetNewItem', [recipetController::class, 'showAddForm'])->name('reciepets.add'); 


Route::view('/test', 'test');
Route::view('/addNeww', 'products/addNew');
Route::view('/profile', 'profile/profile');
Route::view('/contactUs', 'contactUs/contactUs');
Route::view('/addNewRecipett','reciepets/newRecipet');
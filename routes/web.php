<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/home',function(){
	return view('tes');
});
Auth::routes();

Route::resource('user', 'admin\UserController');
Route::resource('warehouse', 'admin\WarehouseController');
Route::resource('barang', 'admin\BarangController');
Route::resource('category', 'admin\CategoryController');
Route::resource('subcategory', 'admin\SubCategoryController');
Route::resource('harga', 'admin\HargaController');
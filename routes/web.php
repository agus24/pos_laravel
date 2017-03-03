<?php

// Auth::loginUsingId(2);

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

Route::get('logouts',function(){
	Auth::logout();
});

Auth::routes();

Route::post('ajax/{tipe}','admin\AjaxController@index');
Route::group(['middleware' => 'access'],function(){

	Route::get('user/{id}/change', 'admin\UserController@changePermission')->name('user.user.permission');

	Route::post('user/{id}', 'admin\UserController@updatePermission')->name('user.user.updatePermission');

	Route::resource('user', 'admin\UserController',['as' => 'user']);
	Route::resource('warehouse', 'admin\WarehouseController',['as' => 'warehouse']);
	Route::resource('barang', 'admin\BarangController',['as' => 'barang']);
	Route::resource('category', 'admin\CategoryController',['as' => 'category']);
	Route::resource('subcategory', 'admin\SubCategoryController',['as' => 'subcategory']);
	Route::resource('harga', 'admin\HargaController',['as' => 'harga']);
	Route::resource('customer', 'admin\CustomerController',['as' => 'customer']);
	Route::resource('kartu', 'admin\KartuController',['as' => 'kartu']);
	Route::resource('karyawan', 'admin\KaryawanController',['as' => 'karyawan']);
	Route::resource('stock_card', 'admin\inventory\StockCardController',['as' => 'stock_card']);
	Route::resource('purchase', 'admin\inventory\PurchaseController',['as' => 'purchase']);
	Route::resource('adjustment', 'admin\inventory\AdjustController',['as' => 'adjustment']);

	Route::get('stock_card/search/{search}/order/{by}{tipe}', 'admin\inventory\StockCardController@search',['as' => "stock_card"]);

	Route::get('transfer','admin\inventory\TransferController@index')->name('transfer');
	Route::post('transfer','admin\inventory\TransferController@store')->name('transfer');
	Route::get('transfer/list','admin\inventory\TransferController@listData')->name('transfer');
});

Route::get('tes',function(){
	dd(Auth::user()->warehouse()->get()[0]->name);
});


Route::get('mail',function(){
	$mail = new \App\Mail\Test();

	Mail::to('example@example.com')->send($mail);
});

Route::get('ts',function(){
	Auth::loginUsingId(2);
	$data = App\model\Purchase::getNewNoPurchase(Auth::user()->ware_id);
	dd($data);
});


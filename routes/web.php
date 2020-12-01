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



Route::get('/info', function () {
    return view('info');
});
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/management', function(){
    return view('management.index');
});

Route::resource('management/category', 'Management\CategoryController');
Route::resource('management/menu', 'Management\MenuController');
Route::resource('management/table', 'Management\TableController');


Route::get('/cashier','Cashier\CashierController@index');
Route::get('/cashier/getMenuByCategory/{category_id}','Cashier\CashierController@getMenuByCategory');
Route::post('/cashier/orderFood','Cashier\CashierController@orderFood');

Route::get('/cashier/getTable','Cashier\CashierController@getTable');

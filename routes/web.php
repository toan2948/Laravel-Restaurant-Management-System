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
//method 1: Route::post('/cashier/getSaleDetailsByTable/{table_id}','Cashier\CashierController@getSaleDetailsByTable');
//method 2:
Route::get('/cashier/getSaleDetailsByTable/{table_id}','Cashier\CashierController@getSaleDetailsByTable');

Route::post('/cashier/orderFood','Cashier\CashierController@orderFood');

Route::get('/cashier/getTable','Cashier\CashierController@getTable');
Route::post('/cashier/confirmOrder','Cashier\CashierController@confirmOrder');
Route::post('/cashier/removeMenu','Cashier\CashierController@removeMenu');
Route::post('/cashier/updatePayment','Cashier\CashierController@updatePayment');



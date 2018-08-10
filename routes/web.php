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
    return view('welcome');
});

Route::get('/list_customers', 'ShopifyController@listCustomers');

Route::get('/search_customers', 'ShopifyController@searchCustomers');

Route::get('/get_user_locations', 'ShopifyController@getUserLocation');

Route::post('/add_user_location', 'ShopifyController@addUserLocation');
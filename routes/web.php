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

Route::get('/list_customers', function(){ 
    
    $url = env('SHOPIFY_URL') . '/admin/customers.json';
    $client = new GuzzleHttp\Client();
    $res = $client->get( $url, ['auth' =>  [ env('SHOPIFY_KEY'), env('SHOPIFY_SECRET') ] ]);

    return $res->getBody();
    
});
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

    $client = new GuzzleHttp\Client();
    $res = $client->get( env('SHOPIFY_URL'), ['auth' =>  [ env('SHOPIFY_KEY'), env('SHOPIFY_SECRET') ] ]);

    return $res->getBody();
    
});
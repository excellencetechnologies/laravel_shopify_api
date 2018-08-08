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

Route::get('/getData', function(){ 

    $url = "https://bumbag-dev.myshopify.com/admin/customers.json";
    $user = "0e3c07917f8dc3d8024c096d873405d5";
    $secret = "5ba37853a655552b0391dc852b45139f";   

    $client = new GuzzleHttp\Client();
    $res = $client->get($url, ['auth' =>  [$user, $secret]]);

    return $res->getBody();
    
});
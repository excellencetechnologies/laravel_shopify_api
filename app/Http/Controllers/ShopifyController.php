<?php

namespace App\Http\Controllers;

use Location;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ShopifyController extends Controller
{
    private $admin;

    public function __construct() 
    {
        $this->admin = "/admin";
    }

    public function listCustomers()
    {
        $url = env('SHOPIFY_URL') . $this->admin . '/customers.json';
        $client = new Client();
        $res = $client->get( $url, ['auth' =>  [ env('SHOPIFY_KEY'), env('SHOPIFY_SECRET') ] ]);

        return $res->getBody();
    }

    public function searchCustomers()
    {
        $data = request()->only('query');        
        
        if($data == null || $data == ""){
            $url = env('SHOPIFY_URL') . $this->admin . '/customers/search.json';            
        } else {
            $url = env('SHOPIFY_URL') . $this->admin . '/customers/search.json?query=' . $data['query'];
        }
        
        $client = new Client();
        $res = $client->get( $url, ['auth' =>  [ env('SHOPIFY_KEY'), env('SHOPIFY_SECRET') ] ]);

        return $res->getBody();
    }

    public function addUserLocation()
    {
        try {
            $data = request()->all();
            $location = new Location();
            $response = [ 'error' => 0, 'data' => $location->addUserLocation($data) ];

        } catch(Exception $ex) {
            $response = [ 'error' => 1, 'message' => $ex->getMessage() ];
        }

        return response()->json($response);
    }

    public function getUserLocation()
    {
        try {
            $location = new Location();
            $response = [ 'error' => 0, 'data' => $location->getUserLocation() ];

        } catch(Exception $ex) {
            $response = [ 'error' => 1, 'message' => $ex->getMessage() ];
        }

        return response()->json($response);
    }
}



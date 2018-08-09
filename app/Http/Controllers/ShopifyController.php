<?php

namespace App\Http\Controllers;

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
        $url = env('SHOPIFY_URL') . $this->admin . '/customers/search.json?query=' . $data;
        $client = new Client();
        $res = $client->get( $url, ['auth' =>  [ env('SHOPIFY_KEY'), env('SHOPIFY_SECRET') ] ]);

        return $res->getBody();
    }
}



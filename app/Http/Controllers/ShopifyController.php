<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ShopifyController extends Controller
{
    public function listCustomers()
    {
        $url = env('SHOPIFY_URL') . '/admin/customers.json';
        $client = new Client();
        $res = $client->get( $url, ['auth' =>  [ env('SHOPIFY_KEY'), env('SHOPIFY_SECRET') ] ]);

        return $res->getBody();
    }
}

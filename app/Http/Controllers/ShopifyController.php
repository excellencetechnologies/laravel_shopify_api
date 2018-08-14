<?php

namespace App\Http\Controllers;


use Exception;
use App\Location;
use App\Search;
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
        try {
            $search = new Search();
            $response = [ 'error' => 0, 'data' => $search->listCustomers() ];
            
        } catch (Exception $ex) {
            $response = [ 'error' => 1, 'message' => $ex->getMessage() ];
        }

        return $response;
    }

    public function searchCustomers()
    {
        try {
            $data = request()->all();
            $search = new Search();
            $response = [ 'error' => 0, 'data' => $search->searchCustomers($data) ];
            
        } catch (Exception $ex) {
            $response = [ 'error' => 1, 'message' => $ex->getMessage() ];
        }

        return $response;
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

        return $response;
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

    public function getUserId()
    {
        try {
            $data = request()->all();
            $search = new Search();
            $response = [ 'error' => 0, 'data' => $search->getUserId($data) ];

        } catch (Exception $ex) {
            $response = [ 'error' => 1, 'message' => $ex->getMessage() ];
        }

        return $response;
    }
}



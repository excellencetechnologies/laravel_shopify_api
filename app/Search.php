<?php

namespace App;

use Exception;
use DOMDocument;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
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

        return json_decode($res->getBody()->getContents());
    }

    public function searchCustomers($data)
    {
        $client = new Client();

        if($data == null || $data == ""){
            
            $url = env('SHOPIFY_URL') . $this->admin . '/customers/search.json';        
            $res = $client->get( $url, ['auth' =>  [ env('SHOPIFY_KEY'), env('SHOPIFY_SECRET') ] ]);
            $response[] = json_decode($res->getBody()->getContents());
                
        } else {

            if (array_key_exists('limit', $data)){

                if($data['limit'] == null || $data['limit'] == ""){
                    $limit = 50;                    
                } else {
                    $limit = $data['limit'];
                }
                
            } else {
                $limit = 50;
            }
            
            $params = explode(',', $data['query']);
            $tempArray = [];
            
            for($i = 0; $i < count($params); $i++){
                $url = env('SHOPIFY_URL') . $this->admin . '/customers/search.json?query=' . $params[$i] . '&limit=' . $limit;
                $res = $client->get( $url, ['auth' =>  [ env('SHOPIFY_KEY'), env('SHOPIFY_SECRET') ] ]);
                $customers = json_decode($res->getBody()->getContents(), true);
                $tempArray = array_merge($tempArray, $customers['customers']);
            }

            $response = array_unique($tempArray, SORT_REGULAR);
        }
        
        return $response;
    }

    public function getUserId($data)
    {
        if($data == null || $data == "") {
            throw new Exception('Please provide a username.');
        }

        if($data['username'] == ""){
            throw new Exception('Please provide a username value.');
        }

        $username = $data['username'];
                
        $html = file_get_contents("http://instagram.com/" . $username);                   
        $doc = new DOMDocument();
        $doc->loadHTML($html);    
        $textContent = $doc->textContent;
        $start = strpos($textContent, 'window._sharedData = {');
        $subStr = substr($textContent, $start + strlen('window._sharedData = '));
        $end = strpos($subStr, ';');
        $json = substr($subStr,0, $end);
        $userData = json_decode($json);
        $ProfilePage = $userData->entry_data->ProfilePage;
        
        return $ProfilePage[0]->graphql->user->id;
    }
}

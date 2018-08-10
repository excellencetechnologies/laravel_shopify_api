<?php

namespace App;

use DB;
use Exception;
use Validator;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'user_location';

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function addUserLocation($data)
    {
        if(empty($data)){
            throw new Exception('Please add data.');
        }

        for($i = 0; $i < count($data); $i++){
            $loc = new Location();
            $loc->address = $data[$i]['address'];
            $loc->location = $data[$i]['location'];
            $loc->save();
            $location[] = $loc;
        }

        return $location;        
    }

    public function getUserLocation()
    {
        $data = DB::table('user_location')->select('id', 'address', 'location')->get();
        
        if(count($data) < 1){
            throw new Exception('No Records Found.');
        }

        return $data;
    }
}

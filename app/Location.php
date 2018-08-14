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
        $validator = Validator::make($data, [
            'address' => 'required',
            'location' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);            
        }  

        $location = new Location();
        $location->address = $data['address'];
        $location->location = $data['location'];
        $location->save();

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

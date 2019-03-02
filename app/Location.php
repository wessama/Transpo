<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

	public function list()
	{
		return Location::all();
	}

	public function list_allowed_locations($allowed_location_id)
	{
		return Location::whereIn('id', $allowed_location_id)->get();
	}

	public static function get_location($id)
	{
		return Location::select('address')->where('id', $id)->get();
	}

    public function MeetingPoint(){

    	return $this->hasMany(MeetingPoint::class);

    }

    public function LocationPermission()
    {
    	return $this->hasMany(LocationPermission::class);
    }

    public function Geolocation()
    {
    	return $this->hasMany(Geolocation::class);
    }
}

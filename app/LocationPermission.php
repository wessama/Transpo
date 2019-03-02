<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationPermission extends Model
{

	public function get_allowed_locations($user_id)
	{
		return LocationPermission::select('location_id')->where('user_id', $user_id)->get();
	}

	public function User()
	{
		return $this->belongsTo(User::class);
	}

    public function Location()
    {
    	return $this->belongsTo(Location::class);
    }
}

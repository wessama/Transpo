<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingPoint extends Model
{
    public function list_by_location($location_id)
    {
        return MeetingPoint::where('location_id', $location_id)
                             ->pluck('id', 'name');
    }

    public function get_meeting_points($location_id)
    {
        return MeetingPoint::where('location_id', $location_id)->get();
    }

	public function list(){
		return MeetingPoint::all();
	}

    public function Location(){
    	return $this->belongsTo(Location::class);
    }

    public function Schedule(){
    	return $this->hasMany(Schedule::class);
    }

    public function UserDetails(){
    	return $this->hasMany(UserDetails::class);
    }

    public function BusStop()
    {
    	return $this->hasMany(BusStop::class);
    }
}

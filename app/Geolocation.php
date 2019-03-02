<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
	protected $guarded = [];

    public function Location()
    {
    	return $this->belongsTo(Location::class);
    }

    public function edit($request)
    {
    	return Geolocation::updateOrCreate(
    										[
    										 'location_id' => $request->location_id,
    										],
    										[
    										 'lat' => $request->lat,
    										 'long' => $request->lng
    										]);
    }

    public function get_position($location_id)
    {
    	return Geolocation::where('location_id', $location_id)->get();
    }
}

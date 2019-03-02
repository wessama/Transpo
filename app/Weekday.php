<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekday extends Model
{
    public static function list(){

		return Weekday::all();
	}

	public static function get_day($weekday_id){

		return Weekday::select('day')->where('id', $weekday_id)->get();
	}

	public function BusStop()
	{
		return $this->hasMany(BusStop::class);
	}
}

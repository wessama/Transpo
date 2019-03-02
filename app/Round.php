<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RoundType;

class Round extends Model
{
    public static function getArrivalTimes()
    {
    	return Round::whereIn('round_type_id', (new RoundType)->getArrival_ID())->get();
    }

    public function getRoundType($round_id)
    {
    	return Round::select('round_type_id')->where('id', $round_id)->get();
    }

    public static function getDepartureTimes()
    {
    	return Round::whereIn('round_type_id', (new RoundType)->getDeparture_ID())->get();
    }

    public function RoundType()
    {
    	return $this->belongsTo(RoundType::class);
    }

    public function BusStop()
    {
    	return $this->hasMany(BusStop::class);
    }
}

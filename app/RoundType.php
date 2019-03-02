<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoundType extends Model
{
	public function getArrival_ID()
	{
		return RoundType::select('id')->where('type', 'arrival')->get();
	}

	public function getDeparture_ID()
	{
		return RoundType::select('id')->where('type', 'departure')->get();
	}

    public function Round()
    {
    	$this->hasMany(Round::class);
    }
}

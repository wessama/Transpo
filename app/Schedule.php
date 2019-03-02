<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function MeetingPoint(){
    	return $this->belongsTo(MeetingPoint::class);
    }
}

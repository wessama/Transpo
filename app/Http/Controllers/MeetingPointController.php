<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MeetingPoint;

class MeetingPointController extends Controller
{
    public function getMeetingPoints($location_id)
    {
    	return (new MeetingPoint)->list_by_location($location_id);
    }
}

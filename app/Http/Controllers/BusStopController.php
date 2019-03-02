<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Facades\Voyager;
use App\BusStop;
use App\RoundType;
use App\Round;
use App\Location;
use App\MeetingPoint;
use App\LocationPermission;
use Illuminate\Support\Carbon;
use Auth;

class BusStopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request)
	{
		if(!Voyager::can('browse_bus_stops')){
			return redirect()->route('home')->with('warning', 'You are not authorized to view this page.');
		}

        /* START CONSTANTS */
        $rounds = (new Round)->getArrivalTimes();        

        $round_type_id = (new RoundType)->getArrival_ID();
        /* END CONSTANTS */


        /* START VARIABLES */
        if(Voyager::can('browse_locations')){
            $locations = (new Location)->list();
        }else{
            $locations = (new Location)->list_allowed_locations((new LocationPermission)->get_allowed_locations(Auth::user()->id));
        }

        if($request->id)
        {
            $current_round = $request->id;
        }else{
            $current_round = $rounds->first()->id;
        }

        if($request->day)
        {
            $weekday_id = $request->day;
        }else{
            $weekday_id = Carbon::now()->dayOfWeek;
        }

        if($request->location)
        {
            $points = (new MeetingPoint)->get_meeting_points($request->location);
        }else{
            $points = Auth::user()->LocationPermission[0]->Location->MeetingPoint;
        }
        /* END VARIABLES */

        $point_count = [];

        $point_names = [];

        $BusStop = new BusStop;

        foreach($points as $point)
        {
            $point_count[$point->id] = $BusStop->getMeetingPointCount($point->id, $weekday_id, $round_type_id[0]->id, $current_round);

            $BusStopDetails = $BusStop->getBusStops($point->id, $weekday_id, $round_type_id[0]->id, $current_round);

             if($point_count[$point->id] == 0)
             {
               $point_names[$point->id] = array();
               $point_names[$point->id][] = array();
             }
            
            $StopDetails = [];

            foreach($BusStopDetails as $Stop)
            {
               
                //$StopDetails[] = $Stop->User->name;
               
                $point_names[$point->id][] = $Stop->User->name;
                
            }
        }

		return view('dashboard.stops', compact('points', 'point_count', 'point_names', 'rounds', 'locations'));
	}

    public function secondaryIndex(Request $request)
    {

        if(!Voyager::can('browse_bus_stops')){
            return redirect()->route('home')->with('warning', 'You are not authorized to view this page.');
        }

        /* START CONSTANTS */
        $rounds = (new Round)->getDepartureTimes();        

        $round_type_id = (new RoundType)->getDeparture_ID();
        /* END CONSTANTS */


        if(Voyager::can('browse_locations')){
            $locations = (new Location)->list();
        }else{
            $locations = (new Location)->list_allowed_locations((new LocationPermission)->get_allowed_locations(Auth::user()->id));
        }

        if($request->id)
        {
            $current_round = $request->id;
        }else{
            $current_round = $rounds->first()->id;
        }

        if($request->day)
        {
            $weekday_id = $request->day;
        }else{
            $weekday_id = Carbon::now()->dayOfWeek;
        }

        if($request->location)
        {
            $points = (new MeetingPoint)->get_meeting_points($request->location);
        }else{
            $points = Auth::user()->LocationPermission[0]->Location->MeetingPoint;
        }
        /* END VARIABLES */

        $point_count = [];

        $point_names = [];

        $BusStop = new BusStop;

        foreach($points as $point)
        {
            $point_count[$point->id] = $BusStop->getMeetingPointCount($point->id, $weekday_id, $round_type_id[0]->id, $current_round);

            $BusStopDetails = $BusStop->getBusStops($point->id, $weekday_id, $round_type_id[0]->id, $current_round);

             if($point_count[$point->id] == 0)
             {
               $point_names[$point->id] = array();
               $point_names[$point->id][] = array();
             }
            
            $StopDetails = [];

            foreach($BusStopDetails as $Stop)
            {
               
                //$StopDetails[] = $Stop->User->name;
               
                $point_names[$point->id][] = $Stop->User->name;
                
            }
        }

        return view('dashboard.leaving', compact('points', 'point_count', 'point_names', 'rounds', 'locations'));

    }

    public function store(Request $request, BusStop $BusStop)
    {
    	if($request->ajax()){

    		$validator = Validator::make($request->all(), [
    			'day' 	 => 'required|numeric',
    			'round' => 'required|numeric'
    		]);

    		if($validator->fails()){
    			return response()->json([ 'errors' => $validator->errors()->all()]);
    		}

    		$BusStop->store($request, Auth::user());

    		return response()->json(["message" => 'Blank',
    								]);
    	}

    	return response()->json([
    							"errors" => "An error occured while attempting to save your changes. Refresh the page and try again",
    							]);
    }

    public function destroy(Request $request)
    {
        $BusStop = (new BusStop)->remove(Auth::user()->id, $request->id);

        return redirect()->back()->with('success', 'Schedule successfully updated!');
    }
}

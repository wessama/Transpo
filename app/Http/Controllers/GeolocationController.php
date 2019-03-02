<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Geolocation;


class GeolocationController extends Controller
{
    public function index()
    {
    	return view('dashboard.tracker');
    }

    public function user_view()
    {
    	if(!auth()->user()->UserDetails()->exists())
    	{
    		return redirect()->route('home')->with('warning', 'You need to set your location info before proceeding');
    	}

    	return view('dashboard.location');
    }

    public function update(Request $request, Geolocation $model)
    {
    	if($request->ajax())
    	{
    		$model->edit($request);

    		return response()->json(['message' => 'Location successfully updated'], 200, [], JSON_NUMERIC_CHECK);
    	}
    	
    	return response()->json(['message' => 'An error has occured'], 500, [], JSON_NUMERIC_CHECK);
    }

    public function show(Request $request, Geolocation $model)
    {
    	if($request->ajax())
    	{
    		$position = $model->get_position($request->location_id);

    		return response()->json(['lat' => $position[0]->lat, 'lng' => $position[0]->long], 200, [], JSON_NUMERIC_CHECK);
    	}

    	return response()->json(['message' => 'An error has occured'], 500, [], JSON_NUMERIC_CHECK);
    }
}

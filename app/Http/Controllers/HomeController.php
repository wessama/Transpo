<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\BusStop;
use App\Round;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        $meeting_point_validator = $user->UserDetails['meeting_point_id'] ? true : false;

        $primary_round = (new Round)->getArrivalTimes()->first()->round;

        $Carbon = new Carbon;
        $BusStop = new BusStop;

        $weekday_id = Carbon::now()->dayOfWeek;

        $BusDetails = [];

        $ArrivalDetails = $BusStop->getUserArrivalDetails($user->id, $weekday_id);

        if($ArrivalDetails->count() > 0)
        {
            if($BusStop->getUserArrivalRound($user->id, $weekday_id)->first()->round_id == $primary_round)
            {
                $BusDetails['arrival_time'] = $ArrivalDetails->first()->MeetingPoint->Schedule->first()->time;
            }
            else
            {
                $BusDetails['arrival_time'] = $ArrivalDetails->first()->MeetingPoint->Schedule->first()->time_alt;
            }
        }

        $DepartureDetails = $BusStop->getUserDepartureDetails($user->id, $weekday_id);

        if($DepartureDetails->count() > 0)
        {
            $BusDetails['departure_time'] = $DepartureDetails->first()->Round->time;
        }

        $info = [];

        $info['phone'] = $user->UserDetails['phone'];

        $info['meeting_point'] = $meeting_point_validator ? $user->UserDetails->MeetingPoint->name : null;

        $info['address'] = $user->UserDetails['address'];

        return view('home', compact('info', 'Carbon', 'meeting_point_validator', 'BusDetails'));
    }
}

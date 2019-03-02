<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Round;

class BusStop extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $guarded = [];

	public function store($request, $auth)
	{
		$round_type_id = (new Round)->getRoundType($request->round);

		return BusStop::updateOrCreate(
		[
			'weekday_id' 		=> $request->day,
			'user_id'	 		=> $auth->id,
			'round_type_id'		=> $round_type_id[0]['round_type_id'],
		],
		[
			'round_id'			=> $request->round,
			'round_type_id'     => $round_type_id[0]['round_type_id'],
			'weekday_id' 		=> $request->day,
			'user_id'	 		=> $auth->id,
			'meeting_point_id'  => $auth->UserDetails['meeting_point_id']
		]);
	}


	public static function getUserArrivalRound($user_id, $weekday_id)
    {
    	return BusStop::select('round_id')
    					->where(['user_id' => $user_id,
    							 'weekday_id' => $weekday_id])
    					->whereIn('round_type_id', (new RoundType)->getArrival_ID())
    					->get();
    					
    }

    public function getUserArrivalDetails($user_id, $weekday_id)
    {
                return BusStop::where(['user_id' => $user_id,
                                 'weekday_id' => $weekday_id])
                                ->whereIn('round_type_id', (new RoundType)->getArrival_ID())
                                ->get();
    }

    public static function getUserDepartureRound($user_id, $weekday_id)
    {
    	return BusStop::select('round_id')
    					->where(['user_id' => $user_id,
    							 'weekday_id' => $weekday_id])
    					->whereIn('round_type_id', (new RoundType)->getDeparture_ID())
    					->get();
    					
    }

    public static function getUserDepartureDetails($user_id, $weekday_id)
    {
        return BusStop::where(['user_id' => $user_id,
                                 'weekday_id' => $weekday_id])
                        ->whereIn('round_type_id', (new RoundType)->getDeparture_ID())
                        ->get();
                        
    }

    public static function getMeetingPointCount($meeting_point_id, $weekday_id, $round_type_id, $round_id)
    {
    	return BusStop::where(['meeting_point_id'=> $meeting_point_id,
                               'weekday_id'=> $weekday_id,
                               'round_type_id' => $round_type_id,
                               'round_id' => $round_id]
                             )->count();
    }

    public function getBusStops($meeting_point_id, $weekday_id, $round_type_id, $round_id){
        
        return BusStop::where(['meeting_point_id'=> $meeting_point_id,
                               'weekday_id'=> $weekday_id,
                               'round_type_id' => $round_type_id,
                               'round_id' => $round_id]
                             )->get();
    }

    public function remove($user_id, $weekday_id)
    {
        $BusStop = BusStop::where(['user_id' => $user_id, 'weekday_id' => $weekday_id]);

        $BusStop->delete();
    }

    public function Weekday()
    {
    	return $this->belongsTo(Weekday::class);
    }

    public function User()
    {
    	return $this->belongsTo(User::class);
    }

    public function MeetingPoint()
    {
    	return $this->belongsTo(MeetingPoint::class);
    }

    public function Round()
    {
    	return $this->belongsTo(Round::class);
    }
}

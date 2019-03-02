<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $guarded = [];

    public function getDetails($id){

    	$userDetails = UserDetails::where('user_id', '=', $id);

    	if($userDetails->exists()){

    		return $userDetails->get();

    	}else{

    		return NULL;
    	}

    }

    public function store($request, $id){

        $student_level = UserDetails::setStudentLevel($request->get('student_id'));

    	UserDetails::updateOrInsert(
		[
			'user_id'	 => $id
		],
		[	
			'user_id'	       => $id,
			'student_id'       => $request->get('student_id'),
			'phone'		       => $request->get('phone'),
            'meeting_point_id' => $request->get('meeting_point'),
            'address'          => $request->get('address1')." ".$request->get('address2'),
            'emgc_contact'     => $request->get('emgc_contact'),
            'student_level'    => $student_level
		]);

    }

    public static function setStudentLevel($student_id){

        $year = \Carbon\Carbon::now();

        $student_year = substr($student_id, 0, 2);

        $Level = $year->format('y') - $student_year;

        switch($Level){
            case 0:
            return StudentLevel::FRESHMAN;
            break;
            case 1:
            return StudentLevel::SOPHOMORE;
            break;
            case 2:
            return StudentLevel::JUNIOR;
            break;
            case 3: 
            return StudentLevel::SENIOR;
            break;
            default:
            return StudentLevel::REGULAR;
        }

    }

    public function checkIfExists($user_id){
    	return UserDetails::where('user_id', $user_id)->exists();
    }

    public function MeetingPoint(){
        return $this->belongsTo(MeetingPoint::class);
    }

     public function User(){
    	return $this->belongsTo(User::class);
    }
}

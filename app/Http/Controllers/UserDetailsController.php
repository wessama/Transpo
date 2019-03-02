<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserDetails;
use App\Faculty;
use App\User;
use App\Location;
use App\MeetingPoint;

class UserDetailsController extends Controller{

	public function __construct(){

		$this->middleware('auth');

	}

	public function index(){

		$info = (new UserDetails)->getDetails(Auth::user()->id);

		$locations = (new Location)->list();

		$MeetingPoints = (new MeetingPoint)->list();

		return view('account.profile', compact('info', 'MeetingPoints', 'locations'));
	}

	public function store(Request $request){

	$messages = [
		'student_id.required' 		=> 'We need your student ID',
		'student_id.numeric'  		=> 'Faculty ID must be in the correct format: 2018/12345 would be 1812345',
		'phone.required'			=> 'We need your phone number',
		'phone.phone_number'  		=> 'Your phone number must start with 1 and be 10 numbers long',
		'emgc_contact.phone_number'	=> 'Your emergency contact number must start with 1 and be 10 numbers long',
		'emgc_contact.required'		=> 'You must add an emergency contact',
		'meeting_point.required'	=> 'You must choose a meeting point'
		];

	$this->validate($request, [
			'student_id' 	=> 'required|numeric',
			'phone'		 	=> 'phone_number|required',
			'emgc_contact'	=> 'phone_number|required',
			'meeting_point'	=> 'required'
		], $messages);


	$UserDetails = (new UserDetails)->store($request, Auth::user()->id);

	return back()->with('success', 'Changes successfully saved!');

	}

	public function check(){
		return (new UserDetails)->checkIfExists(Auth::user()->id);
	}

}
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Auth;


class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function UserDetails(){
        return $this->hasOne(UserDetails::class);
    }


    public function edit($request){

        $user = Auth::user();

        User::where('id', $user->id)->update([
            'name' => $request->get('name'),
            'email' => ($request->get('email') == "") ? $user->email : $request->get('email'),
            'password' => $request->get('password') ? Hash::make($request->get('password')) : $user->password
        ]);

    }

    public function BusStop()
    {
        return $this->hasMany(BusStop::class);
    }

    public function LocationPermission()
    {
        return $this->hasMany(LocationPermission::class);
    }
}

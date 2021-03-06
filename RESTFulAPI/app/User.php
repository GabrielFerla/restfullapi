<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    protected $dates = ['deleted_at'];   
    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // public function setNameAttribute($value)
    //     {
    //         $this->attributes['name'] = strtolower($name);
    //     }

    // public function getNameAttribute($value)
    // {
    //     return ucwords($name);
    // }

    // public function setEmailAttribute($value)
    // {
    //     $this->attributes['email'] = strtolower($email);
    // }
 

    public function isVerified()
    {
        return $this->status == User::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->status == User::ADMIN_USER;
    }
    
    public static function generateVerificationCode(){
        
        return  'awdçkjhawiduwahdwaddwaçijhdawdwad';
    }

}

<?php

namespace App;

use App\Profile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Company;
use App\Venue;

use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Billable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, LogsActivity, Billable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'stripe_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected function setPasswordAttribute($value)
    {
        if($value){
            $this->attributes['password']= app('hash')->needsRehash($value)?Hash::make($value):$value;
        }
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function company(){
        return $this->hasOne(Company::class);
    }
    public function venue(){
        return $this->hasOne(Venue::class);
    }
    public function propertyphotos(){
        return $this->hasMany(PropertyPhotos::class);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'cname',
        'user_id',
        'slug',
        'address',
        'phone_number',
        'website',
        'logo',
        'cover_photo',
        'slogan',
        'description',
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function properties() {
        return $this->hasMany('App\Property');
    }
}

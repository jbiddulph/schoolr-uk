<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Venue extends Model
{
    use Notifiable, LogsActivity;
    protected $fillable = ['id', 'school', 'byb_type', 'address_1', 'address_2', 'town', 'county',
        'postcode', 'telephone', 'latitude', 'longitude', 'website', 'photo', 'is_live'];

    public function events() {
        return $this->hasMany('App\Event');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function tagins() {
        return $this->hasMany('App\Tagin');
    }
}

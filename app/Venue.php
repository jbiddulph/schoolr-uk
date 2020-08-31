<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Venue extends Model
{
    use Notifiable, LogsActivity;
    protected $fillable = ['id', 'venuename', 'venuetype', 'address', 'address2', 'town', 'county',
        'postcode', 'postalsearch', 'telephone', 'latitude', 'longitude', 'website', 'photo', 'is_live'];

    public function events() {
        return $this->hasMany('App\Event');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}

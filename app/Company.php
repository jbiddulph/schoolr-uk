<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use Notifiable, LogsActivity;
    protected $fillable = [
        'cname',
        'user_id',
        'slug',
        'address',
        'telephone',
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

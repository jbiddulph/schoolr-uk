<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Company extends Model
{
    use Notifiable, LogsActivity, Billable, HasRoles;
    protected $fillable = [
        'cname',
        'user_id',
        'slug',
        'address_1',
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

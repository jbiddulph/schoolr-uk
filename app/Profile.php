<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Profile extends Model
{
    use Notifiable, LogsActivity;
    protected $guarded = [];
}

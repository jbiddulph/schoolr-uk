<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Tagin extends Model
{
    use Notifiable, LogsActivity;
    protected $guarded = [];

    public function venue() {
        return $this->belongsToMany(Venue::class);
    }
}

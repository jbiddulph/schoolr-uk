<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    use Notifiable, LogsActivity;
    protected $fillable = ['venue_id', 'eventName', 'eventDate', 'eventTime', 'eventCategory', 'eventCost'];

    public function venue() {
        return $this->belongsTo(Venue::class);
    }


}

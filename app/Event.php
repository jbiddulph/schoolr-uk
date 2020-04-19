<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    use Notifiable, LogsActivity, SoftDeletes;
    protected $fillable = ['venue_id', 'eventName', 'slug', 'eventPhoto', 'eventDate', 'eventTimeStart', 'eventTimeEnd', 'eventType', 'eventCost', 'is_live'];

    public function venue() {
        return $this->belongsTo(Venue::class);
    }


}

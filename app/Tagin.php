<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Tagin extends Model
{
    use Notifiable, LogsActivity;

    protected $fillable = ['venue_id','phone_number','email_address', 'reason_visit', 'marketing'];

    public function venue() {
        return $this->belongsTo(Venue::class);
    }
}

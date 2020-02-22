<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function getRouteKeyName() {
        return 'slug';
    }

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function propertyphotos() {
        return $this->hasMany('App\PropertyPhotos');
    }
}

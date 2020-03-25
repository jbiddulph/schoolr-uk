<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyPhotos extends Model
{

    protected $guarded = [];
    //
    public function property() {
        return $this->belongsTo('App\Property');
    }
}

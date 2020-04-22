<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Property extends Model
{
    use Notifiable, LogsActivity;
//    protected $fillable = ['user_id', 'company_id', 'propname', 'slug', 'propcost', 'proptype_id', 'propimage',
//        'bedroom', 'bathroom', 'kitchen', 'garage', 'reception', 'conservatory', 'outbuilding', 'address',
//        'town', 'othertown', 'county', 'postcode', 'latitude', 'longitude', 'short_summary', 'description', 'summary', 'floorplan', 'brochure',
//        'last_date', 'category_id', 'is_featured', 'is_live'];

    protected $guarded = ['*'];
    public function getRouteKeyName() {
        return 'slug';
    }

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function propertyphotos() {
        return $this->hasMany('App\PropertyPhotos');
    }
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function checkInterest() {
        return \DB::table('property_user')->where('user_id', auth()->user()->id)
            ->where('property_id', $this->id)->exists();
    }
    public function favourites() {
        return $this->belongsToMany(Property::class, 'favourites',
            'prop_id', 'user_id')->withTimestamps();
    }
    public function checkSaved() {
        return \DB::table('favourites')->where('user_id', auth()->user()->id)
            ->where('prop_id', $this->id)->exists();
    }
}

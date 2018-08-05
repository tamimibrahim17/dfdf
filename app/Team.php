<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use HipsterJazzbo\Landlord\BelongsToTenants;

class Team extends Model
{
    use SoftDeletes, BelongsToTenants;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'school_id', 'owner_id',
    ];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}

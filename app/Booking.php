<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use HipsterJazzbo\Landlord\BelongsToTenants;

class Booking extends Model
{
    use SoftDeletes, BelongsToTenants;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'owner_id', 'booking_type_id', 'name', 'date', 'start', 'end', 'description', 'repeated', 'team_id', 'slot_status',
    ];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function booking_type()
    {
        return $this->belongsTo('App\BookingType');
    }

    /**
     * Get the user associated with the booking.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * Get the team associated with the booking.
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function reservations()
    {
        return $this->belongsToMany('App\User', 'booking_reservation')->withTimestamps();
    }
}

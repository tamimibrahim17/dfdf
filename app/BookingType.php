<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingType extends Model
{
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}

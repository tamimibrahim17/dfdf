<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, BelongsToTenants, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'school_id', 'phone', 'address', 'zip', 'city'
    ];

    protected $appends = ['role'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team')->withTimestamps();
    }

    public function bookings()
    {
        return $this->belongsToMany('App\Booking')->withTimestamps();
    }

    public function reservedBookings()
    {
        return $this->belongsToMany('App\Booking', 'booking_reservation')->withTimestamps();
    }

    public function ownedBookings()
    {
        return $this->hasMany('App\Booking', 'owner_id');
    }

    public function getRoleAttribute()
    {
        return strtolower($this->roles()->first()->name);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use HipsterJazzbo\Landlord\BelongsToTenants;

class Lesson extends Model
{
    use SoftDeletes, BelongsToTenants;

    protected $fillable = [
        'school_id', 'user_id', 'category_id', 'name', 'saved',
    ];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Module')->withTimestamps();
    }
}

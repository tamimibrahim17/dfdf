<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'period',
    ];

    public function lessons()
    {
        return $this->belongsToMany('App\Lesson')->withTimestamps();
    }

    public function legalItems()
    {
        return $this->belongsToMany('App\LegalItem')->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function legalItems()
    {
        return $this->hasMany('App\LegalItem');
    }
}

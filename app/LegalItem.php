<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegalItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'name',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Module')->withTimestamps();
    }
}

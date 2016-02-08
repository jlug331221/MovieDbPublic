<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    protected $fillable = [
        'title',
        'country',
        'release_date',
        'parental_rating',
        'runtime',
        'synopsis'
    ];

    public function credits()
    {
        return $this->hasMany('Credit');
    }
}

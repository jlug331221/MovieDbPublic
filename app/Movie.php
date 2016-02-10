<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'country',
        'release_date',
        'parental_rating',
        'runtime',
        'synopsis'
    ];

    /**
     * A movie contains zero or more credits.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credits()
    {
        return $this->hasMany('App\Credit');
    }

    /**
     * A movie is associated with multiple reviews.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}

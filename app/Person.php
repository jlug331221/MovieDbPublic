<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'first_alias',
        'middle_alias',
        'last_alias',
        'country_of_origin',
        'date_of_birth',
        'date_of_death',
        'biography'
    ];

    /**
     * A person may have zero or more credits in a movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credits()
    {
        return $this->hasMany('App\Credit');
    }
}

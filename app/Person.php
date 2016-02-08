<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

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

    public function credits()
    {
        return $this->hasMany('Credit');
    }
}

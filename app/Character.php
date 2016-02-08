<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model {

    protected $fillable = [
        'name', 'biography'
    ];

    public function credits()
    {
        return $this->hasMany('Credit');
    }
}

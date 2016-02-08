<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditType extends Model {

    protected $fillable = [
        'type'
    ];

    public function credits()
    {
        return $this->hasMany('Credit');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model {

    protected $fillable = [];

    public function movie()
    {
        return $this->belongsTo('Movie');
    }

    public function people()
    {
        return $this->belongsTo('Person');
    }

    public function creditType()
    {
        return $this->belongsTo('CreditType');
    }

    public function character()
    {
        return $this->belongsTo('Character');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonList extends Model
{
    //
    protected $fillable = [
        'masterlist_id'
    ];

    public function masterlist()
    {
        return $this->belongsTo('App\Masterlist');
    }

    public function people()
    {
        return $this->belongsToMany('App\Person');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditType extends Model {

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];

    /**
     * A credit type is applicable to zero or more credits.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credits()
    {
        return $this->hasMany('App\Credit');
    }
}

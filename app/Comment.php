<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'review_id', 'user_id', 'body'
    ];

    /**
     * A comment belongs to a particular review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review()
    {
        return $this->belongsTo('App\Review');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

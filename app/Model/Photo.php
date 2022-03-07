<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path',
        'post_id'
    ];

    public function posts() {
        return $this->belongsTo('App\Model\Post');
    }
}

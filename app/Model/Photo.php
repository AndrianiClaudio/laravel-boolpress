<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path',
        'post_id',
        'slug'
    ];

    public function post() {
        return $this->belongsTo('App\Model\Post');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['imgname'];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}

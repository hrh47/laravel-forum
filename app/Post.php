<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function group()
    {
    	return $this->belongsTo('App\Group');
    }
}

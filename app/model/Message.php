<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['titre','message'];

    function user(){
        return $this->belongsTo('App\model\User');
    }
    public function commentaires()
    {
        return $this->morphMany('App\model\Commentaire', 'commentable')->latest();
    }
}

<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $guarded = [];
    public function commentable()
    {
        return $this->morphTo();
    }
    function user(){
        return $this->belongsTo('App\model\User');
    }
    public function commentaires()
    {
        return $this->morphMany('App\model\Commentaire', 'commentable')->latest();
    }
}

<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    protected $fillable = ['prenom_auteur','nom_auteur','date_naissance_auteur','nationalite_auteur'];

    public function livres()
    {
        return $this->hasMany('App\model\Livre');
    }
    
}

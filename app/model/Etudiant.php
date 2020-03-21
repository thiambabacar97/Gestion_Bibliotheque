<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['prenom_etudiant','nom_etudiant','date_naissance_etudiant','nationalite_etudiant'];

}

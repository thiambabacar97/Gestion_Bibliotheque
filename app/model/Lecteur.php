<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Lecteur extends Model
{
    protected $fillable = [ 'code_lecteur  ','nom_lecteur','prenom_lecteur','date_naissance_lecteur','lieux_naissance_lecteur','sexe_lecteur'
    ,'address_lecteur','proffession_lecteur','telephone_lecteur','email_lecteur'];
}

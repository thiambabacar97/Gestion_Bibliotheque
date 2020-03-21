<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Memoire extends Model
{
    protected $fillable=['titre_memoire','nbr_page_memoire','anne_memoire','etudiant_id','domaine_id'];
}

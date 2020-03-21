<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;


class Livre extends Model
{
    protected $fillable = [
        'num_inventaire_livre',
        'titre_livre',  
    	'editeur_livre',
        'isbn_issn_livre', 	
        'date_pub_livre',				
        'nature_livre',
        'nbr_exemplaire_livre', 					
        'couverture_livre',
        'auteur_id',
        'domaine_id'
    ];
    
    public function users()
    {
        return $this->belongsToMany('App\model\User', 'livre_demanders')->withPivot('id','dateEmprunt','dateRetour','etat');
    }
    public function filtered_users()
    {
        return $this->belongsToMany('App\model\User')->wherePivot('id',7);
        // return $this->belongsToMany('App\model\User')->wherePivot('livre_demanders', ['etat','attente']);  // int admin role_id, owner role_id
    }
    public function auteurLivre()
    {
       
        return Auteur::where('id',$this->auteur_id)->first()->prenom_auteur;
    }
    // public function user()
    // {
       
    //     return $this->belongsTo('App\model\User');
    // }
    public function auteur()
    {
       
        return $this->belongsTo('App\model\Auteur');
    }
    public function domaine()
    {
        return $this->belongsTo('App\model\Domaine');
    }
}

<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LivreDemander extends Model
{
   

    public function getUser()
    {
        return User::where('id', $this->user_id)->first();
    }
    public function getLivre()
    {
        return Livre::where('id', $this->livre_id)->first();
    }
    public function getAuteurId()
    {
        return Livre::where('id', $this->livre_id)->first()->auteur_id;
    }
    public function getAuteur()
    {
        return Auteur::where('id',$this->auteur->id);
    }
}

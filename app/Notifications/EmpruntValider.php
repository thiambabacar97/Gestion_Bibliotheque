<?php

namespace App\Notifications;

use App\model\Livre;
use App\model\LivreDemander;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmpruntValider extends Notification
{
    use Queueable;
    protected $livreDemander;
    protected $auteur;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($livreDemander,$auteur)
    {
        $this->livreDemander = $livreDemander;
        $this->auteur = $auteur;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'idlivre'       =>$this->livreDemander->id,
            'titreLivre'     =>$this->livreDemander->titre_livre,
            'auteur'        =>$this->auteur->prenom_auteur.' '.$this->auteur->nom_auteur
        ];
    }
}

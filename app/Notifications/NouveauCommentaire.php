<?php

namespace App\Notifications;

use App\model\Message;
use App\model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class NouveauCommentaire extends Notification
{
    use Queueable;
    protected $user;
    protected $message;
        
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
       
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) 
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'messageTitre'  =>$this->message->titre,
            'messageId'     =>$this->message->id,
            'messageUser'   =>$this->user->first_name.' '.$this->user->last_name
        ];
    }
}

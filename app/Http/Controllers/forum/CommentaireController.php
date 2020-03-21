<?php

namespace App\Http\Controllers\forum;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Commentaire;
use App\model\Message;
use App\model\User;
use App\Notifications\NouveauCommentaire;

class CommentaireController extends Controller
{
    public function store(Message $message )
    {
        request()->validate([
            'content' =>'required|min:5'
        ]);
        $userId = auth()->user()->id;

        $commentaire = new Commentaire();
        $commentaire->content = request('content');
        $commentaire->user_id = $userId;

        $message->commentaires()->save($commentaire);
       //notification
        $message->user->notify(new NouveauCommentaire($message,auth()->user()));

        return redirect()->route('lecteur.forum.show',$message);
       
    }
    public function  store_reponse(Commentaire $commentaire)
    {
        request()->validate([
            'repondre_commentaire' =>'required|min:5'
        ]);
        $userId = auth()->user()->id;

        $reponseCommentaire = new Commentaire();
        $reponseCommentaire->content = request('repondre_commentaire');
        $reponseCommentaire->user_id = $userId;
        $commentaire->commentaires()->save($reponseCommentaire);
        return redirect()->back();
       
    }
   
}

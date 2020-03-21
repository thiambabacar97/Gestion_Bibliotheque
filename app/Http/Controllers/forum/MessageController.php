<?php

namespace App\Http\Controllers\forum;
use App\Http\Controllers\Controller;
use App\model\Message;
use App\model\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::latest()->paginate(3);
        return view('forum.acceuil_forum', compact('messages'));
        // dd($message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre'   => 'required|min:5',
            'message' => 'required|min:10'
        ]);
        
        $user = auth()->user();
        $message = new Message();
        $message->titre   = $request->titre;
        $message->message = $request->message;
        $message->user_id = $user->id;
        $message->save();
        return redirect()->route('lecteur.forum.show',$message->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('forum.message_voire',compact('message'));
    }
    public function show_notification(Message $message,  DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return view('forum.message_voire',compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function return()
    {
        return redirect()->route('lecteur.forum.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $donne=$request->validate([
            'titre'   => 'required|min:5',
            'message' => 'required|min:10'
        ]);
        $message->update($donne);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
    
       $sms = Message::find($message->id);
       $sms->delete();
       return redirect()->route('lecteur.forum.index');
    }
}

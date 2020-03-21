<?php

namespace App\Http\Controllers\lecteur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {

        return view('lecteur.edit_profile',array('user'  => auth()->user()));
    }
    public function update_image(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar=$request->file('avatar');
            $filename=time() . '.' .$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('images/' .$filename));
            $user=auth()->user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('lecteur.edit_profile',array('user'  => auth()->user()));
    }
    public function update_email()
    {
        request()->validate([
            'email' =>['required','email'],
        ],[
            'required'  =>'champ obligatoire',
        ]);
        $user=auth()->user();
        $user->email = request('email');
        $user->save();

        return redirect()->back();
    }

    public function update_password()
    {

        // dd(bcrypt($user->password),bcrypt(request('password_old')));
        request()->validate([
            // 'password_old' =>['required'],
            'password' =>['required','confirmed'],
            'password_confirmation' =>['required'],

        ],[
            'required'  =>'champ obligatoire',
            'confirmed' =>'entrez le meme password'
        ]);
        $user=auth()->user();
        $user->password =bcrypt(request('password')) ;
        $user->save();
        Auth::logout();;
        return redirect()->route('auth.index');

    }
}


<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;


class ProfileController extends Controller
{
    public function index()
    {

        return view('admin.edit_profile',array('user'  => auth()->user()));
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
        return view('admin.edit_profile',array('user'  => auth()->user()));
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

        return redirect()->route('profile.index');
    }

    public function update_password()
    {
        request()->validate([
            'password' =>['required','confirmed'],
            'password_confirmation' =>['required'],

        ],[
            'required'  =>'champ obligatoire',
            'confirmed' =>'entrez le meme password'
        ]);
        $user=auth()->user();
        $user->password =bcrypt(request('password')) ;
        $user->save();

        return redirect()->route('profile.index');
    }
}

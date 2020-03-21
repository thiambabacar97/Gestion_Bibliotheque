<?php

namespace App\Http\Controllers\authentification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{


    public function index()
    {
        return view('authentification.connexion');
    }

    function connect(Request $request)
    {
        $request->validate([
            'email'     =>['required','email'],
            'password'  =>['required'],
        ]);
        // $request->user()->authorizeRole(['employee', 'manager']);

       Auth::attempt(['email' =>$request->email, 'password' =>$request->password]);
        // // dd($verifConnect);
        // $verifRolAdmin= auth()->user()->hasRole('admin');
        // $verifRolecteur= auth()->user()->hasRole('lecteur');
        // // dd(  $verifRolAdmin);
     if (auth()->check() && auth()->user()->hasRole('admin')) {
        return redirect('/administrateur');
      }
      elseif(auth()->check() && auth()->user()->hasRole('lecteur')){
          return redirect()->route('home.index');
      } else{
        return back()->withInput()->withErrors([
            'email' =>'identifiant incorecte'
        ]);
    }

    }
    public function logout()
    {
            Auth::logout();;
        return redirect()->route('auth.index');
    }
}

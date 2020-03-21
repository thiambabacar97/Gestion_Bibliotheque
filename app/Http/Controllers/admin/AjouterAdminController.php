<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Role;
use App\model\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\Mail;

class AjouterAdminController extends Controller
{
    public function index()
    {

        return view('admin.ajout_admin');

    }

    public static function Genere_Password($taille)
    {
        // Initialisation des caractères utilisables
        $password = '';
        $caractere = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

        for($i=0;$i<$taille;$i++)
        {
            $password .= ($i%2) ? strtoupper($caractere[array_rand($caractere)]) : $caractere[array_rand($caractere)];
        }
            
        return $password;
    }
    public function create(Request $request)
    {
        $request->validate([
            'first_name'      =>['required'],
            'last_name'       =>['required'],
            'email'           =>['email','required','unique:users,email'],
            'telephone'       =>['required','unique:users,telephone'],
            'date_naissance'  =>['required']
        ]);
   
            $user = new User(); 
            $role_admin=Role::where('name', 'admin')->first();
            // dd($role_admin);

            $user->first_name =request('first_name');
            $user->last_name =request('last_name');
            $user->email =request('email');
            $user->telephone =request('telephone');
            $user->date_naissance =request('date_naissance');
            $user->password =bcrypt("admin123");
            
            $user->save();


            $user->roles()->attach($role_admin);
            

        // $user=sentinel::registerAndActivate($donne);
        // $role=sentinel::findRoleByName('admin');
        // $role->users()->attach($user);
        return redirect()->back()->withSuccess("Vous venez d'enrigistrer un nouveau administrateur");
    }
}

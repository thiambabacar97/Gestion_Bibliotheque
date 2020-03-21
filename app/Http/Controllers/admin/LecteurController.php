<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\LivreDemander;
use App\model\Role;
use App\model\User;
use Illuminate\Support\Facades\DB;

class LecteurController extends Controller
{
    public function index()
    {
        return view('admin.ajout_lecteur');
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
            'telephone'       =>['required'],
            'date_naissance'  =>['required']
        ]);
        $role_lecteur=Role::where('name', 'lecteur')->first();
        $lecteur = User::create([
            'first_name'      =>request('first_name'),
            'last_name'       =>request('last_name'),
            'email'           =>request('email'), 
            'telephone'       =>request('telephone'),
            'date_naissance'  =>request('date_naissance'),
            'password'        =>bcrypt("passer123")
        ]);
        $lecteur->roles()->attach($role_lecteur);
        

        return redirect()->back()->withSuccess("Vous venez d'enrigistrer un nouveau Lecteur");

    }
    public function show(Request $request)
    {
       
        if ($request->ajax()) {
            $users = DB::table('users')->select('*');
            return datatables()->of($users)
            ->make(true);
        }
        
        $lecteurs =User::latest()->get();
        
        return view('admin.lister_lecteur',compact('lecteurs'));

    }
    public function show_detail(Request $request)
    {
        $lecteur = User::find($request->id);
       return view('admin.detail_lecteur',['lecteur'=>$lecteur]);
    }
    function update_index(Request $request){
        $lecteur = User::find($request->id);
        return view('admin.update_lecteur',['lecteur' =>$lecteur]);
    }
    function update(Request $request){
       
        $request->validate([
            'first_name'      =>['required'],
            'last_name'       =>['required'],
            'email'           =>['email','required'],
            'telephone'       =>['required','unique:users'],
            'date_naissance'  =>['required']
        ]);
        
        $lecteur = User::find($request->id);
      
        $lecteur->first_name      = $request->first_name;
        $lecteur->last_name       = $request->last_name;
        $lecteur->email           = $request->email;
        $lecteur->telephone       = $request->telephone;
        $lecteur->date_naissance  = $request->date_naissance;
        if ( $lecteur->save()) {
            return redirect()->back();
        }
                
    }
    public function delete(Request $request)
    {
        $lecteur = User::find($request->id);
        $lecteur->delete();
        // return redirect()->route('lecteur.show');

    }
    public function sanction()
    {
        $contenus = DB::table('livre_demanders')
        ->where('etat','valider')
        ->join('livres', 'livres.id', '=', 'livre_demanders.livre_id')
        ->join('users', 'users.id', '=', 'livre_demanders.user_id')
        ->join('auteurs', 'auteurs.id', '=', 'livres.auteur_id')
        ->get();
        dump($contenus);
        return view('admin.sanction_lecteur');
    }
    public function get_User_sanction(Request $request)
    {
        $contenus = DB::table('livre_demanders')
        ->where('etat','valider')
        ->join('livres', 'livres.id', '=', 'livre_demanders.livre_id')
        ->join('users', 'users.id', '=', 'livre_demanders.user_id')
        ->join('auteurs', 'auteurs.id', '=', 'livres.auteur_id')
        ->get();
      
        return view('admin.sanction_lecteur');
    }
    
}

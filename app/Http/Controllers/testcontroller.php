<?php

namespace App\Http\Controllers;

use App\model\Lecteur;
use App\model\Livre;
use App\model\LivreDemander;
use App\model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class testcontroller extends Controller
{
    
       //fonction qui genere les codes des etudiants
       public static function code_lecteur($key)
       {
        $alph = ['A', 'B','C','D', 'E', 'F', 'G', 'H', 'I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $num_c = [];
        for ($i=0; $i < 26; $i++) { 
            for ($j=1; $j <= 30; $j++) { 
                $num_c[] ='BUNMD'.'-'.date('Y').'-'.$alph[$i].$j;
            }
        }
        return $num_c[$key];
    }
    public static function Genere_Password($size)
    {
        // Initialisation des caractères utilisables
        $password = '';
        $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

        for($i=0;$i<$size;$i++)
        {
            $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
        }
            
        return $password;
    }

    public function index()
    {
        // dd(auth()->user());
      
       return view('admin.test');
    }
    public function return()
    {
        
        return redirect()->back();
    }
    public function notFound()
    {
        
        return view('admin.adminNtFound');
    }
    public function livre_show_datatable()
    {
        return view('test');
    }
    public function get_datatable()
    {
        $data = User::latest()->get();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            $button = '<a  href="'.route('lecteur.update', $data->id) .'"data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-success edit-post">Edit</a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a href="javascript:void(0);" id="delete-post" data-toggle="tooltip" data-original-title="Delete" data-id="'.$data->id.'"   class="delete btn btn-danger"> Delete</a>';
            return $button;
            })
        ->rawColumns(['action'])
        ->make(true) ;       
    }

    public function show_livre_demander()
    {
   
        $contenus = DB::table('livre_demanders','livress')
            ->where('etat','attente')
            ->join('livres', 'livres.id', '=', 'livre_demanders.livre_id')
            ->join('users', 'users.id', '=', 'livre_demanders.user_id')
            ->join('auteurs', 'auteurs.id', '=', 'livres.auteur_id')
            ->get();
            //   dd($contenus);
          
           
        return view('test2');

    }
    public function get_livre_demander()
    {
        
     
        $contenus = DB::table('livre_demanders')
            ->where('etat','attente')
            ->join('livres', 'livres.id', '=', 'livre_demanders.livre_id')
            ->join('users', 'users.id', '=', 'livre_demanders.user_id')
            ->join('auteurs', 'auteurs.id', '=', 'livres.auteur_id')
            ->get();
        return DataTables::of($contenus)
        ->addColumn('action', function($data){
            $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-livre_id="'.$data->livre_id.'"   data-User_id="'.$data->user_id.'" data-original-title="Edit" class="edit btn btn-success edit-post">Edit</a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a href="javascript:void(0);" id="delete-post" data-toggle="tooltip" data-original-title="Delete" data-livre_id="'.$data->livre_id.'"   data-User_id="'.$data->user_id.'" class="delete btn btn-danger"> Delete</a>';
            return $button;
            })
            ->rawColumns(['action'])
            ->make(true) ;     
    }
    public function valider_emprunt(Request $request, Livre $livre, User $user)
    {
        $livre = Livre::find($request->livre->id);
        $nbr_exemplaire =$livre->nbr_exemplaire_livre;
        $nombre_exemplaire_preter = LivreDemander::whereEtat('valider')
                                    ->whereLivre_id($request->livre->id)
                                    ->count();

        $a_le_meme_exemplaie_non_rendu =LivreDemander::whereEtat('valider')
                                        ->whereUser_id($request->user->id)
                                        -> whereLivre_id($request->livre->id)
                                        ->count();
        $a_emprunter_trois_exemplaie =LivreDemander::whereEtat('valider')
                                        ->whereUser_id($request->user->id)
                                        ->count();
                                    // dd($nombre_exemplaire_preter,$nbr_exemplaire);
            if ( $nombre_exemplaire_preter <= $nbr_exemplaire ) {
                if ($a_le_meme_exemplaie_non_rendu < 1) {
                    if ($a_emprunter_trois_exemplaie < 3) {
                        LivreDemander::where('id', $request->livre_demander_id)
                                       ->update([
                                           'dateEmprunt' => Carbon::now(),
                                           'dateRetour'  => Carbon::now()->addDays(15),
                                           'etat' => 'valider'
                                       ]);
                        $request->user->notify(new EmpruntValider($request->livre, $request->livre->auteur));
                        $livre_demander =LivreDemander::find($request->livre_demander_id);
                        $user->email =$livre_demander->getUser()->email;
                        $user->notify(new EmpruntValidermail($livre_demander));
                        return back()->withSuccess("Opération reussi"); 
                    }
                    return back()->withDanger("Désolé, le lecteur a déjas  emprunté trois livre");         
                }
                return back()->withDanger("Désolé, le lecteur a dejas un exemplaire de cet livre non rendue");                        
            }
            return back()->withDanger("Désolé, Il n'y a plus d'exemplaires disponible pour cet livre"); 
    }
}

<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Auteur;
use App\model\Emprunt;
use App\model\Livre;
use App\model\LivreDemander;
use App\model\User;
use App\Notifications\EmpruntValider;
use App\Notifications\EmpruntValidermail;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;


class LivreController extends Controller
{ 
   
    public function index()
    {
       $domaine = DB::select('select * from domaines');
       $auteur  = DB::select('select * from auteurs');   
        return view('admin.ajout_livre',['domaine' =>$domaine, 'auteur' =>$auteur]);
    }
    //fonction qui genere les codes des etudiants
    public static function code_lecteur($key){
        $alph = ['A', 'B','C','D', 'E', 'F', 'G', 'H', 'I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $num_c = [];
        for ($i=0; $i < 26; $i++) { 
            for ($j=1; $j <= 30; $j++) { 
                $num_c[] ='BUNMD'.'-'.date('Y').'-'.$alph[$i].$j;
            }
        }
            return $num_c[$key];
         }
    public function create(Request $request)
    {
        $request->validate([
            'titre_livre' 	        =>['required'],
        	'editeur_livre'	        =>['required'],
            'isbn_issn_livre'       =>['required'], 	
            'date_pub_livre'        =>['required'],				
            'nature_livre' 	        =>['required'],
            'nbr_exemplaire_livre'  =>['required'], 					
            'couverture_livre' 	 	=>['required'],
            'auteur_id'             =>['required'],
            'domaine_id'            =>['required']
        ]);
            $livre =new Livre();
            $nblivre =Livre::all()->count();

                $livre->titre_livre	           = $request->titre_livre;
                $livre->editeur_livre	       = $request->editeur_livre;
                $livre->isbn_issn_livre        = $request->isbn_issn_livre; 	
                $livre->date_pub_livre         = $request->date_pub_livre;				
                $livre->nature_livre 	       = $request->nature_livre;
                $livre->nbr_exemplaire_livre   = $request->nbr_exemplaire_livre; 					
                $livre->couverture_livre 	   = $request->couverture_livre;
                $livre->auteur_id              = $request->auteur_id;
                $livre->domaine_id             = $request->domaine_id;
                $livre->num_inventaire_livre   = LivreController::code_lecteur( $nblivre);
                if ($request->hasFile('couverture_livre')) {
                    $couverture_livre=$request->file('couverture_livre');
                    $filename=time() . '.' .$couverture_livre->getClientOriginalExtension(); 
                    Image::make($couverture_livre)->resize(300,300)->save(public_path('images/' .$filename));
                    $livre->couverture_livre = $filename;
                }
                $livre->save(); 
        
                return redirect()->back()->withSuccess("Vous avez ajouter un nouveau livre");     
    }
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $livres=Livre::with('auteur','domaine')->paginate(6);
            return response()->json($livres, 200);

        }
        else {
            $livres=Livre::with('auteur','domaine')->paginate(6);

            return view('admin.lister_livre',compact('livres'));
        }

    }
    public function show_detail()
    {
        $id=request('id');
       if ($id) {
        $livre=Livre::where('id',$id)->get();
        $domaine = DB::select('select * from domaines');
        $auteur  = DB::select('select * from auteurs');   
         return view('admin.details_livre',['livre' =>$livre]);
       }
      
    }
    public function update_index()
    {
        $id=request('id');
        $domaine = DB::select('select * from domaines');
        $auteur  = DB::select('select * from auteurs');
        $input  =  Livre::find($id);
        return view('admin.update_livre',['domaine' =>$domaine, 'auteur' =>$auteur, 'input'  =>$input]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'titre_livre' 	        =>['required'],
        	'editeur_livre'	        =>['required'],
            'isbn_issn_livre'       =>['required'], 	
            'date_pub_livre'        =>['required'],				
            'nature_livre' 	        =>['required'],
            'nbr_exemplaire_livre'  =>['required'], 					
            'couverture_livre' 	 	=>['required'],
            'auteur_id'             =>['required'],
            'domaine_id'            =>['required']
        ]);


        $livre=Livre::find(request('id'));

        $livre->titre_livre	           = $request->titre_livre;
        $livre->editeur_livre	       = $request->editeur_livre;
        $livre->isbn_issn_livre        = $request->isbn_issn_livre; 	
        $livre->date_pub_livre         = $request->date_pub_livre;				
        $livre->nature_livre 	       = $request->nature_livre;
        $livre->nbr_exemplaire_livre   = $request->nbr_exemplaire_livre; 					
        $livre->auteur_id              = $request->auteur_id;
        $livre->domaine_id             = $request->domaine_id;

        if ($request->hasFile('couverture_livre')) {
            $couverture_livre=$request->file('couverture_livre');
            $filename=time() . '.' .$couverture_livre->getClientOriginalExtension(); 
            Image::make($couverture_livre)->resize(300,300)->save(public_path('images/' .$filename));
            $livre->couverture_livre = $filename;  
        }
        $livre->save();
         return redirect()->route('livre.show_detail', ['id' => $livre->id]);
    }
    public function delete(Request $request)
    {
        $livre = Livre::find($request->id);
        $livre->delete();
        return redirect()->route('livre.show');
    }
    public function show_book_ask()
    {
        return view('admin.lister_livre_demander');
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
            $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-livre_id="'.$data->livre_id.'"   data-User_id="'.$data->user_id.'" data-original-title="Edit" class="edit btn btn-success edit-post">Valider</a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a href="javascript:void(0);" id="delete-post" data-toggle="tooltip" data-original-title="Delete" data-livre_id="'.$data->livre_id.'"   data-User_id="'.$data->user_id.'" class="delete btn btn-danger"> Rejeter</a>';
            return $button;
            })
            ->addColumn('lecteur', function($row){
                return $row->first_name.' '.$row->last_name;
           })
           ->addColumn('auteur', function($row){
            return $row->prenom_auteur.' '.$row->nom_auteur;
            })
            ->rawColumns(['action','lecteur','auteur'])
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
                        LivreDemander::where('etat','attente')
                                       ->whereLivre_id($request->livre->id)
                                       ->whereUser_id($request->user->id)
                                       ->update([
                                           'dateEmprunt' => Carbon::now(),
                                           'dateRetour'  => Carbon::now()->addDays(15),
                                           'etat' => 'valider'
                                       ]);
                        $request->user->notify(new EmpruntValider($request->livre, $request->livre->auteur));       
                                    $contenus = DB::table('livre_demanders')
                                    ->where('etat','attente')
                                    ->where('user_id', request()->user->id)
                                    ->where('livre_id',request()->livre->id)
                                    ->join('livres', 'livres.id', '=', 'livre_demanders.livre_id')
                                    ->join('users', 'users.id', '=', 'livre_demanders.user_id')
                                    ->join('auteurs', 'auteurs.id', '=', 'livres.auteur_id')
                                    ->first();
                                    try {
                                        $user->notify(new EmpruntValidermail($contenus)); 
                                    } catch (\Throwable $th) {
                                                                  
                                    }     
                                    return response()->json("Operation reussite");                       
                    }
                    return response()->json("Désolé, le lecteur a déjas  emprunté trois livre");                       
                } 
                return response()->json("Désolé, le lecteur a dejas un exemplaire de cet livre non rendue");                       
            }
            return response()->json("Désolé, Il n'y a plus d'exemplaires disponible pour cet livre");                       

    }

    public function rejeter_emprunt(Request $request)
    {
        
         LivreDemander::where('etat', 'attente')
                        ->whereUser_id($request->user)
                        ->whereLivre_id($request->livre)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
                       
    }
    public function list_livre_preter()
    {       
        return view('admin.lister_livre_preter',['livre_preter']);
    }
    public function get_livre_preter()
    {
        $contenus = DB::table('livre_demanders')
            ->where('etat','valider')
            ->join('livres', 'livres.id', '=', 'livre_demanders.livre_id')
            ->join('users', 'users.id', '=', 'livre_demanders.user_id')
            ->join('auteurs', 'auteurs.id', '=', 'livres.auteur_id')
            ->get();
            return DataTables::of($contenus)
            ->addColumn('action', function($data){
            $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-livre_id="'.$data->livre_id.'"   data-User_id="'.$data->user_id.'" data-original-title="Edit" class="edit btn btn-success edit-post">Rendre</a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a href="javascript:void(0);" id="delete-post" data-toggle="tooltip" data-original-title="Delete" data-livre_id="'.$data->livre_id.'"   data-User_id="'.$data->user_id.'" class="delete btn btn-danger"> Renouveler</a>';
            return $button;
            })
            ->addColumn('lecteur', function($row){
                return $row->first_name.' '.$row->last_name;
           })
           ->addColumn('auteur', function($row){
            return $row->prenom_auteur.' '.$row->nom_auteur;
            })
            ->rawColumns(['action','lecteur','auteur'])
            ->make(true) ;     
    }
    public function rendre_livre(Request $request)
    {
        LivreDemander::where('etat', 'valider')
                        ->whereUser_id($request->user)
                        ->whereLivre_id($request->livre)
                        ->update([ 'etat' => 'rendu']);
        return response()->json('vous avez rendu le livre');
    }
        public function renouveler_livre(Request $request)
        {   
        $livre = LivreDemander::where('etat', 'valider')
        ->whereUser_id($request->user)
        ->whereLivre_id($request->livre)
        ->update([ 'dateEmprunt' => Carbon::now(),
                   'dateRetour'  =>Carbon::now()->addDays(15)
                ]);

        // dump($livre);
        
        return response()->json('vous avez renouvelle le livre');
    }
    public function renouveler_livree()
    {   
        $id =request('id');
        $livre = Emprunt::find($id);
        $livre->dateEmprunt = Carbon::now();
        $livre->dateRetour  = Carbon::now()->addDays(15);
        $livre->save();
        return back()->withSuccess("vous avez renouveler cet livre"); 
    }
}

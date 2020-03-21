<?php

namespace App\Http\Controllers\lecteur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Emprunt;
use App\model\Livre;
use App\model\LivreDemander;
use App\model\Reservation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Carbon;

class LivreController extends Controller
{
    public function show()
    {
        $livres=Livre::with('auteur','domaine')->paginate(6);
        return view('lecteur.listes_livre',compact('livres'));
    
    }

    public function show_detail(Request $request)
    {
        $id=$request->id;
       
        $livre=Livre::find($id);
        return view('lecteur.details_livre',['livre' =>$livre]);
    
    }

    
    public function emprunter(Request $request)
    {
       $a_dja_demander_livre = DB::table('livre_demanders')->where('user_id', auth()->user()->id )
                                                ->where('livre_id',$request->id)
                                                ->where('etat','attente')
                                                ->count();
                                               
        $a_dja_demander_3_livre = DB::table('livre_demanders')->where('user_id', auth()->user()->id )
                                                  ->where('etat','attente')
                                                  ->count();
                                                 
        $livre = Livre::find($request->id);
        $nbr_exemplaire =$livre->nbr_exemplaire_livre;
        $nombre_exemplaire_preter =  DB::table('livre_demanders')->where('etat', 'valider')
                                                                 ->where('livre_id', $request->id)
                                                                 ->count();
        $nature_livre =$livre->nature_livre;
                                          
        // dd( $nature_livre);

        if ($a_dja_demander_livre== 0) {
            if ($a_dja_demander_3_livre < 3) {
                if ($nbr_exemplaire > $nombre_exemplaire_preter) {
                    if ($nature_livre == "pretable") {
                        $livre_demander = new LivreDemander();
                        $livre_demander->livre_id = $request->id;
                        $livre_demander->user_id = auth()->user()->id;
                        $livre_demander->save();
                        return back()->withSuccess("Votre emprunte a été bien enrigistré");
                    }
                     $error="Désolé, ce livre est consultable uniquement sur place";
                        return back()->with(['error' =>$error]);
                }
                $error="Désolé, Il n'y a plus d'exemplaires disponible pour ce livre, veillez faire une réservation SVP";
                return back()->with(['error' =>$error]);
            }
            $errors="vous ne pouvez pas demander plus que trois livres";
            return back()->with(['error' =>$errors]);
        }
        $error="vous avez dejas demander cette livre";
        return back()->with(['error' =>$error]);
    }
    
    
    public function emprunterr(Request $request)
    {
        $lecteur = auth()->user();
        $livre  = $request->id; 
          
        $livresList =DB::table('livre_demanders')->where('user_id', $lecteur->id )
                                                 ->where('livre_id',$livre)
                                                 ->where('etat','attente')
                                                 ->get();
        $livrecount = $livresList->count();
        // dd( $livrecount);

        $lecteurList =DB::table('livre_demanders')->where('user_id', $lecteur->id )->get();
        $lecteurCount = $lecteurList->count();
        //verifiction si le livre demander est dispo
        $nbr_livre=Livre::find($livre)->nbr_exemplaire_livre;
        $nbr_livre_preter =Emprunt::whereLivre_id($livre)->count();
        //verification si le livre est empruntable ou vwr sur place
        $nature=Livre::find($livre)->nature_livre;
        // dd($nature == 'voire sur place');
        if ($livrecount == 0 ) {
            if ($lecteurCount !=3) {
                if ($nbr_livre > $nbr_livre_preter) {
                    if ($nature == "voire sur place") {
                        $error="Désolé, ce livre est consultable uniquement sur place";
                        return back()->with(['error' =>$error]);
                    }
                    $livre_demander = new LivreDemander();
                    $livre_demander->livre_id = $livre;
                    $livre_demander->user_id = $lecteur->id;
                    $livre_demander->save();
                    return back()->withSuccess("Votre emprunte a été bien enrigistré");
                }
                $error="Désolé, Il n'y a plus d'exemplaires disponible pour ce livre, veillez faire une réservation SVP";
                return back()->with(['error' =>$error]);
            }
            $errors="vous ne pouvez pas demander plus que trois livres";
            return back()->with(['error' =>$errors]);
        }  
        $error="vous avez dejas demander cette livre";
        return back()->with(['error' =>$error]);
        
        return back()->withSuccess("Votre emprunte a été bien enrigistré");

                if ($lecteurCount !=3) {
                    $livre_demander = new LivreDemander();
                    $livre_demander->livre_id = $livre;
                    $livre_demander->user_id = $lecteur->id;
                    $livre_demander->save();
                    $errors="vous avez dejas demander cette livre";
                    return back()->with(['error' =>$errors]);
           
                }  
        return redirect()->back();
    }   
    public function mes_livres_emprunte(Request $request)
    {

        $id =auth()->user()->id;
        $mes_emprunt= LivreDemander::whereEtat('valider')
                                    ->whereUser_id($id)
                                    ->get();
        return view('lecteur.mes_livres_emprunter',['mes_emprunt' =>$mes_emprunt]);
        
    }
    public function show_notificationEmprunter($id,  DatabaseNotification $notification)
    {
        $id =auth()->user()->id;
        $livre = request('livre');
        $mes_emprunt= LivreDemander::whereEtat('valider')
                                         ->whereUser_id($id)
                                         ->whereLivre_id($livre)
                                         ->first();
        $notification->markAsRead();
        return view('lecteur.notifi_livre_emprunter',['mes_emprunt' =>$mes_emprunt]);

    }
    public function reserver(Request $request)
    {
        $livre  = $request->id; 
          
        $nbr_livre=Livre::find($livre)->nbr_exemplaire_livre;
        $a_emprunter_trois_exemplaie =LivreDemander::whereEtat('valider')
        ->whereLivre_id($request->id)
        ->count();
        // $nbr_livre_preter =Emprunt::whereLivre_id($livre)->count();
        // dd($nbr_livre,$a_emprunter_trois_exemplaie);
        
        if ($nbr_livre == $a_emprunter_trois_exemplaie) { 
            $liveReservable =LivreDemander::whereEtat('valider')
                                        ->whereLivre_id($request->id)
                                        ->get(); 
            return view('lecteur.livre_reservable')->with(['mes_emprunt' =>$liveReservable]);
            
        }
        $errors="Cet Livre a des exemplaire disponnible Veillez Faire un Emprunt SVP";
            return back()->with(['error' =>$errors]);
    }
    public function enrigistre_resrevation(Request $request)
    {
        $request->validate([
            'dateReservation' =>['required']
        ]);
        
        $lecteur = Sentinel::getUser()->id;
        $livre  = $request->id;
        $date= Input::get('dateReservation');
        $reserveur=Reservation::whereLivre_id($livre)
                                ->whereUser_id($lecteur)-> count();
        $nb=Reservation::whereLivre_id($livre)
                                ->where('DateReservation','<=',$date)->count();
    
        $exemplaire_dispo=Emprunt::where('dateRetour','<=',$date)
                    ->where('livre_id',$livre)
                     ->where('etat', 'valider')
                    ->count();
          //une personne peut faire qune seule reservation pour une livres         
        if ($reserveur < 1) {
            //si a la date de la reservation il yaura d'exemplaire dispo
           if ($exemplaire_dispo >=1 ) {
            //    verifier le nbre d'exemplaire disponilbe ne sont pas tous emprunter
                if ($exemplaire_dispo !=$nb) {
                    $reservation = new Reservation();
                    Emprunt::where('dateRetour','<=',$date)
                    ->where('livre_id',$livre)
                    ->update(['reservation' => 'reserver']);
                    $reservation->livre_id = $livre;
                    $reservation->user_id  = $lecteur;
                    $reservation->dateReservation = $request->dateReservation;
                    $reservation->save();
                    return '<div class="alert alert-succes">Votre reservation a été enrigistré</div>';
                }
                else{
                    return '<div class="alert alert-danger">Désolé, Cet livre est déja reserver pour cette date</div>';
                }
           }
           else{
            return '<div class="alert alert-danger">Désolé, aucune exemplaire de cet livre ne sera disponible pour cet date </div>';
           }
        }
        else {
          return '<div class="alert alert-danger">Désolé, vous avez dejas fait une reservation  pour cette</div>';
        }
    }
    public function destroy()
    {
        
    }
}

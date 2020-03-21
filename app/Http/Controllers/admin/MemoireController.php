<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Domaine;
use App\model\Etudiant;
use App\model\Memoire;

class MemoireController extends Controller
{
    public function index()
    {
        $etudiant=Etudiant::all();
        $domaine=Domaine::all();
        return view('admin.ajout_memoire',compact('etudiant','domaine'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'titre_memoire'      =>['required'] ,                                                                  
            'nbr_page_memoire'   =>['required'] ,
            'anne_memoire'       =>['required'] ,
            'etudiant_id'        =>['required'] ,
            'domaine_id'         =>['required'] 
            ]);

        $memoire= new Memoire();

        $memoire->titre_memoire     = $request->titre_memoire;
        $memoire->nbr_page_memoire  = $request->nbr_page_memoire;
        $memoire->anne_memoire      = $request->anne_memoire;
        $memoire->etudiant_id       = $request->etudiant_id;
        $memoire->domaine_id        = $request->domaine_id;

        $memoire->save();
        if ($request->ajax()) {
        return "Vous avez ajouter un nouveau Memoire";  
        }

        return redirect()->back()->withSuccess("Vous avez ajouter un nouveau Memoire");   
    
    }
}
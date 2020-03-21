<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Etudiant;

class EtudiantController extends Controller
{
    public function index()
    {
        return view('admin.ajout_etudiant');
    }
    public function create(Request $request)
    {
        $request->validate([
            'prenom_etudiant'          =>['required'],
            'nom_etudiant'             =>['required'],
            'date_naissance_etudiant'  =>['required'],
            'nationalite_etudiant'     =>['required']
        ]);

    $etudiant = new Etudiant();
    $etudiant->prenom_etudiant          =request('prenom_etudiant');
    $etudiant->nom_etudiant             =request('nom_etudiant');
    $etudiant->date_naissance_etudiant   =request('date_naissance_etudiant');
    $etudiant->nationalite_etudiant     =request('nationalite_etudiant');

    $etudiant->save();
    return  redirect()->back()->withSuccess("etudiant ajouter aver succes");
    }
}

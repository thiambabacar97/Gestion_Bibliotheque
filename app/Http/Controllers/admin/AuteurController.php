<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Auteur;

class AuteurController extends Controller
{
    public function index()
    {
        return view('admin.ajout_auteur');
    }
    public function create(Request $request)
    {
        $request->validate([
            'prenom_auteur'          =>['required'],
            'nom_auteur'             =>['required'],
            'date_naissance_auteur'  =>['required'],
            'nationalite_auteur'     =>['required']
        ]);

    $auteur = new Auteur();
    $auteur->prenom_auteur          =request('prenom_auteur');
    $auteur->nom_auteur             =request('nom_auteur');
    $auteur->date_naissance_auteur  =request('date_naissance_auteur');
    $auteur->nationalite_auteur     =request('nationalite_auteur');

    $auteur->save();
    return  redirect()->back()->withSuccess("Auteur ajouter aver succes");
    }
}

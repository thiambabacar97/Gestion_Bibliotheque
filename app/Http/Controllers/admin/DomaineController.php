<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Domaine;

class DomaineController extends Controller
{
    public function index()
    {
        return view('admin.ajout_domain');
    }


    public function create(Request $request)
    {
        $request->validate([
            'description_domaine' =>['required']
        ]);

        $domain = new Domaine();
        
        $domain->description_domaine = request('description_domaine');
        $domain->save();
       
        return  redirect()->back()->withSuccess("Vous avez ajoutez un nouveau domaine");

    }
}

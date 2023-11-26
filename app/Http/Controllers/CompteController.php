<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Compte;
use Illuminate\Support\Facades\DB;

class CompteController extends Controller
{

    function Liste($id){

        $data= DB::table('comptes')->join('typecomptes', 'comptes.typeCompte','typecomptes.id')
        ->where('comptes.idUser', 1)->get();

        return $data;
    }
    function CreerCompte(Request $req){

        $req([
            'typeCompte'=>['required', 'number'],
            'typeCard'=>'required',
            'numeroCard'=>['required', 'max:'], //Completer
            'dateExpir'=>'required',
            'cvv'=>['required', 'min:3'],
            'mdp'=>'required',
        ]);

        $co= new Compte;
        $co->idUser = $req['idUser'];//Auth de l'user
        $co->typeCompte = $req['typeCompte'];
        $co->typeCard = $req['typeCard'];
        $co->numeroCard = $req['numeroCard'];
        $co->dateExpir = $req['dateExpir'];
        $co->cvv = $req['cvv'];
        $co->mdp = $req['mdp'];
        $co->save();

        return redirect()->route();
    }

    function ModifierCompte(Request $req){

        $req([
            'id'=>'required',
            'typeCompte'=>['required', 'number'],
            'typeCard'=>'required',
            'numeroCard'=>['required', 'max:'], //Completer
            'dateExpir'=>'required',
            'cvv'=>['required', 'min:3'],
            'mdp'=>'required',
        ]);

        $co= Compte::find($req['id']);
        $co->typeCompte = $req['typeCompte'];
        $co->typeCard = $req['typeCard'];
        $co->numeroCard = $req['numeroCard'];
        $co->dateExpir = $req['dateExpir'];
        $co->cvv = $req['cvv'];
        $co->mdp = $req['mdp'];
        $co->save();

        return redirect()->route();
    }

    function DeleteCompte($id){

        $co= Compte::find($id);
        $co->delete();

        return redirect()->route();
    }

}

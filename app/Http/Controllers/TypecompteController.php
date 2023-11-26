<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Typecompte;
use Illuminate\Support\Facades\DB;

class TypecompteController extends Controller
{
    function ListeCompte(){
        $dev= DB::table('typecomptes')->get();
        return views('', ['typecomptes'=>$dev]);
    }

    function CreateCompte(Request $req){
        $req->validate([
            'intitule'=>['required', 'string'],
        ]);

        $type= new Typecompte;
        $type->intitule=$req['intitule'];
        $type->save();

        return redirect()->route('')->with('opearion.succes', 'Devise bien enregistrée');

    }

    function ShowCompte($id){

        $type= Typecompte::find($id);

        return views('',['infos'=>$type]);

    }

    function ModifierCompte(Request $req){

        $req->validate([
            'intitule'=>['required', 'string', 'max:10'],
            'valeur'=>['required', 'float'],
        ]);


        $type=Typecompte::find($req['id']);
        $type->intitule=$req['intitule'];
        $type->save();

        return redirect()->route('')->with('opearion.update', 'Devise bien modifiée');

    }
}

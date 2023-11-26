<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Devise;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DeviseController extends Controller
{
    function ListeDev(){
        $dev= DB::table('devises')->get();
        return views('', ['devises'=>$dev]);
    }

    function CreateDev(Request $req){
        $req->validate([
            'intitule'=>['required', 'string', 'max:10'],
            'valeur'=>['required', 'float'],
        ]);

        $dev= new Devise;
        $dev->intitule=$req['intitule'];
        $dev->symbole = $req['symbole'];
        $dev->valeur = $req['valeur'];
        $dev->save();

        return redirect()->route('')->with('opearion.succes', 'Devise bien enregistrée');

    }

    function ShowDev($id){

        $dev= Devise::find($id);

        return views('',['infos'=>$dev]);

    }

    function ModifierDev(Request $req){

        $req->validate([
            'intitule'=>['required', 'string', 'max:10'],
            'valeur'=>['required', 'float'],
        ]);

        $dev= Devise::find($req['id']);
        $dev->intitule=$req['intitule'];
        $dev->symbole = $req['symbole'];
        $dev->valeur = $req['valeur'];
        $dev->save();

        return redirect()->route('')->with('opearion.update', 'Devise bien modifiée');

    }
}

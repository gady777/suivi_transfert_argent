<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    function store(){
        $data= DB::table('cards')->where('userid', Auth::user()->id)->get();

        return view('usersView.bank.store', ['cards'=>$data]);
     }

    function Add(){
        return view('usersView.bank.add');
    }

    function AddSave(Request $req){

        $req->validate([
            'numberCard'=>['required',  'integer',"max:16","min:16"],
            'dateExp'=>'required',
            'cvv'=> ['required',  "min:3","max:3"],
            'nameCard'=> ['required', 'string'],
            'provider'=>'required',
        ]);

        $card = new Card;
        $card->userId =Auth::user()->id;
        $card->numberCard   =$req['numberCard'];
        $card->dateExp  =$req['dateExp'];
        $card->cvv  =$req['cvv'];
        $card->nameCard =$req['nameCard'];
        //$card->password  = Hash::make($req['password']);
        $card->provider  =$req['provider'];
        $card->statut  =0;
        $card->save();


        return redirect()->route('u.bank');
    }

    function Effacer($id){
        $card= Card::find($id);
        $card->delete();
        return redirect()->route('u.bank');
    }

    function Show($id){
        $card= Card::find($id);
        return view('usersView.bank.edit', ['card'=>$card]);
    }

    function EditSave(Request $req){
        $req->validate([
            'numberCard'=>['required',  'integer'],
            'dateExp'=>'required',
            'cvv'=> ['required',  "min:3"],
            'nameCard'=> ['required', 'string'],
            'provider'=>'required',
        ]);

        $card = Card::find($req['id']);
        $card->numberCard   =$req['numberCard'];
        $card->dateExp  =$req['dateExp'];
        $card->cvv  =$req['cvv'];
        $card->nameCard =$req['nameCard'];
        $card->statut  =0;
        $card->provider  =$req['provider'];
        $card->save();


        return redirect()->route('u.bank')->with('msg-update');
    }


}

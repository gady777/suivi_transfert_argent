<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Demande;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    function Starter(){
        return view('usersView.request.starter');
    }

    function Starter_Post(Request $req){
        $req->validate([
            'email'=>'required',
        ]);

        if($req['email']=="depot@transfert.com"){
            return view('usersView.request.validateAdmin');
        }else{

            if($req['email'] != Auth::user()->email){
                $data= User::where('email', $req['email'])->first();

                if(!empty($data)){
                    if($data->type_compte == Auth::user()->type_compte){
                        return view('usersView.request.validate',['info'=>$data]);
                    }else{
                        return view('usersView.request.starter',['msg'=>"error"]);
                    }

                }else{
                    return view('usersView.request.starter',['msg'=>"error"]);
                }

            }else{
                return view('usersView.request.starter',['msg'=>"error"]);
            }

        }


    }

    function Confirm(Request $req){
        if($req['type']=="Admin"){

            $req->validate([
                'amount'=>'required',
                'devise'=>'required',
                'description'=>'required',
                'dateBut'=>'required',
            ]);

            $re = new Demande();
            $re->idUser = Auth::user()->id;
            $re->receve = Auth::user()->id;
            $re->amount = $req['amount'];
            $re->description = $req['description'];
            $re->devise = $req['devise'];
            $re->delai = $req['dateBut'];
            $re->statut=0;
            $re->destinate= "Admin";
            $re->save();

            $tr= new Transaction();
            $tr->content = "Demande d'argent à un admin" ;
            $tr->author_type ="User" ;
            $tr->user_id =Auth::user()->id ;
            $tr->receiver_id = Auth::user()->id;
            $tr->amount = $req['amount'];
            $tr->account_amount = $req['amount'] ;
            $tr->operation_type ="Demande d'argent";
            $tr->save();


            return view('usersView.request.successAdmin');

        }elseif($req['type']=="User"){

            $req->validate([
                'idRec'=>'required',
                'amount'=>'required',
                'devise'=>'required',
                'description'=>'required',
                'dateBut'=>'required',
            ]);

            $re = new Demande();
            $re->idUser = Auth::user()->id;
            $re->receve = $req['idRec'];
            $re->amount = $req['amount'];
            $re->description = $req['description'];
            $re->devise = $req['devise'];
            $re->delai = $req['dateBut'];
            $re->statut=0;
            $re->destinate= "User";
            $re->save();

            $tr= new Transaction();
            $tr->content = "Demande d'argent à un au utilisateur " ;
            $tr->author_type ="User" ;
            $tr->user_id =Auth::user()->id ;
            $tr->receiver_id = $req['idRec'];
            $tr->amount = $req['amount'];
            $tr->account_amount = $req['amount'] ;
            $tr->operation_type ="Demande d'argent";
            $tr->save();

            $req = DB::table('demandes')->join('users', 'users.id', 'demandes.receve')->where('idUser',Auth::user()->id)
            ->where('receve',$req['idRec'])->where('amount',$req['amount'])->where('delai',$req['dateBut'])
            ->where('statut',0)->limit(1)->OrderByDesc('demandes.id')->get(['users.pseudo', 'users.email', 'demandes.amount' ,'demandes.devise']);

            return view('usersView.request.success',['infos'=>$req]);
        }

    }

    function RequestSend(){
        $data= DB::table('demandes')->join('users', 'users.id', 'demandes.idUser')
        ->where('demandes.idUser',Auth::user()->id)->get(['demandes.*', 'users.pseudo']);

        return $data;
        return view('usersView.request.storeSend');
    }
}

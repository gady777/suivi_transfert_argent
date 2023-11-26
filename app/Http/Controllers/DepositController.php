<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Devise;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    public function Start(){
        $cs = Devise::all();
        return view('usersView.depot.home',[
            "currencies"=>$cs
        ]);
    }

    public function success($id){
        $dep = Deposit::where('id',$id)->where('idUser',Auth()->user()->id)->first();
        if(!$dep){
            abort(404);
        }
        return view('usersView.depot.success',[
            'dep'=>$dep
        ]);
    }

    public function depositPost(Request $request){
        $input = $request->all();
        $val = Validator::make($input,[
            "currency"=>[
                'required','exists:devises,id'
            ],
            'payment_meth'=>['required','in:bank,mobile,cash,interact'],
            'price'=>['required','min:1']
        ]);

        if($val->fails()) {
            return back()->withErrors($val);
        }

        $deposit = new Deposit();
        $deposit->devise = $request->currency;
        $deposit->paiement_method = $request->payment_meth;
        $deposit->price = $request->price;
        $deposit->user_id = Auth()->user()->id;
        $deposit->amount = Auth()->user()->amount;
        $deposit->destinate = 'admin';
        $deposit->statut = 0;
        $deposit->date_operation = new \DateTime();
        $deposit->save();

        return redirect()->route("u.depot.success",[
            "id"=>$deposit->id
        ]);
    }


    public function SendMoney(){
        return view('usersView.sendMoney.starter');
    }

    function SendMoneyVerify(Request $req){
        $req->validate([
            'email'=>'required',
        ]);

        if($req['email']=="depot@transfert.com"){

            return view('usersView.sendMoney.validateAdmin');

        }else{

            if($req['email'] != Auth::user()->email){
                $data= User::where('email', $req['email'])->where('role','!=','1')->first();



                if(!empty($data)){//dd($data);

                    //if($data->type_compte == Auth::user()->type_compte){

                        return view('usersView.sendMoney.validate',['info'=>$data]);

                  /*  }else{
                        return view('usersView.sendMoney.starter',['msg'=>"error"]);
                    }*/


                }else{
                    return view('usersView.sendMoney.starter',['msg'=>"error"]);
                }

            }else{
                return view('usersView.sendMoney.starter',['msg'=>"error"]);
            }

        }

    }

    function Confirm(Request $req){

        //idRec":"2","amount":"52","devise":"1","message":"pmii

        $solde= Auth::user()->solde;

        if($req['type']=="Admin"){

            $req->validate([
                'amount'=>'required',
                'message'=>'required',
            ]);

            if($req['amount'] <=  $solde){
              try{
               DB::connection()->getPdo()->beginTransaction();

                $env = new Deposit;
                $env->idUser = Auth::user()->id;
                //$env->idReceve = ;
                $env->amount = $req['amount'];
                $env->price = $req['amount'];
                $env->devise = $req['devise'];
                $env->description = $req['message'];
                $env->date_operation = date('Y-m-d H:i');
                $env->statut = 0;
                $env->paiement_method="Transfert Union";
                $env->destinate="Admin";
                $env->save();

                $us = User::find(Auth::user()->id);
                $us->solde=$solde- $req['amount'];
                $us->save();

                $tr= new Transaction();
                $tr->content = "Déposer de l'argent à Transfert Union " ;
                $tr->author_type ="User" ;
                $tr->user_id =Auth::user()->id ;
                $tr->receiver_id = Auth::user()->id ;
                $tr->amount = $req['amount'];
                $tr->account_amount = $us->solde ;
                $tr->operation_type ="Depot d'argent";
                $tr->save();
                DB::connection()->getPdo()->commit();
                return view('usersView.sendMoney.succesAdmin',['deposit'=>$deposit]);
              }catch (\PDOException $e) {

                    DB::connection()->getPdo()->rollBack();
                    $error = "Une erreur est survenue: ".$e->getMessage();
                    return view('usersView.sendMoney.validateAdmin',['error'=>'Une erreur inattendue est survenue']);
              }

            }else{
                return view('usersView.sendMoney.validateAdmin',['msg'=>'error']);
            }

        }elseif($req['type']=="User"){

            $req->validate([
                'amount'=>['required','integer'],
                'idRec'=>'required',
                'message'=>'required',
            ]);

            if($req['amount'] <=  $solde){
              try{
               DB::connection()->getPdo()->beginTransaction();
                $env = new Deposit;
                $env->idUser = Auth::user()->id;
                $env->idReceve = $req['idRec'];
                $env->amount = $req['amount'];
                $env->price = $req['amount'];
                $env->devise = $req['devise'];
                $env->description = $req['message'];
                $env->date_operation = date('d-m-Y H:i');
                $env->statut = 0;
                $env->paiement_method="Transfert Union";
                $env->destinate="User";
                $env->save();

                //$us = User::find(Auth::user()->id);
                Auth()->user()->solde=$solde- $req['amount'];
                Auth()->user()->save();

                $us = User::find($req['idRec']);
                $us->solde= $us->solde + $req['amount'];
                $us->save();

                $tr= new Transaction();
                $tr->content = "Déposer de l'argent à ".$us->email ;
                $tr->author_type ="User" ;
                $tr->user_id =Auth::user()->id ;
                $tr->receiver_id = $req['idRec'];
                $tr->amount = $req['amount'];
                $tr->account_amount = $req['amount'] ;
                $tr->operation_type ="Depot d'argent";
                $tr->save();

                //$user = User::find($req['idRec'])->first();
                DB::connection()->getPdo()->commit();
                return view('usersView.sendMoney.success',['info'=>$us,"deposit"=>$deposit]);

              }catch (\PDOException $e) {

                    DB::connection()->getPdo()->rollBack();
                    $error = "Une erreur est survenue: ".$e->getMessage();
                    $data= User::find($req['idRec'])->first();
                    return view('usersView.sendMoney.validate',['info'=>$data, 'error'=>'Une erreur inattendue est survenue']);
              }

            }else{
                $data= User::find($req['idRec'])->first();
                return view('usersView.sendMoney.validate',['info'=>$data, 'msg'=>'error']);
            }

        }


    }
}

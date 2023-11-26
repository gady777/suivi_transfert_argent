<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepotRequest;
use App\Mail\DepotMail;
use App\Models\Depot;
use App\Models\DepotMethod;
use App\Models\Devise;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DepotController extends Controller
{
    public function list(){
        // historique
        return view('usersView.depot.list',[
            'ds'=>Depot::where('user_id',Auth()->user()->id)
                        ->orderBy('id','DESC')
                        ->get()
        ]);
    }

    public function state1(){
        return view('usersView.depot.home',[
            "currencies"=>Devise::all(),
            "meths"=> DepotMethod::all()
        ]);
    }

    public function state2(DepotRequest $request)
    {
        
        $m = DepotMethod::where('slug',$request->method)->firstOrFail();

        $depot = new Depot();
        $depot->user_id = Auth()->user()->id;
        $depot->amount = $request->amount;

        $depot->receive_amount = ( $request->amount - ( ( $request->amount * $m->fee ) / 100 ) );

        $depot->method = $request->method;
        $depot->method_id = $m->id;
        $depot->fee = $m->fee;
        $depot->devise_id = $request->currency;

        $depot->bank_name = $request->bank_name;
        $depot->account_name = $request->account_name;
        $depot->account_number = $request->account_number;
        $depot->rib = $request->rib;
        $depot->interact = $request->interact;
        $depot->phone_number = $request->phone_number;
        $depot->phone_name = $request->phone_name;
        $depot->cash_name_fname = $request->cash_name_fname;
        $depot->cash_cni = $request->cash_cni;
        
        $depot->save();

        // envoyer un email
        Mail::to("transfertunion@gmail.com")
             ->send(new DepotMail($depot));
        
        return redirect()
                    ->route("u.depot.success",["id"=>$depot->id])
                    ->with("success","Dépôt effectué avec succès");
    }

    public function success($id){
        $dep = Depot::where('id',$id)
                        ->where('user_id',Auth()->user()->id)
                         ->firstOrFail();

        return view('usersView.depot.success',[
            'dep'=>$dep
        ]);
    }

    public function detail($id){
        $dep = Depot::where('id',$id)
                        ->where('user_id',Auth()->user()->id)
                         ->firstOrFail();

        return view('usersView.depot.success',[
            'dep'=>$dep
        ]);
    }
}

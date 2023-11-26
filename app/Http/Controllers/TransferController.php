<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferState3Request;
use App\Http\Requests\TransferStateEndRequest;
use App\Mail\TransferMail;
use App\Models\Country;
use App\Models\Devise;
use App\Models\Recipient;
use App\Models\RecipientMethod;
use App\Models\Transfer;
use App\Models\TransferMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransferController extends Controller
{
    private const page = "transfer";

    public function list(){
        // historique
        return view('usersView.transfer.list',[
            'ts'=>Transfer::where('user_id',Auth()->user()->id)
                        ->orderBy('id','DESC')
                        ->get(),
            'page_name'=>self::page
        ]);
    }

    public function detail($id){
        return view("usersView.transfer.detail",[
            "t"=>Transfer::where('user_id',Auth()->user()->id)
                            ->where('id',$id)
                            ->firstOrFail(),
            'page_name'=>self::page
        ]);
    } 

    public function state1(){
        return view('usersView.transfer.state1',[
            "countries"=>Country::all(),
            'page_name'=>self::page
        ]);
    }
    public function method1(Request $request)
    {
        //
        $country_id = $request->query->get('country');
        $recipient_id = $request->query->get('recipient');
        //
        if(!$country_id or !$recipient_id){
            abort(404);
        }
        $country = Country::findOrFail($country_id);
        $recipient = Recipient::where('id',$recipient_id)
                                ->where('user_id',Auth()->user()->id)
                                ->firstOrFail();
        $bank = TransferMethod::where('slug','bank')->first();
        $interact = TransferMethod::where('slug','interact')->first();
        $cash = TransferMethod::where('slug','cash')->first();
        $mobile = TransferMethod::where('slug','mobile')->first();

        return view('usersView.transfer.method',[
            "country"=>$country,
            "recipient"=>$recipient,
            'page_name'=>self::page,
            "methods"=>TransferMethod::all(),
            "meth_bank"=>RecipientMethod::where('recipient_id',$recipient_id)
                                    ->where('transfer_method_id',$bank->id)->first(),
            "meth_phone"=>RecipientMethod::where('recipient_id',$recipient_id)
                                    ->where('transfer_method_id',$mobile->id)->first(),
            "meth_cash"=>RecipientMethod::where('recipient_id',$recipient_id)
                                    ->where('transfer_method_id',$cash->id)->first(),
            "meth_interact"=>RecipientMethod::where('recipient_id',$recipient_id)
                                    ->where('transfer_method_id',$interact->id)->first(),
        ]);
    }
    public function state2(TransferState3Request $request){
        $inp = $request->all();
        // vérifier que son destinataire
        $rr = Recipient::where('id',$request->recipient)
                         ->where('user_id',Auth()->user()->id)
                         ->where('is_active',true)
                         ->first();
        if(!$rr){
            return back()->with('error','Ce Bénéficiaire est invalide');
        }
        //méthode
        $methodok = TransferMethod::where("slug",$request->method)->firstOrFail();
        //
        return view('usersView.transfer.state2',[
            "r"=> $rr,
            "countries"=>Country::all(),
            "country"=> Country::find($request->country),
            "currencies"=>Devise::all(),
            'page_name'=>self::page,
            "method"=>$methodok,
            //
            "bank_name"=>$request->bank_name,
            "account_name"=>$request->account_name,
            "account_number"=>$request->account_number,
            "rib"=>$request->rib,
            "phone_number"=>$request->phone_number,
            "phone_name"=>$request->phone_name,
            "interact"=>$request->interact,
            "cash_name_fname"=>$request->cash_name_fname,
            "cash_cni"=>$request->cash_cni
        ]);
    }

    public function state3(TransferStateEndRequest $request){
        // vérifier que son destinataire
        $rr = Recipient::where('id',$request->recipient)
                         ->where('user_id',Auth()->user()->id)
                         ->where('is_active',true)
                         ->first();
        if(!$rr){
            abort(404);
        }
        //
        $country = Country::find($request->country);
        //enregistrement
        $tr = new Transfer();
        //
        $methodok = TransferMethod::where("slug",$request->method)->firstOrFail();
        //
        $tr->user_id = Auth()->user()->id;

        $tr->amount = $request->amount;
        $tr->country_from_id = $request->country;
        $tr->recipient_id = $request->recipient;
        $tr->fee = $methodok->fee;

        $fee_amount = ($request->amount * $methodok->fee) / 100;//
        $tr->fee_amount = $fee_amount;
        $tr->from_rate = $country->devise()->rate;
        $tr->recipient_rate = $rr->country()->devise()->rate;

        $tr->id_transaction = m_random_string(1).random_int(1,9).random_int(1,9).m_random_string(3);
        //r_amount
        $tmp = $request->amount - $fee_amount;
        $r_amount = ($tmp * $country->devise()->rate ) / $rr->country()->devise()->rate; 
        $tr->receive_amount = $r_amount;
        //reception
        $tr->method = $request->method;
        $tr->transfer_method_id = TransferMethod::where('slug',$request->method)->first()->id;
        $tr->bank_name = $request->bank_name;
        $tr->account_name = $request->account_name;
        $tr->account_number = $request->account_number;
        $tr->rib = $request->rib;
        $tr->interact = $request->interact;
        $tr->phone_number = $request->phone_number;
        $tr->phone_name = $request->phone_name;
        $tr->cash_name_fname = $request->cash_name_fname;
        $tr->cash_cni = $request->cash_cni;
        //
        $tr->save();
        //Méthode
        $exist = RecipientMethod::where('recipient_id',$request->recipient)
                                  ->where('transfer_method_id',$tr->transfer_method_id)
                                  ->first();
        if(!$exist){
            $rm = new RecipientMethod();
            $rm->transfer_method_id = $tr->transfer_method_id;
            $rm->bank_name = $request->bank_name;
            $rm->account_name = $request->account_name;
            $rm->account_number = $request->account_number;
            $rm->rib = $request->rib;
            $rm->interact = $request->interact;
            $rm->phone_number = $request->phone_number;
            $rm->phone_name = $request->phone_name;
            $rm->cash_name_fname = $request->cash_name_fname;
            $rm->cash_cni = $request->cash_cni;
            $rm->recipient_id = $request->recipient;  
            $rm->save();
        }
        //send email to admin
        Mail::to("hello@transfertunion.com")
             ->send(new TransferMail($tr));
        //
        return redirect()->route("u.transfer.success",["id"=>$tr->id]);
        //
        
    }
    
    public function success($id){
        $tr = Transfer::where('user_id',Auth()->user()->id)
                        ->where('id',$id)
                        ->firstOrFail();
        return view('usersView.transfer.success',[
            't'=>$tr,
            'page_name'=>self::page
        ]);
    }
}

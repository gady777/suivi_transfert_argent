<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipientMethodRequest;
use App\Http\Requests\RecipientRequest;
use App\Models\Country;
use App\Models\Recipient;
use App\Models\RecipientMethod;
use App\Models\TransferMethod;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Validator;

class RecipientController extends Controller
{
    private const page = "recipient";

    public function list(){
      return view('usersView.recipient.list',[
          'rs'=>Recipient::where('user_id',Auth()->user()->id)
                          ->where('is_active',true)
                           ->orderBy('id','DESC')
                           ->get(),
           'page_name'=>self::page
      ]);
    }
    public function create_view(){
        return view('usersView.recipient.create',[
            "countries"=>Country::all(),
            'page_name'=>self::page
        ]);
    }

    public function create(RecipientRequest $request){
        $r = new Recipient();

        $r->name = $request->name;
        $r->fname = $request->fname;
        $r->country_id = $request->country;
        $r->city = $request->city;
        $r->email = $request->email;
        $r->user_id = Auth()->user()->id;
        $old_r = Recipient::where('email',$request->email)
                            ->where('user_id',Auth()->user()->id)
                            ->first();
        if($old_r){
            return back()->with("error","Vous avez déjà un bénéficiaire avec cet email");
        }
        //dd($request->query->get('ret'),$request->query->get('country'));
        //
        $r->save();
        if ($request->query->get('ret') == "trans-state1" and $request->query->get('country')) {
            $rr = route('u.transfer.method')."?country=".$request->query->get('country')."&recipient=".$r->id;
            return redirect($rr)
                ->with('success','Bénéficiaire ajouté avec succès');
        }elseif(!$request->query->get('country') and $request->query->get('ret') == "trans-state1"){
            return redirect()
                ->route("u.transfer.state1")
                ->with('success','Bénéficiaire ajouté avec succès');
        }
        return redirect()
                ->route('u.recipient.home')
                ->with('success','Bénéficiaire ajouté avec succès');
    }

    public function edit_view($id){
        $r = Recipient::where('id',$id)
                        ->where('user_id',Auth()->user()->id)
                        ->where('is_active',true)
                        ->first();
        if(!$r){
            abort(404);
        }

        return view('usersView.recipient.edit',[
            'r'=>$r,
            "countries"=>Country::all(),
            'page_name'=>self::page
        ]);
    }

    public function edit($id,RecipientRequest $request){
        $r = Recipient::where('id',$id)
                        ->where('user_id',Auth()->user()->id)
                        ->where('is_active',true)
                        ->first();
        if(!$r){
            abort(404);
        }
        $r->name = $request->name;
        $r->fname = $request->fname;
        $r->country_id = $request->country;
        $r->city = $request->city;
        $r->email = $request->email;
        $old_r = Recipient::where('email',$request->email)
                            ->where('user_id',Auth()->user()->id)
                            ->where('id','!=',$r->id)
                            ->first();
        if($old_r){
            return back()->with("error","Vous avez déjà un bénéficiaire avec cet email");
        }
        $r->save();

        return redirect()
                ->route('u.recipient.home')
                ->with('success','Destinataire modifié avec succès');
    }

    public function delete($id){//dd($id);
        $r = Recipient::where('id',$id)
                        ->where('user_id',Auth()->user()->id)
                        ->first();
        if(!$r){
            abort(404);
        }

        $r->is_active = false;
        $r->email_old = $r->email;
        $r->email = null;

        $r->save();

        return redirect()
                ->route('u.recipient.home')
                ->with('success','Destinataire supprimé avec succès');
    }

    public function methods_index($id){
        $recipient = Recipient::where("id",$id)->where('user_id',Auth()->user()->id)->firstOrFail();
        return view("usersView.recipient.method.list",[
            "recipient"=>$recipient,
            'page_name'=>self::page
        ]);
    }

    public function create_method_view($id)
    {
        $recipient = Recipient::where("id",$id)->where('user_id',Auth()->user()->id)->firstOrFail();
        return view("usersView.recipient.method.create",[
            "recipient"=>$recipient,
            'page_name'=>self::page,
            "methods"=>TransferMethod::all()
        ]);
    }

    public function create_method($id,RecipientMethodRequest  $request)
    {
        $recipient = Recipient::where("id",$id)->where('user_id',Auth()->user()->id)->firstOrFail();
        $meth = new RecipientMethod();
        $mm = TransferMethod::where('slug',$request->method)->first();
        $meth->transfer_method_id = $mm->id;
        $meth->account_name = $request->account_name;
        $meth->bank_name = $request->bank_name;
        $meth->account_number = $request->account_number;
        $meth->rib = $request->rib;
        $meth->interact = $request->interact;
        $meth->phone_number = $request->phone_number;
        $meth->phone_name = $request->phone_name;
        $meth->cash_cni = $request->cash_cni;
        $meth->cash_name_fname = $request->cash_name_fname;
        $meth->recipient_id = $recipient->id;
        
        $meth->save();

        return redirect()
                ->route("u.recipient.method.list",["id"=>$id])
                ->with('success','Méthode ajoutée avec succès');
    }

    public function edit_method_view($id,$meth_id)
    {
        $recipient = Recipient::where("id",$id)->where('user_id',Auth()->user()->id)->firstOrFail();
        $meth = RecipientMethod::where('recipient_id',$id)->where('id',$meth_id)->firstOrFail();
        return view("usersView.recipient.method.edit",[
            "recipient"=>$recipient,
            "meth"=>$meth,
            'page_name'=>self::page,
            "methods"=>TransferMethod::all()
        ]);
    }
    public function edit_method($id,RecipientMethodRequest  $request,$meth_id)
    {
        $recipient = Recipient::where("id",$id)->where('user_id',Auth()->user()->id)->firstOrFail();
        $meth = RecipientMethod::where('recipient_id',$id)->where('id',$meth_id)->firstOrFail();

        $meth->transfer_method_id = TransferMethod::where('slug',$request->method)->first()->id;
        $meth->account_name = $request->account_name;
        $meth->bank_name = $request->bank_name;
        $meth->account_number = $request->account_number;
        $meth->rib = $request->rib;
        $meth->interact = $request->interact;
        $meth->phone_number = $request->phone_number;
        $meth->phone_name = $request->phone_name;
        $meth->cash_cni = $request->cash_cni;
        $meth->cash_name_fname = $request->cash_name_fname;
        $meth->recipient_id = $recipient->id;
        
        $meth->save();

        return redirect()
                ->route("u.recipient.method.list",["id"=>$id])
                ->with('success','Méthode modifiée avec succès');
    }

    public function delete_method($id,$meth_id){
        $recipient = Recipient::where("id",$id)->where('user_id',Auth()->user()->id)->firstOrFail();
        $meth = RecipientMethod::where('recipient_id',$id)->where('id',$meth_id)->firstOrFail();
        $meth->delete();

        return redirect()
                ->route("u.recipient.method.list",["id"=>$id])
                ->with('error','Méthode supprimé avec succès');
    }
}

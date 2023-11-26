<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransferTrancheRequest;
use App\Mail\TransferTrancheInitEmail;
use App\Models\Devise;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\TransferTranche;
use App\Models\TransferTrancheInstance;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransferTrancheController extends Controller
{
    private const page = "tranche";

    public function list()
    {
        return view("adminView.transfer_tranche.list",[
            "ts"=> TransferTranche::where('archive',false)->orderBy('id','DESC')->get(),
            "page"=>self::page
        ]);
    }

    public function detail($id){
        $t = TransferTranche::findOrFail($id);
        $rs = TransferTrancheInstance::where('transfer_tranche_id',$id)->where('type','reception')->get();
        return view("adminView.transfer_tranche.detail",[
            'rs'=>$rs,
            "t"=>$t,
            "page"=>self::page
        ]);
    }

    public function detail_envoi($id){
        $t = TransferTranche::findOrFail($id);
        $cs = TransferTrancheInstance::where('transfer_tranche_id',$id)->where('type','envoi')->get();

        return view("adminView.transfer_tranche.detail-envoi",[
            'rs'=>$cs,
            "t"=>$t,
            "page"=>self::page
        ]);
    }

    public function detail_reception($id){
        $t = TransferTranche::findOrFail($id);
        $cs = TransferTrancheInstance::where('transfer_tranche_id',$id)->where('type','reception')->get();

        return view("adminView.transfer_tranche.detail-reception",[
            'ts'=>$cs,
            "t"=>$t,
            "page"=>self::page
        ]);
    }


    public function create_view($id=0)
    {
        $trr = Transfer::find($id);
        if($trr){
            if($trr->has_tranche){
                flash("Un transfert par tranche existe déjà pour cet transfert")->error();
                return back();
             }
        }
        return view("adminView.transfer_tranche.create",[
            "page"=>self::page,
            "devises"=>Devise::all(),
            "transfer"=>$trr
        ]);
    }

    public function create(TransferTrancheRequest $request,$id=0)
    {
        $t = new TransferTranche();
        $trr = Transfer::find($id);
        
        $em = $request->email;
        $u = User::where('email',$em)->where("role",2)->firstOrFail();
        if(!$u){
            return back()->with("error","Cet utilisateur est inconnu. S'il est inscrit, il est peut être un administrateur");
        }
        
        if($trr){
            if($trr->has_tranche){
                flash("Un transfert par tranche existe déjà pour cet transfert")->error();
                return back();
             }
            $t->transfer_id = $id;
            $t->id_transaction = $trr->id_transaction;
            $trr->has_tranche = true;
            
        }else{
            $t->id_transaction = m_random_string(1).random_int(1,9).random_int(1,9).m_random_string(3); 
        }
        try {
            DB::connection()->getPdo()->beginTransaction();
            
            $t->admin_id = Auth()->user()->id;
            $t->amount = $request->amount;
            $t->devise_id = $request->devise;
            $t->user_id = $u->id;
            $t->solde = $request->amount;
            //
            $dev_cfa = Devise::where('id',$request->devise)->firstOrFail();
            $t->amount_cfa = $request->amount * $dev_cfa->rate;
            $t->solde_envoi = $request->amount * $dev_cfa->rate;
           
            //
            $t->save();
            //
            if($trr){
                $trr->tranche_id = $t->id;
                $trr->save();
            }
            //transaction
            $transaction = new Transaction();
            $transaction->author_type = "admin";
            $transaction->user_id = auth()->user()->id;
            $transaction->operation_type = "transfer_tranche";
            //
            $transaction->devise_id = $request->devise;
            $transaction->real_amount = $request->amount;
            //
            //$transaction->country_from_id = $pay->country_from_id;
            //$transaction->recipient_id = $ti->user_id;
            //
            $transaction->amount = $request->amount;
            $transaction->content = 'Nouveau transfert par tranche '.$t->id_transaction;
            $transaction->receiver_id = $t->user_id;
            
            $transaction->save();
            //email
            Mail::to($em)->send(new TransferTrancheInitEmail($t));
            //
            DB::connection()->getPdo()->commit();
            logContent([
                "category"=>"TRANSFERT PAR TRANCHE",
                Auth()->user()->pseudo." a créé un transfert par tranche",
                "#ID trasfert: ".$t->id_transaction
            ]);
        } catch (\PDOException $e) {

            DB::connection()->getPdo()->rollBack();
            $error = "Une erreur est survenue: ".$e->getMessage();
        }
        if(!empty($error)){
          flash($error)->error();
        }else{
            flash("Transfert par tranche ajouté")->success();
        }
        
        return redirect()->route('admin.transfer.tranche.home');
    }

    public function edit_view($id)
    {
        $t = TransferTranche::findOrFail($id);
        if($t->tranches()->count()){
            flash("NB: La modification du montant ne sera pas considé ")->warning();
        }
        return view("adminView.transfer_tranche.edit",[
            "page"=>self::page,
            "t"=>$t,
            "devises"=>Devise::all()
        ]);

    }
    public function edit(TransferTrancheRequest $request, $id)
    {
        $t = TransferTranche::findOrFail($id);

        $em = $request->email;
        $u = User::where('email',$em)->where("role",2)->first();
        if(!$u){
            return back()->with("error","Cet utilisateur est inconnu. S'il est inscrit, 
            il est peut être un administrateur");
        }
        $t->admin_id = Auth()->user()->id;
        if(!$t->tranches()->count()){
            $t->amount = $request->amount;
            $t->solde = $request->amount;
            $t->solde_envoi = $request->amount;
        }
        
        $t->devise_id = $request->devise;
        $t->user_id = $u->id;
        $t->save();
        /*flash("Transfert par tranche modifié avec succès")->success();*/
        return redirect()->route('admin.transfer.tranche.home');
    }

    public function delete($id)
    {
        $t = TransferTranche::findOrFail($id);
        $r = $t->tranches();
        try {
          DB::connection()->getPdo()->beginTransaction();
            foreach($r as $tt){
                $tt->delete();
            }
            if($t->transfer_id){
                $transfer = Transfer::find($t->transfer_id);
                if($transfer){
                    $transfer->has_tranche = false;
                    $transfer->tranche_id = null;
                    $transfer->save();
                }
            }
            $t->delete();
          DB::connection()->getPdo()->commit();
          logContent([
            "category"=>"TRANSFERT PAR TRANCHE",
            Auth()->user()->pseudo." a supprimé un transfert par tranche",
            "#ID trasfert: ".$t->id_transaction
          ]);
        } catch (\PDOException $e) {

            DB::connection()->getPdo()->rollBack();
            $error = "Une erreur est survenue: ".$e->getMessage();
        }

        if(!empty($error)){
          flash($error)->error();
        }else{
            flash("Transfert par tranche supprimé")->success();
        }
        return redirect()->route('admin.transfer.tranche.home');
    }
}

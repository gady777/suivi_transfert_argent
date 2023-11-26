<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransferTrancheInstanceRequest;
use App\Mail\TransferTrancheInstanceConfirmMail;
use App\Mail\TransferTrancheInstanceEmail;
use App\Mail\TransferTrancheInstanceRecepTnfoNotFoundEmail;
use App\Models\Devise;
use App\Models\Recipient;
use App\Models\RecipientMethod;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\TransferMethod;
use App\Models\TransferTranche;
use App\Models\TransferTrancheInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TransferTrancheInstanceController extends Controller
{
    private const page = "tranche";

    public function create_view($id){ //dd("here");
        $t = TransferTranche::where('id',$id)->firstOrFail();
        if($t->complete){
            flash("Cet transfert est complet")->info();
            return redirect()->route("admin.transfer.tranche.detail",['id'=>$id]);
        }

        return view("adminView.transfer_tranche.instance.create",[
            "page"=>self::page,
            "t"=>$t,
            "devises"=>Devise::all(),
            "methods"=>TransferMethod::all(),
        ]);
    }
    public function create_envoi_view($id){
        $t = TransferTranche::where('id',$id)->firstOrFail();
        $dev=Devise::where('symbole','XOF')->firstOrFail();
        if($t->complete_envoi){
            flash("Cet transfert est complet")->info();
            return redirect()->route("admin.transfer.tranche.detail.envoi",['id'=>$id]);
        }
        $transfer = $t->transfer();
        $recipient = NULL;
        $author = NULL;
        $recipients = [];
        if($transfer){
            $recipient = $transfer->recipient();
            $author = $transfer->user();
            $recipients = $author->recipients();
        }
        
        return view("adminView.transfer_tranche.instance.create-envoi",[
            "page"=>self::page,
            "t"=>$t,
            "methods"=>TransferMethod::all(),
            "devise"=>$dev,
            "recipient"=>$recipient,
            "recipients"=>$recipients
        ]);
    }

    public function confirm_view($id,$instance_id){
        $t = TransferTranche::findOrFail($id);
        $ti = TransferTrancheInstance::findOrFail($instance_id);
        return view("adminView.transfer_tranche.instance.confirm",[
            "page"=>self::page,
            "ti"=>$ti,
            "t"=>$t
        ]);
    }
    public function confirm(Request $request,$id,$instance_id){
        $inp = $request->all();
        $ti = TransferTrancheInstance::findOrFail($instance_id);
        $t = TransferTranche::findOrFail($id);
        if($ti->valid){
            flash("Déjà confirmé")->error();
            return redirect()->route("admin.transfer.tranche.detail",['id'=>$id]);
        }
        $val = Validator::make($inp,[
            "m_message"=>["required","max:100"],
            "date"=>["required","date"],
        ]);
        if($val->fails()){
            return back()->withErrors($val);
        }
        
        $ti->valid = true;
        $ti->valid_date = new \DateTime();
        $ti->valid_message = $request->m_message;
        $ti->valid_date_ok = $request->date;
        $ti->save();
        //
        Mail::to($t->user()->email)
              ->send(new TransferTrancheInstanceConfirmMail($t,$ti));
        //
        flash("Confirmé avec succès")->success();
        return redirect()->route("admin.transfer.tranche.detail",['id'=>$id]);
    }

    public function detail($id,$instance_id){
        $ti = TransferTrancheInstance::findOrFail($instance_id);
        $t = TransferTranche::findOrFail($id);
        $ti->save();
        return view("adminView.transfer_tranche.instance.detail",[
            "page"=>self::page,
            "ti"=>$ti,
            "t"=>$t
        ]);
    }

    public function create_envoi(TransferTrancheInstanceRequest $request,$id)
    {
        $t = TransferTranche::where('id',$id)->firstOrFail();
        //$type ="reception";
        if($t->complete_envoi){
            flash("Cet transfert est complet")->info();
            return redirect()->route("admin.transfer.tranche.detail.envoi",['id'=>$id]);
        }
        //
        if($request->amount > $t->solde_envoi){
            return back()->with("error","Le solde restant à envoyé est ".$t->solde_envoi);
        }
        //
        if($t->solde_envoi == 0){
            return back()->with("error","Vous ne pouvez pas effectuer un envoi ");
        }
        //
        try {
        DB::connection()->getPdo()->beginTransaction();
            $ti = new TransferTrancheInstance();
            $solde = $t->solde_envoi - $request->amount;
            //
            $t->solde_envoi = $solde;
            $ti->solde_envoi = $solde;
            $ti->solde = $t->solde;
            //
            $ti->recipient_id = $request->recipient_id;
            
            //
            if($t->solde_envoi ==0){
                $t->complete_envoi = true;
                $trans = Transfer::find($t->transfer_id);
                if($trans and $t->solde == 0){
                    $trans->statut = "valid";
                    $trans->validate_at = new \DateTime();
                    $trans->save();
                }
            }
            //
            $ti->type = "envoi";
            $ti->transfer_tranche_id = $t->id;
            $ti->amount = $request->amount;
            $ti->pay_date = $request->pay_date;
            $devise = Devise::where('symbole','XOF')->firstOrFail();
            $ti->transfer_method_id = $request->method;
            $ti->devise_id = $request->devise;
            $ti->receive_amount= ($request->amount * $t->devise()->rate ) / $devise->rate;
            $ti->informations = $request->informations;
            $ti->id_reception =  TransferTrancheInstance::where('transfer_tranche_id',$t->id)
                                                          ->where('type','envoi')
                                                          ->count() +1 ;
            //
            //conserver les informations de réceptions au cas ou
            // le client supprime ou modifie les infos de réception
            //pour ce bénéfificiaire
            $good_meth_reception = RecipientMethod::where('recipient_id',$request->recipient_id)
                                                    ->where('transfer_method_id',$request->method)
                                                    ->first();
            if($good_meth_reception){
                $build = "BANK METHOD <b>bank_name: </b>$good_meth_reception->bank_name <br>";
                $build .= "<b>account_name: </b>$good_meth_reception->account_name <br>";
                $build .= "<b>account_number: </b>$good_meth_reception->account_number <br>";
                $build .= "<b>rib: </b>$good_meth_reception->rib <br>";
                //
                $build .= "INTERACT <b>interact: </b>$good_meth_reception->interact <br>";
                $build .= "MOBILE MONEY <b>phone_number: </b>$good_meth_reception->phone_number <br>";
                $build .= "<b>phone_name: </b>$good_meth_reception->phone_name <br>";
                $build .= "CASH MONEY <b>cash_name_fname: </b>$good_meth_reception->cash_name_fname <br>";
                $build .= "<b>cash_cni: </b>$good_meth_reception->cash_cni <br>";
                // Cet attribut n'est pas directement utilisé sur le site
                // Il sera utile en cas de litige sur un envoi
                $ti->info_recepient_reception = $build;
                //
            }
            //
            $t->save();
            $ti->save();
            //transaction
            $transaction = new Transaction();
            $transaction->author_type = "admin";
            $transaction->user_id = auth()->user()->id;
            $transaction->operation_type = "transfer_tranche";
            //
            $transaction->devise_id = $request->devise;
            $transaction->real_amount = $ti->receive_amount;
            //
            $transaction->amount = $request->amount;
            $transaction->content = 'Nouveau paiement pour le transfert '.$t->id_transaction;
            $transaction->receiver_id = $t->user_id;
            
            $transaction->save();
            
            
            //email ici
            Mail::to($t->user()->email)->send(new TransferTrancheInstanceEmail($t,$ti));
            //
            if(!$good_meth_reception){
                //avertit de ce que les infos ne sont pas trouvées pour ce 
                // bénéficiaire
                Mail::to($t->user()->email)->send(new TransferTrancheInstanceRecepTnfoNotFoundEmail($t,$ti));
            }
            DB::connection()->getPdo()->commit();
            //
            logContent([
                "category"=>"TRANSFERT PAR TRANCHE",
                "NouvelleTranche",
                Auth()->user()->pseudo." a ajouté une tranche de type ENVOI",
                "#ID transfert: ".$t->id_transaction
            ]);
        } catch (\PDOException $e) {

            DB::connection()->getPdo()->rollBack();
            $error = "Une erreur est survenue: ".$e->getMessage();
        }
        if(!empty($error)){
        flash($error)->error();
        }else{
        flash("Paiement validé avec succès")->success();
        }
        return redirect()->route("admin.transfer.tranche.detail.envoi",["id"=>$id]);
    }

    public function create(TransferTrancheInstanceRequest $request,$id)
    {
        //envoi
        $t = TransferTranche::where('id',$id)->firstOrFail();
        if($t->complete){
            flash("Cet transfert est complet")->info();
            return redirect()->route("admin.transfer.tranche.detail",['id'=>$id]);
        }
        //
        //$type = "envoi";
        //
        if($request->amount > $t->solde){
            return back()->with("error","Le solde restant à recevoir est ".$t->solde);
        }
        //
        if($t->solde == 0){
            return back()->with("error","Vous ne pouvez pas effectuer une réception ");
        }
        //
        try {
        DB::connection()->getPdo()->beginTransaction();
            $ti = new TransferTrancheInstance();
            $solde = $t->solde - $request->amount;
            //
            $t->solde = $solde;
            $ti->solde = $solde;
            $ti->solde_envoi = $t->solde_envoi;
            //
            if($t->solde == 0){
                $t->complete = true;
                $trans = Transfer::find($t->transfer_id);
                if($trans and $t->solde_envoi == 0){
                    $trans->statut = "valid";
                    $trans->validate_at = new \DateTime();
                    $trans->save();
                }
            }
            //
            $ti->type = "reception";
            $ti->transfer_tranche_id = $t->id;
            $ti->amount = $request->amount;
            $ti->pay_date = $request->pay_date;
            //$method = TransferMethod::findOrFail($request->method);
            $devise = Devise::findOrFail($request->devise);
            $ti->transfer_method_id = $request->method;
            $ti->devise_id = $request->devise;
            $ti->receive_amount= ($request->amount * $t->devise()->rate ) / $devise->rate;
            $ti->informations = $request->informations;
            //
            $ti->id_reception =  TransferTrancheInstance::where('transfer_tranche_id',$t->id)
                                                          ->where('type','reception')
                                                          ->count() +1 ;
            //
            $t->save();
            $ti->save();
            //transaction
            $transaction = new Transaction();
            $transaction->author_type = "admin";
            $transaction->user_id = auth()->user()->id;
            $transaction->operation_type = "transfer_tranche";
            //
            $transaction->devise_id = $request->devise;
            $transaction->real_amount = $ti->receive_amount;
            //
            $transaction->amount = $request->amount;
            $transaction->content = 'Nouvel envoi pour le transfert '.$t->id_transaction;
            $transaction->receiver_id = auth()->user()->id;
            
            $transaction->save();
            //email ici
            Mail::to($t->user()->email)->send(new TransferTrancheInstanceEmail($t,$ti));
            //
        DB::connection()->getPdo()->commit();
            logContent([
                "category"=>"TRANSFERT PAR TRANCHE",
                "NouvelleTranche",
                Auth()->user()->pseudo." a ajouté une tranche de type RECEPTION",
                "#ID transfert: ".$t->id_transaction
            ]);
        } catch (\PDOException $e) {

            DB::connection()->getPdo()->rollBack();
            $error = "Une erreur est survenue: ".$e->getMessage();
        }
        if(!empty($error)){
        flash($error)->error();
        }else{
        flash("Paiement validé avec succès")->success();
        }
        return redirect()->route("admin.transfer.tranche.detail.reception",["id"=>$id]);
    }
    //
    public function loadRecipientInfo($recipient_id,$method_id){
        $rm = RecipientMethod::where('recipient_id',$recipient_id)
                                ->where('transfer_method_id',$method_id)
                                ->first();
        //les méthodes disponible
        
        $recipient_methods = RecipientMethod::where('recipient_id',$recipient_id)->get();
        //
        return view("adminView.transfer_tranche.instance._recipient_method",[
            "method"=>$rm,
            "recipient_methods"=>$recipient_methods
        ]);
        
    }
}

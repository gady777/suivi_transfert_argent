<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminTransferRequest;
use App\Mail\TransferConfirmMail;
use App\Mail\TransferUndoMail;
use App\Mail\TransferWaitingMail;
use App\Models\ReceivePayMethod;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\TransferTranche;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransferController extends Controller
{
    private const page = "transfer";

   public function list()
   {
      $c = Transfer::where('archive',false)->orderBy('id','DESC')->get();
      return view('adminView.transfer.list',[
        "ds"=>$c,
        "page"=>self::page
      ]);
   }

   public function markProgress($id)
   {
    $pay = Transfer::findOrFail($id); 
    if($pay->statut == "valid")
    {
        flash('Transfert déjà confirmé')->error();
        return redirect()->route("admin.transfer.home");
    }
      if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Ce transfert a été déjà rejetée')->error();
        return redirect()->route("admin.transfer.home");
      }
      if($pay->statut == "waiting_validation" ){
        flash('Vous ne pouvez pas effectuer cette opération. 
        Ce transfert a été déjà marquée comme étant en cours')->error();
        return redirect()->route("admin.transfer.home");
      }
     
    $pay->statut = "waiting_validation";
    $error = "";
    try {
        DB::connection()->getPdo()->beginTransaction();
        $pay->save();
        //
        //nouvelle transaction
        $transaction = new Transaction();
        $transaction->author_type = "admin";
        $transaction->user_id = auth()->user()->id;
        $transaction->operation_type = "transfer";
        $transaction->amount = $pay->amount;
        //
        $transaction->devise_id = $pay->devise_id;
        $transaction->real_amount = $pay->receive_amount;
        //
        $transaction->country_from_id = $pay->country_from_id;
        $transaction->recipient_id = $pay->recipient_id;
        //
        $transaction->content = 'Transfert en cours de traitement par Tranfert Union';
        $transaction->receiver_id = $pay->user_id;
        $transaction->save();
        // envoi d'email  
        $rec_methods = ReceivePayMethod::where('is_active',true)->get();
        Mail::to($pay->author()->email)
              ->send(new TransferWaitingMail($pay, $rec_methods ))
              ;
        //
        DB::connection()->getPdo()->commit();
        logContent([
          "category"=>"TRANSFERT",
          Auth()->user()->pseudo." a marqué un transfert -en cours-",
          "#Ref transfert: ".$pay->id_transaction
        ]);
    } catch (\PDOException $e) {

      DB::connection()->getPdo()->rollBack();
      $error = "Une erreur est survenue: ".$e->getMessage();
    }
    if(!empty($error)){
      flash($error)->error();
    }else{
      flash("Marqué en cours aves succès")->success();
    }
    return redirect()->route("admin.transfer.home");

   }

   public function confirm($id)
   {
       $pay = Transfer::findOrFail($id); 
       if($pay->statut == "valid")
       {
            flash('Demande déjà confirmée')->error();
            return redirect()->route("admin.transfer.home");
       }
       if($pay->reject){
            flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
            return redirect()->route("admin.transfer.home");
       }

       if( $pay->tranche_id ){
         $tranche = TransferTranche::find($pay->tranche_id);

         if( $tranche->solde != 0 or $tranche->solde_envoi !=0 ){
            flash('Le transfert par tranche n\'est pas complet. 
            Vous ne pouvez pas le confirmer')
            ->error();
            return redirect()->route("admin.transfer.home");
         }
       }

       try {
        DB::connection()->getPdo()->beginTransaction();

        $pay->statut = "valid";
        $pay->validate_at = new \DateTime();
        $pay->save();
        //
        $transaction = new Transaction();
        $transaction->author_type = "admin";
        $transaction->user_id = auth()->user()->id;
        $transaction->operation_type = "transfert";
        //
        $transaction->devise_id = $pay->devise_id;
        $transaction->real_amount = $pay->receive_amount;
        //
        $transaction->country_from_id = $pay->country_from_id;
        $transaction->recipient_id = $pay->recipient_id;
        //
        $transaction->amount = $pay->amount;
        $transaction->content = 'Transfert confirmé par Tranfert Union';
        $transaction->receiver_id = $pay->author()->id;
        $transaction->save();

        //email
        Mail::to($pay->author()->email)
              ->send(new TransferConfirmMail($pay));
        DB::connection()->getPdo()->commit();
        logContent([
          "category"=>"TRANSFERT",
          Auth()->user()->pseudo." a confirmé un transfert",
          "#Ref transfert: ".$pay->id_transaction
        ]);
      } catch (\PDOException $e) {

          DB::connection()->getPdo()->rollBack();
          $error = "Une erreur est survenue: ".$e->getMessage();
      }
      if(!empty($error)){
        flash($error)->error();
      }else{
        flash("Transfert validé avec succès")->success();
      }
       return redirect()->route("admin.transfer.home");
   }

   public function reject_view($id)
   {
     $pay = Transfer::findOrFail($id); 
     if($pay->statut == "valid")
     {
        flash('Cette demande a été déjà confirmée')->error();
        return $this->redirect()->route("admin.transfer.home");
     }
     if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.transfer.home");
      }
     return view("adminView.transfer.reject",[
        "d"=>$pay,
        "page"=>self::page,
     ]);
   }

   public function reject($id,AdminTransferRequest $request)
   {
      $pay = Transfer::findOrFail($id); 
      if($pay->statut == "valid")
      {
        flash('Cette demande a été déjà confirmée')->error();
        return redirect()->route("admin.transfer.home");
      }
      if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.transfer.home");
      }
      
      $pay->reject_raison = $request->raison;
      $pay->reject = true;
      $pay->reject_at = new \DateTime();

      $pay->save();
      // envoi d'email  
      Mail::to($pay->author()->email)
        ->send(new TransferUndoMail($pay))
      ;
      //
      flash('Rejeter avec succès')->error();
      logContent([
        "category"=>"TRANSFERT",
        Auth()->user()->pseudo." a rejeté un transfert",
        "#Ref transfert: ".$pay->id_transaction
      ]);
      return redirect()->route("admin.transfer.home");
   } 

   public function detail($id)
   {
      $pay = Transfer::findOrFail($id); 
      return view("adminView.transfer.show",[
        "depot"=>$pay,
        "page"=>self::page,
     ]);
   } 
}

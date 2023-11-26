<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDepotRequest;
use App\Mail\DepotConfirmMail;
use App\Mail\DepotWaitingMail;
use Illuminate\Http\Request;
use App\Models\Depot;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DepotController extends Controller
{
    private const page = "deposit";

   public function list()
   {
      $c = Depot::orderBy('id','DESC')->get();
      return view('adminView.deposit.list',[
        "ds"=>$c,
        "page"=>self::page
      ]);
   }

   public function markProgress($id)
   {
    $pay = Depot::findOrFail($id); 
    if($pay->statut == "valid")
    {
        flash('Demande déjà confirmée')->error();
        return redirect()->route("admin.deposit.home");
    }
      if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.deposit.home");
      }
      if($pay->statut == "waiting_validation" ){
        flash('Vous ne pouvez pas effectuer cette opération. 
        Cette demande a été déjà marquée comme étant en cours')->error();
        return redirect()->route("admin.deposit.home");
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
        $transaction->operation_type = "deposit";
        $transaction->amount = $pay->amount;
        //
        $transaction->devise_id = $pay->devise_id;
        $transaction->real_amount = $pay->receive_amount;
        //
        $transaction->content = 'Dépôt en cours de traitement par Tranfert Union';
        $transaction->receiver_id = $pay->user_id;
        $transaction->save();
        // envoi d'email  
        Mail::to($pay->author()->email)
              ->send(new DepotWaitingMail($pay))
              ;
        //
        DB::connection()->getPdo()->commit();
    } catch (\PDOException $e) {

      DB::connection()->getPdo()->rollBack();
      $error = "Une erreur est survenue: ".$e->getMessage();
    }
    if(!empty($error)){
      flash($error)->error();
    }else{
      flash("Marqué en cours aves succès")->success();
    }
    return redirect()->route("admin.deposit.home");

   }

   public function confirm($id)
   {
       $pay = Depot::findOrFail($id); 
       if($pay->statut == "valid")
       {
            flash('Demande déjà confirmée')->error();
            return redirect()->route("admin.deposit.home");
       }
       if($pay->reject){
            flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
            return redirect()->route("admin.deposit.home");
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
        $transaction->operation_type = "deposit";
        //
        $transaction->devise_id = $pay->devise_id;
        $transaction->real_amount = $pay->receive_amount;
        //
        $transaction->amount = $pay->amount;
        $transaction->content = 'Dépôt confirmé par Tranfert Union';
        $transaction->receiver_id = $pay->author()->id;
        $transaction->save();

        //email
        Mail::to($pay->author()->email)
              ->send(new DepotConfirmMail($pay));
        DB::connection()->getPdo()->commit();
      } catch (\PDOException $e) {

          DB::connection()->getPdo()->rollBack();
          $error = "Une erreur est survenue: ".$e->getMessage();
      }
      if(!empty($error)){
        flash($error)->error();
      }else{
        flash("Dépôt validé avec succès")->success();
      }
       return redirect()->route("admin.deposit.home");
   }

   public function reject_view($id)
   {
     $pay = Depot::findOrFail($id); 
     if($pay->statut == "valid")
     {
        flash('Cette demande a été déjà confirmée')->error();
        return $this->redirect()->route("admin.deposit.home");
     }
     if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.deposit.home");
      }
     return view("adminView.deposit.reject",[
        "d"=>$pay,
        "page"=>self::page,
     ]);
   }

   public function reject($id,AdminDepotRequest $request)
   {
      $pay = Depot::findOrFail($id); 
      if($pay->statut == "valid")
      {
        flash('Cette demande a été déjà confirmée')->error();
        return redirect()->route("admin.deposit.home");
      }
      if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.deposit.home");
      }
      
      $pay->reject_raison = $request->raison;
      $pay->reject = true;
      $pay->reject_at = new \DateTime();

      $pay->save();

      flash('Rejeter avec succès')->error();
      return redirect()->route("admin.deposit.home");
   } 

   public function detail($id)
   {
      $pay = Depot::findOrFail($id); 
      return view("adminView.deposit.show",[
        "depot"=>$pay,
        "page"=>self::page,
     ]);
   } 
}

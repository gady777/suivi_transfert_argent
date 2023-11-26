<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    private const page = "deposit";

   public function list()
   {
      $c = Deposit::where('destinate','admin')->orderBy('id','DESC')->get();
      return view('adminView.deposit.list',[
        "demandes"=>$c,
        "page"=>self::page
      ]);
   }

   public function markProgress($id){
    $pay = Deposit::findOrFail($id); 
    if($pay->statut)
    {
        flash('Demande déjà confirmée')->error();
        return redirect()->route("admin.deposit.home");
    }
      if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.deposit.home");
      }
      if($pay->progress){
        flash('Vous ne pouvez pas effectuer cette opération. 
        Cette demande a été déjà marquée comme étant en cours')->error();
        return redirect()->route("admin.deposit.home");
      }
     
    $pay->progress = true;
    try {
        DB::connection()->getPdo()->beginTransaction();
        $pay->save();
        //
        //nouvelle transaction
        // envoi d'email  

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
       $pay = Deposit::findOrFail($id); 
       if($pay->statut)
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

        $pay->statut = true;
        $pay->datePay = new \DateTime();
        $pay->save();

        $user = $pay->author();
        $old = $user->solde;
        $user->solde = $old + $pay->amount;
        $user->save();
        //
        $transaction = new Transaction();
        $transaction->author_type = "admin";
        $transaction->user_id = auth()->user()->id;
        $transaction->operation_type = "deposit";
        $transaction->account_amount = $user->solde;
        $transaction->amount = $pay->amount;
        $transaction->content = 'Dépôt confirmé par Tranfert Union';
        $transaction->receiver_id = $user->id;
        $transaction->save();
        DB::connection()->getPdo()->commit();
      } catch (\PDOException $e) {

          DB::connection()->getPdo()->rollBack();
          $error = "Une erreur est survenue: ".$e->getMessage();
      }
      if(!empty($error)){
        flash($error)->error();
      }else{
        flash("Montant ajouté au compte avec succès")->success();
      }
       return redirect()->route("admin.deposit.home");
   }

   public function reject_view($id)
   {
     $pay = Deposit::findOrFail($id); 
     if($pay->statut)
     {
        flash('Cette demande a été déjà confirmée')->error();
        return $this->redirect()->route("admin.deposit.home");
     }
     if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.deposit.home");
      }
     return view("adminView.deposit.reject",[
        "demande"=>$pay,
        "page"=>self::page,
     ]);
   }

   public function reject($id,PaymentRequest $request)
   {
      $pay = Deposit::findOrFail($id); 
      if($pay->statut)
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
}

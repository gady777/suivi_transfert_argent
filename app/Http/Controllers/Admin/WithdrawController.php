<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    private const page = "withdraw";

   public function list()
   {
      $c = Demande::where('destinate','admin')->orderBy('id','DESC')->get();
      return view('adminView.withdraw.list',[
        "demandes"=>$c,
        "page"=>self::page
      ]);
   }
   public function confirm($id)
   {
       $pay = Demande::findOrFail($id); 
       if($pay->statut)
       {
            flash('Demande déjà confirmée')->error();
            return redirect()->route("admin.withdraw.home");
       }
       if($pay->reject){
            flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
            return redirect()->route("admin.withdraw.home");
       }
       $error = "";
       try {
        DB::connection()->getPdo()->beginTransaction();

        $pay->statut = true;
        $pay->datePay = new \DateTime();
        $pay->save();

        $transaction = new Transaction();
        $transaction->author_type = "admin";
        $transaction->user_id = auth()->user()->id;
        $transaction->operation_type = "withdraw";
        $transaction->amount = $pay->amount;
        $transaction->account_amount = $pay->author()->solde;
        //$transaction->amount = $pay->amount;
        $transaction->content = 'Demande de retrait confirmée par Tranfert Union';
        $transaction->receiver_id = $pay->author()->id;
        $transaction->save();

        DB::connection()->getPdo()->commit();
       } catch (\PDOException $e) {
         
        DB::connection()->getPdo()->rollBack();
        $error = "Une erreur est survenue: ".$e->getMessage();

       }

       if($error){
        flash($error)->error();
        return redirect()->route("admin.withdraw.home");
       }

       flash("Demande de retrait confirmé avec succès")->success();
       return redirect()->route("admin.withdraw.home");
   }

   public function reject_view($id)
   {
     $pay = Demande::findOrFail($id); 
     if($pay->statut)
     {
        flash('Cette demande a été déjà confirmée')->error();
        return $this->redirect()->route("admin.withdraw.home");
     }
     if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.withdraw.home");
      }
     return view("adminView.withdraw.reject",[
        "demande"=>$pay,
        "page"=>self::page,
     ]);
   }

   public function reject($id,PaymentRequest $request)
   {
      $pay = Demande::findOrFail($id); 
      if($pay->statut)
      {
        flash('Cette demande a été déjà confirmée')->error();
        return redirect()->route("admin.withdraw.home");
      }
      if($pay->reject){
        flash('Vous ne pouvez pas effectuer cette opération. Cette demande a été déjà rejetée')->error();
        return redirect()->route("admin.withdraw.home");
      }
      
      $pay->reject_raison = $request->raison;
      $pay->reject = true;
      $pay->reject_at = new \DateTime();

      $pay->save();

      flash('Rejeter avec succès')->error();
      return redirect()->route("admin.withdraw.home");
   } 
}

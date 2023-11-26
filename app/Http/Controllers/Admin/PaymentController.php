<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Transaction;
use DateTime;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
   private const page = "payment";

   public function list()
   {
      $c = Payment::all();
      return view('adminView.payment.list',[
        "payments"=>$c,
        "page"=>self::page
      ]);
   }

   public function show($id)
   {
     $pay = Payment::findOrFail($id);
     return view('adminView.payment.show',[
       "page"=>self::page,
       "payment"=>$pay
     ]);
   }
   public function confirm($id)
   {
     $error = "";
       $pay = Payment::findOrFail($id); 
       if($pay->confirm)
       {
            flash('Ce payment a été déjà confirmé')->error();
            return redirect()->route("admin.payment.show",["id"=>$pay->id]);
       }
       if($pay->confirm)
       {
            flash('Ce payment a été déjà rejetée, vous ne pouvez pas effectuer cette opération')->error();
            return redirect()->route("admin.payment.show",["id"=>$pay->id]);
       }
       try {
        DB::connection()->getPdo()->beginTransaction();
        $pay->confirm = true;
        $pay->confirm_at = new DateTime();
        $pay->save();

        $transaction = new Transaction();
        $transaction->author_type = "admin";
        $transaction->user_id = auth()->user()->id;
        $transaction->operation_type = "payment";
        $transaction->account_amount = $pay->user()->solde;
        //$transaction->amount = $pay->amount;
        $transaction->content = 'Demande de paiement confirmé par Tranfert Union';
        $transaction->receiver_id = $pay->user()->id;
        $transaction->save();
        //
        DB::connection()->getPdo()->commit();
       }catch(\PDOException $e){

        DB::connection()->getPdo()->rollBack();
        $error = "Une erreur est survenue: ".$e->getMessage();

       }
       if($error){
        flash($error)->error();
        return redirect()->route("admin.payment.show",["id"=>$pay->id]);
       }

       flash("Payment confirmé avec succès")->success();
       return redirect()->route("admin.payment.show",["id"=>$pay->id]);
   }

   public function reject_view($id)
   {
     $pay = Payment::findOrFail($id); 
     if($pay->confirm)
     {
        flash('Ce payment a été déjà confirmé')->error();
        return $this->redirect()->route("admin.payment.show",["id"=>$pay->id]);
     }
     if($pay->confirm)
      {
        flash('Ce payment a été déjà rejetée, vous ne pouvez pas effectuer cette opération')->error();
        return redirect()->route("admin.payment.show",["id"=>$pay->id]);
      }
     return view("adminView.payment.reject",[
        "payment"=>$pay,
        "page"=>self::page,
     ]);
   }

   public function reject($id,PaymentRequest $request)
   {
      $pay = Payment::findOrFail($id); 
      if($pay->confirm)
      {
        flash('Ce payment a été déjà confirmé')->error();
        return redirect()->route("admin.payment.show",["id"=>$pay->id]);
      }
      if($pay->confirm)
       {
            flash('Ce payment a été déjà rejetée, vous ne pouvez pas effectuer cette opération')->error();
            return redirect()->route("admin.payment.show",["id"=>$pay->id]);
       }
      
      $pay->raison = $request->raison;
      $pay->reject = true;
      $pay->reject_at = new \DateTime();

      $pay->save();

      flash('Rejeter avec succès')->error();
      return redirect()->route("admin.payment.show",[
          "id"=>$pay->id,
      ]);
   }     
}

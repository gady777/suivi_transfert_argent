<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCurrencyRequest;
use App\Http\Requests\ReceivePayMethodRequest;
use App\Models\ReceivePayMethod;
use App\Models\TransferMethod;
use Illuminate\Http\Request;

/**
* ReceivePayMethodController
*/
class ReceivePayMethodController extends Controller
{
   private const page = "receive_pay_method";

   public function list(){
      $c = ReceivePayMethod::where('is_active',true)->get();
      return view('adminView.receive_pay_method.list',[
        "ms"=>$c,
        "page"=>self::page,
      ]);
   }

   public function create_view(){
     return view('adminView.receive_pay_method.create',[
       "page"=>self::page,
       "methods"=>TransferMethod::all()
     ]);
   }
   public function create(ReceivePayMethodRequest $request){
     $meth = new ReceivePayMethod();
     $mm = TransferMethod::where('slug',$request->method)->first();
     $meth->method_id = $mm->id;
     $meth->account_name = $request->account_name;
     $meth->bank_name = $request->bank_name;
     $meth->account_number = $request->account_number;
     $meth->rib = $request->rib;
     $meth->interact = $request->interact;
     $meth->phone_number = $request->phone_number;
     $meth->phone_name = $request->phone_name;
     $meth->cash_cni = $request->cash_cni;
     $meth->cash_name_fname = $request->cash_name_fname;
     $meth->save();
     flash("Méthode de réception ajoutée avec succès")->success();
     logContent([
      "category"=>"METHODE DE RECEPTION",
      Auth()->user()->pseudo." a ajouté une nouvelle méthode de réception",
      "Id meth: #".$meth->id." #".$mm->name
     ]);
     return redirect()->route("admin.receive_pay_method.home");
   }

   public function edit_view($id){
     $devise = ReceivePayMethod::where("id",$id)->where('is_active',true)->firstOrFail();
     return view('adminView.receive_pay_method.edit',[
       "page"=>self::page,
       "r"=>$devise,
       "methods"=>TransferMethod::all()
     ]);
   }
   public function edit($id, ReceivePayMethodRequest $request){
     $meth = ReceivePayMethod::findOrFail($id);
     $mm = TransferMethod::where('slug',$request->method)->first();
     $meth->method_id = $mm->id;
     //
     $meth->account_name = $request->account_name;
     $meth->bank_name = $request->bank_name;
     $meth->account_number = $request->account_number;
     $meth->rib = $request->rib;
     $meth->interact = $request->interact;
     $meth->phone_number = $request->phone_number;
     $meth->phone_name = $request->phone_name;
     $meth->cash_cni = $request->cash_cni;
     $meth->cash_name_fname = $request->cash_name_fname;
     $meth->save();
     //
     flash("Méthode modifiée avec succès")->success();
     logContent([
      "category"=>"METHODE DE RECEPTION",
      Auth()->user()->pseudo." a modifié une méthode de réception",
      "Id meth: #".$meth->id." #".$mm->name
     ]);
     return redirect()->route("admin.receive_pay_method.home");
   }

   public function delete($id){
     $devise = ReceivePayMethod::findOrFail($id);
     $devise->is_active = false;
     $devise->save();
     flash("Méthode supprimée avec succès")->error();
     logContent([
      "category"=>"METHODE DE RECEPTION",
      Auth()->user()->pseudo." a supprimé une méthode de réception",
      "Id meth: #".$devise->id." #".$devise->method()->name
     ]);
     return redirect()->route("admin.receive_pay_method.home");
   }

}

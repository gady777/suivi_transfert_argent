<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessingFeeRequest;
use App\Models\Devise;
use Illuminate\Http\Request;
use App\Models\ProcessingFee;

class ProcessingFeeController extends Controller
{
    private const page = "processing_fee";

    public function list(){
        $c = ProcessingFee::all();
        return view('adminView.processing_fee.list',[
          "fees"=>$c,
          "page"=>self::page
        ]);
    }

    public function showByCurrencyId($id){
        $devise = Devise::findOrFail($id);
        $c = $devise->processingFee()->first();
        return view('adminView.processing_fee.show',[
          "fee"=>$c,
          "page"=>self::page,
          "currency"=>$devise
        ]);
    }

    public function edit($id,ProcessingFeeRequest $request){
      $devise = Devise::findOrFail($id);
      $c = $devise->processingFee()->first();
      if(!$c){
        $c = new ProcessingFee();
        $c->currency_id = $id;
      }
      $c->withdraw_fee = $request->withdraw_fee;
      $c->minim_bank_account = $request->minim_bank_account;
      $c->minim_transfert_to_momo = $request->minim_transfert_to_momo;
      $c->minim_tarnsfert_to_paypal = $request->minim_tarnsfert_to_paypal;
      $c->save();
      flash("Modifié avec succès")->info();
     return redirect()->route("admin.processing_fee.home");
    }
}

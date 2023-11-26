<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnlineBankRequest;
use Illuminate\Http\Request;
use App\Models\OnlineBank;

class OnlineBankController extends Controller
{
    private const page = "bank";

   public function list(){
      $c = OnlineBank::all();
      return view('adminView.bank.list',[
        "banks"=>$c,
        "page"=>self::page
      ]);
   }

   public function create_view(){
     return view('adminView.bank.create',[
       "page"=>self::page
     ]);
   }
   public function create(OnlineBankRequest $request){
     $devise = new OnlineBank();
     $devise->account_name = $request->account_name;
     $devise->bank_name = $request->bank_name;
     $devise->number = $request->number;
     $devise->is_active = true;
     $devise->save();
     flash("Banque ajoutée avec succès")->success();
     return redirect()->route("admin.bank.home");
   }

   public function edit_view($id){
     $devise = OnlineBank::findOrFail($id);
     return view('adminView.bank.edit',[
       "page"=>self::page,
       "bank"=>$devise
     ]);
   }
   public function edit($id, OnlineBankRequest $request){
     $devise = OnlineBank::findOrFail($id);
     $devise->account_name = $request->account_name;
     $devise->bank_name = $request->bank_name;
     $devise->number = $request->number;
     $devise->save();
     flash("Banque modifiée avec succès")->success();
     return redirect()->route("admin.bank.home");
   }

   public function delete($id){
     $devise = OnlineBank::findOrFail($id);
     if($devise->is_active){
        $devise->is_active = false;
        flash("Banque supprimée avec succès")->error();
        return redirect()->route("admin.bank.home");
     }
     flash("Cette banque était déjà supprimée")->info();
     return redirect()->route("admin.bank.home");
   }
}

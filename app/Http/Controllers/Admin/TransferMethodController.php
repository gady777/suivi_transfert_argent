<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransferMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransferMethodController extends Controller
{
    private const page = "transfer_method";

    public function list(){
        return view("adminView.transfer.method.list",[
            "page"=>self::page,
            "ms"=>TransferMethod::all()
        ]);
    }
    public function create_view(){
        return view("adminView.transfer.method.create",[
            "page"=>self::page
        ]);
    }
    public function create(Request $request){
        $inp = $request->all();
        $val = Validator::make($inp,[
            "name"=>["required","max:50"],
            "fee"=>["required","numeric","max:100"],
        ]);
        if($val->fails()){
            return back()->withErrors($val);
        }

        $d = new TransferMethod();
        $d->name = $request->name;
        $d->fee = $request->fee;

        $d->save();

        flash("Méthode ajoutée avec succès")->success();
        logContent([
            "category"=>"METHODE DE TRANSFERT",
            Auth()->user()->pseudo." a ajouté une nouvelle méthode de transfert",
            "#ID Methode: ".$d->id." #Nom: ".$d->name
        ]);
        return redirect()->route("admin.transfer.method.home");
    }

    public function edit_view($id){
        $meth = TransferMethod::findOrFail($id);
        return view("adminView.transfer.method.edit",[
            "page"=>self::page,
            "m"=>$meth
        ]);
    }
    public function edit(Request $request,$id){
        $inp = $request->all();
        $d = TransferMethod::findOrFail($id);
        $val = Validator::make($inp,[
            "name"=>["required","max:50"],
            "fee"=>["required","numeric","max:100"],
        ]);
        if($val->fails()){
            return back()->withErrors($val);
        }
        $d->name = $request->name;
        $d->fee = $request->fee;

        $d->save();

        flash("Méthode modifiée avec succès")->success();
        logContent([
            "category"=>"METHODE DE TRANSFERT",
            Auth()->user()->pseudo." a modifié une méthode de transfert",
            "#ID Methode: ".$d->id." #Nom: ".$d->name
        ]);
        return redirect()->route("admin.transfer.method.home");
    }

    public function delete($id){
        $d = TransferMethod::findOrFail($id);
        $d->delete();
        flash("Méthode supprimée avec succès")->error();
        logContent([
            "category"=>"METHODE DE TRANSFERT",
            Auth()->user()->pseudo." a supprimé une méthode de transfert",
            "#ID Methode: ".$d->id." #Nom: ".$d->name
        ]);
        return redirect()->route("admin.transfer.method.home");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepotMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepotMethodController extends Controller
{
    private const page = "depot_method";

    public function list(){
        return view("adminView.deposit.method.list",[
            "page"=>self::page,
            "ms"=>DepotMethod::all()
        ]);
    }
    public function create_view(){
        return view("adminView.deposit.method.create",[
            "page"=>self::page
        ]);
    }
    public function create(Request $request){
        $inp = $request->all();
        $val = Validator::make($inp,[
            "slug"=>["required","max:15"],
            "name"=>["required","max:50"],
            "fee"=>["required","numeric","max:100"],
        ]);
        if($val->fails()){
            return back()->withErrors($val);
        }

        $d = new DepotMethod();
        $d->slug = $request->slug;
        $d->name = $request->name;
        $d->fee = $request->fee;

        $d->save();

        flash("Méthode ajoutée avec succès")->success();

        return redirect()->route("admin.depot.method.home");
    }

    public function edit_view($id){
        $meth = DepotMethod::findOrFail($id);
        return view("adminView.deposit.method.edit",[
            "page"=>self::page,
            "m"=>$meth
        ]);
    }
    public function edit(Request $request,$id){
        $inp = $request->all();
        $d = DepotMethod::findOrFail($id);
        $val = Validator::make($inp,[
            "slug"=>["required","max:15"],
            "name"=>["required","max:50"],
            "fee"=>["required","numeric","max:100"],
        ]);
        if($val->fails()){
            return back()->withErrors($val);
        }
        $d->slug = $request->slug;
        $d->name = $request->name;
        $d->fee = $request->fee;

        $d->save();

        flash("Méthode modifiée avec succès")->success();

        return redirect()->route("admin.depot.method.home");
    }

    public function delete($id){
        $d = DepotMethod::findOrFail($id);
        $d->delete();
        flash("Méthode supprimée avec succès")->error();

        return redirect()->route("admin.depot.method.home");
    }
}

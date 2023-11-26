<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryEditRequest;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\Models\Devise;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private const page = 'country';

    public function list(){
        return view('adminView.country.list',[
            "countries"=>Country::all(),
            "page"=>self::page
        ]);
    }

    public function create_view(){
        return view("adminView.country.create",[
            "page"=>self::page,
            "devises"=>Devise::all()
        ]);
    }

    public function create(CountryRequest $request){
        $c = new Country();
        $c->name = $request->name;
        $c->code = $request->code;
        $c->devise_id = $request->devise;

        $c->save();

        flash("Pays ajouté avec succès")->success();

        return redirect()->route('admin.country.home');
    }

    public function edit_view($id){
        $c = Country::findOrFail($id);
        return view("adminView.country.edit",[
            "page"=>self::page,
            "country"=>$c,
            "devises"=>Devise::all()
        ]);
    }
    public function edit(CountryEditRequest $request,$id){
        $c = Country::findOrFail($id);
        $c->name = $request->name;
        $c->code = $request->code;
        $c->devise_id = $request->devise;

        $c->save();

        flash("Pays modifié avec succès")->success();

        return redirect()->route('admin.country.home');
    }

    public function delete($id){
        $c = Country::findOrFail($id);
        $c->delete();

        flash("Pays supprimé avec succès")->success();

        return redirect()->route('admin.country.home');
    }
}

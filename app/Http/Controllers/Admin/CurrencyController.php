<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCurrencyRequest;
use Illuminate\Http\Request;
use App\Models\Devise;
use App\Models\DeviseArchive;

/**
* Devise
*/
class CurrencyController extends Controller
{
   private const page = "currency";

   public function list(Request $r){
     $devise = $r->query->get('devise');
     $date1 = $r->query->get('date1');
     $date2 = $r->query->get('date2');
     //
    if($devise or $date1){
      $ok_dev = Devise::where('id',$devise)->where('is_active',true)->first();
      if(!$ok_dev){
        flash("La devise est incorrecte")->error();
        return redirect()->route("admin.currency.home");
      }
      $devs = DeviseArchive::where('abbreviation',$ok_dev->abbreviation);
      if($date1){
        $devs = $devs->where('was_created_at','>=',$date1);
      }
      if($date2){
        $devs = $devs->where('created_at','<=',$date2);
      }
      $devs=$devs->orderBy('id','DESC')->get();                                              
                            
    }else{
      $devs = DeviseArchive::orderBy('id','DESC')->get();
    }
    $c = Devise::where('is_active',true)->get();
    return view('adminView.currency.list',[
        "currencies"=>$c,
        "page"=>self::page,
        "archives"=> $devs,
        "devise"=>$devise,
        "date1"=>$date1,
        "date2"=>$date2
    ]);

   }

   public function create_view(){
     return view('adminView.currency.create',[
       "page"=>self::page
     ]);
   }
   public function create(CreateCurrencyRequest $request){
     $devise = new Devise();
     $devise->intitule = $request->intitule;
     $devise->symbole = $request->symbole;
     $devise->abbreviation = $request->abbreviation;
     $devise->rate = $request->rate;
     $devise->is_active = true;
     $devise->save();
     flash("Devise ajoutée avec succès")->success();
     //
     logContent([
        "category"=>"DEVISE",
        Auth()->user()->pseudo." a ajouté une nouvelle devise:",
        "#ID devise:".$devise->id." #".$request->intitule." #"
            .$request->symbole." #"
            .$request->abbreviation." #"
            .$request->rate,
        
     ]);
     //
     return redirect()->route("admin.currency.home");
   }

   public function edit_view($id){
     $devise = Devise::findOrFail($id);
     return view('adminView.currency.edit',[
       "page"=>self::page,
       "currency"=>$devise
     ]);
   }
   public function edit($id, CreateCurrencyRequest $request){
     $devise = Devise::findOrFail($id);
     //Archives
      $archive = new DeviseArchive();
      $archive->intitule = $devise->intitule;
      $archive->symbole = $devise->symbole;
      $archive->abbreviation = $devise->abbreviation;
      $archive->rate = $devise->rate;
      $archive->was_created_at = $devise->updated_at??$devise->created_at;
      $archive->save();
     //
     $devise->intitule = $request->intitule;
     $devise->symbole = $request->symbole;
     $devise->abbreviation = $request->abbreviation;
     $devise->rate = $request->rate;
     $devise->save();
     //
     flash("Devise modifiée avec succès")->success();
      logContent([
        "category"=>"DEVISE",
        Auth()->user()->pseudo." a modifié une devise:",
        "#ID devise:".$devise->id." #".$request->intitule." #"
            .$request->symbole." #"
            .$request->abbreviation." #"
            .$request->rate,
      ]);
     return redirect()->route("admin.currency.home");
   }

   public function delete($id){
     $devise = Devise::findOrFail($id);
     $devise->is_active = false;
     $devise->save();
     flash("Devise supprimée avec succès")->error();
     logContent([
      "category"=>"DEVISE",
      Auth()->user()->pseudo." a supprimé une devise:",
      "#ID devise:".$devise->id." #".$devise->intitule." #"
          .$devise->symbole." #"
          .$devise->abbreviation." #"
          .$devise->rate,
      
   ]);
     return redirect()->route("admin.currency.home");
   }

}

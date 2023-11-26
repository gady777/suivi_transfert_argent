<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\TransferTranche;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{

    public function transferSimpleArchive()
    {
        $c = Transfer::where('archive',true)
                      ->orderBy('id','DESC')
                      ->get();
        return view("adminView.archive.transfer.list",[
            "ds"=>$c,
            "page"=>"archive_trans"
        ]);
    }
    public function transferTrancheArchive()
    {
        return view("adminView.archive.transfer_tranche.list",[
            "ts"=> TransferTranche::where('archive',true)->orderBy('id','DESC')->get(),
            "page"=>"archive_trans_tranche"
        ]);
    }

    public function manageTransferArchive($id){
        $t = Transfer::findOrFail($id);
        if($t->archive){
            // désarchivé
            $t->archive = false;
            $t->archive_date = null;
        }else{
            $t->archive = true;
            $t->archive_date = new \DateTime();
        }
        $t->save();
        flash("Opération réussie !")->success();
        return redirect()->route("admin.transfer.home");
    }
    public function manageTransferTrancheArchive($id){
        $t = TransferTranche::findOrFail($id);
        if($t->archive){
            // désarchivé
            $t->archive = false;
            $t->archive_date = null;
        }else{
            $t->archive = true;
            $t->archive_date = new \DateTime();
        }
        $t->save();
        flash("Opération réussie !")->success();
        return redirect()->route("admin.transfer.tranche.home");
    }
}

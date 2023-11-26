<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use PDF;
use App\Models\User;

class InvoiceController extends Controller
{
    public function getInvoice($id){
      //$id = depot_id
      $deposit = Deposit::findOrFail($id);
      if($deposit->author()->id != Auth()->user()->id){
        return redirect()->route("u.dashboard");
      }
      
      $pdf = PDF::loadView('invoice', [
        'user'=>Auth()->user(),
        "receiver"=>User::find($deposit->idReceve),
        "receiver_type"=>$deposit->destinate,
        "deposit"=>$deposit
      ]);

      return $pdf->download('transfert-union-invoice.pdf');
    }
}

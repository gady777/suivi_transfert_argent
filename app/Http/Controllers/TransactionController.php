<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{
    function History()
    {
        $data = Transaction::where('receiver_id',Auth::user()->id)
                    ->orderBy('id',"DESC")
                    ->get();

        return view('usersView.transaction.store',[
            'transactions'=>$data,
            "page_name"=>"transaction"
        ]);
    }
}

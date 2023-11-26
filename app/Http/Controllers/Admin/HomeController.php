<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private const page_name = "home";

    public function home()
    {
        $news_number = count(News::all());
        $users_number = count(
            DB::table("users")
                ->where('is_active','=',true)
                ->get()
        );
        $depots =  count(
            DB::table("transfers")
                
                ->get()
        );
        $devs =  count(
            DB::table("devises")
                ->get()
        );
        $ds = Transfer::orderBy('id','DESC')
                         ->where('archive',false)
                        ->take(10)
                        ->get();
        //$trans = Transaction::orderBy('id','DESC')->get();

        return view("adminView.dashboard",[
            "page"=>self::page_name,
            "deposits"=>$depots,
            "users_number"=>$users_number,
            "ds"=>$ds,
            "devises"=>$devs
        ]);
    }
}

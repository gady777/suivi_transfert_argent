<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\DepositMoneyRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private const page = "user";

    public function list(){
        $users = User::where('role','!=',1)->get();
        return view("adminView.user.list",[
            "users"=>$users,
            "page"=>self::page
        ]);
    }
    public function list_admin(){
      $users = User::where('role',1)->get();
      return view("adminView.user.list_admin",[
          "users"=>$users,
          "page"=>"user_admin"
      ]);
  }

    public function profile($id){
      $user = User::findOrFail($id);
      $transactions = Transaction::where('receiver_id',$id)->orderBy('id','DESC')->get();
      return view("adminView.user.profile",[
        "user"=>$user,
        "page"=>self::page,
        "transactions"=>$transactions
      ]);
    }

    public function blockAccount($id){
      $user = User::findOrFail($id);
      if(!$user->is_active){
        flash("Cet utilisateur n'est pas actif sur le site")->error();
        return redirect()->back();
      }
      if($user->role == 1){
        flash("Cet utilisateur est un administrateur")->error();
        return redirect()->back();
      }
      $user->is_active = false;
      $user->desactivated_by = "admin";
      $user->desactivated_at = new \DateTime();
      $user->admin_can_active_account = true;
      $user->save();
      // déconnecter l'utilisateur ici
      flash("Utilisateur bloqué avec succès")->success();
      logContent([
        "category"=>"COMPTE CLIENT",
        Auth()->user()->pseudo." a bloqué le compte du client: ".$user->pseudo,
        "#ID compte: ".$user->id
      ]);
      return redirect()->route('admin.user.profile',["id"=>$user->id]);
    }

    public function unblockAccount($id){
      $user = User::findOrFail($id);
      if($user->is_active){
        flash("Cet utilisateur est actif sur le site")->error();
        return redirect()->back();
      }

      if($user->desactivated_by == "user"){
        flash("Vous ne pouvez pas activer ce compte. Il a été désactivé par l'utilisateur lui-même")->error();
        return redirect()->back();
      }
      $user->is_active = true;
      $user->desactivated_by = null;
      $user->desactivated_at = null;
      $user->admin_can_active_account = true;
      $user->save();
      // déconnecter l'utilisateur ici
      flash("Utilisateur débloqué avec succès")->success();
      logContent([
        "category"=>"COMPTE CLIENT",
        Auth()->user()->pseudo." a activé le compte du client: ".$user->pseudo,
        "#ID compte: ".$user->id
      ]);
      return redirect()->route('admin.user.profile',["id"=>$user->id]);
    }

    public function deposit_view($id){
        $user = User::findOrFail($id);
        return view("adminView.user.deposit",[
          "page"=>self::page,
          "user"=>$user
        ]);
    }
    public function deposit(DepositMoneyRequest $request,$id){
        $user = User::findOrFail($id);
        $error = "";
        try {
            DB::connection()->getPdo()->beginTransaction();

            $old = $user->solde;
            $user->solde = $old + $request->amount;
            $user->save();
            //
            $transaction = new Transaction();
            $transaction->author_type = "admin";
            $transaction->user_id = auth()->user()->id;
            $transaction->operation_type = "deposit_admin";
            $transaction->account_amount = $user->solde;
            $transaction->amount = $request->amount;
            $transaction->content = 'Dépôt sur votre compte par Tranfert Union';
            $transaction->receiver_id = $user->id;
            $transaction->save();
            //notifier le receiver ici
            DB::connection()->getPdo()->commit();
        } catch (\PDOException $e) {

            DB::connection()->getPdo()->rollBack();
            $error = "Une erreur est survenue: ".$e->getMessage();
        }
        if(!empty($error)){
          flash($error)->error();
        }else{
          flash("Montant ajouté au compte avec succès")->success();
        }
        return redirect()->route("admin.user.profile",[
          "id"=>$id,
        ]);
    }
    public function withdraw_view($id){
      $user = User::findOrFail($id);
      return view("adminView.user.withdraw",[
        "page"=>self::page,
        "user"=>$user
      ]);
    }
    public function withdraw(DepositMoneyRequest $request,$id){
      $user = User::findOrFail($id);
      $error = "";
      if($user->solde < $request->amount){
        $error = "Le solde dans le compte est insuffisant pour cette opération";
        goto end;
      }
      try {
          DB::connection()->getPdo()->beginTransaction();

          $old = $user->solde;
          $user->solde = $old - $request->amount;
          $user->save();
          //
          $transaction = new Transaction();
          $transaction->author_type = "admin";
          $transaction->user_id = auth()->user()->id;
          $transaction->operation_type = "withdraw_admin";
          $transaction->account_amount = $user->solde;
          $transaction->amount = $request->amount;
          $transaction->content = '<strong>Retrait</strong> de votre compte par les administrateurs';
          $transaction->receiver_id = $user->id;
          $transaction->save();
          //notifier le receiver ici
          DB::connection()->getPdo()->commit();
      } catch (\PDOException $e) {

          DB::connection()->getPdo()->rollBack();
          $error = "Une erreur est survenue: ".$e->getMessage();
      }
      end:
      if(!empty($error)){
        flash($error)->error();
      }else{
        flash("Montant retiré du compte avec succès")->success();
      }
      return redirect()->route("admin.user.profile",[
        "id"=>$id,
      ]);
    }

    //role

    public function assignRoleAdmin($id)
    {
      $user = User::where("id",$id)->where('id','!=',Auth()->user()->id)->first();
      if(!$user){
        abort(404);
      }
      $user->role = 1;

      $user->save();

      flash("Cet utilisateur est désormais un admin");

      return redirect()->route('admin.user.profile',['id'=>$id]);
    }
    public function revokeAdmin($id)
    {
      $user = User::where("id",$id)->where('id','!=',Auth()->user()->id)->first();
      if(!$user){
        abort(404);
      }
      $user->role = 2;

      $user->save();

      flash("Cet utilisateur est désormais un particulier");

      return redirect()->route('admin.user.profile',['id'=>$id]);
    }

    // role by admin
    /*
    * controlleur, client, gestionnaire de compte
    */
    public function adminGiveRole($id,Request $request){
      $user = User::findOrFail($id);
      $inp = $request->all();
      $val = Validator::make($inp,[
        "role"=>[
          Rule::in(['client','controleur','gestion',''])
        ]
      ]);

      if($val->fails()){
        return back()->withErrors($val);
      }

      
      $user->role_by_admin = $inp['role'];

      $user->save();

      flash("Rôle attribué avec succès")->success();

      return redirect()->route("admin.user.profile",['id'=>$id]);
    }

}

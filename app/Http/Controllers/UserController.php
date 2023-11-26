<?php

namespace App\Http\Controllers;

use App\Models\Devise;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function dashboard()
    {
        $ts=Transfer::where('user_id',Auth()->user()->id)
                        ->orderBy('id','DESC')
                        ->take(10)
                        ->get();
                    
        return view('usersView.dashboard',[
            'page_name'=>"dashboard",
            "ts"=>$ts
        ]); 
    }

    function profil() {
        $data= User::find(Auth::user()->id);
        return view('usersView.profil.show',[
            'infos'=>$data,
            "page_name"=>'profile'
        ]);
    }
    function PhotoProfil(Request $req){

        $req->validate([
            'photo'=>'required|file|mimes:png,jpg,jpeg,pdf,docx,doc|max:5000000',
        ]);

        $dest = public_path('upload_profil');
        $name ='pictur_'.time().'-'.uniqid().'.'.$req['photo']->extension();

        $req['photo']->move($dest, $name);

        $pay= User::find(Auth::user()->id);
        $pay->photo='upload_profil/'.$name;
        $pay->save();

        return redirect()->route('u.profil');
    }
    function DeletePhotoProfil(){

        $pay= User::find(Auth::user()->id);
        $tmp = $pay->photo;
        if($tmp){
            // supprimer du disque
            if(File::exists(public_path($tmp))){
                File::delete(public_path($tmp));
            }
        }
        $pay->photo=null;
        
        $pay->save();

        return redirect()->route('u.profil');
    }

    function Updateprofil()
    {
        $data= DB::table('users')->where('id',Auth::user()->id)->get();

        return view('usersView.profil.edit',[
            'infos'=>$data,
            "page_name"=>'profile'
        ]);
    }
    function SaveProfil(Request $req)
    {
        $req->validate([
            'pseudo' => ['required', 'string', 'max:255','regex:/^[A-Za-z0-9_]+$/'],
            /*'dateAnnif' => ['required'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required'],
            'password_confirmation'=> ['required']*/
        ]);
        if($req['type']=="ind"){
            $user = User::find($req['id']);

            $user->pseudo = $req['pseudo'];
            $user->firstname = $req['firstname'];
            $user->lastname = $req['lastname'];
            $user->dateAnnif = $req['dateAnnif'];
            $user->telephoneUser = $req['telephoneUser'];
            $user->adresse = $req['adresse'];
            $user->save();

        }elseif($req['type']=="pro"){

            $user = User::find($req['id']);

            $user->pseudo = $req['pseudo'];
            $user->firstname = $req['firstname'];
            $user->lastname = $req['lastname'];
            $user->dateAnnif = $req['dateAnnif'];
            $user->telephoneUser = $req['telephoneUser'];
            $user->telephoneSociete = $req['telephoneSociete'];
            $user->adresse = $req['adresse'];
            $user->adresseSociete = $req['adresseSociete'];
            $user->save();

        }



        return redirect()->route('u.profil');
    }

    function SavePassword(Request $request)
    {
        $input = $request->all();
        $val = Validator::make($input,[
            "password"=>$this->passwordRules()
        ]);
        if($val->fails()){
            return back()->withErrors($val); 
        }
        $user = User::where('id',Auth()->user()->id)->first();

        if( Hash::check($input['old_password'], $user->password) == false ){
            return back()->withErrors($val)->with("password_error","Ancien mot de passe incorrect"); 
        }
        $p = Hash::make($input['password']);
        $user->password = $p;
        $user->save();
        
        return redirect()->route("u.profil")->with("success","Mot de passe modifié avec succès");
    }

    function Setting(){
        $data= DB::table('users')->where('id',Auth::user()->id)
        ->get(['language_id', 'currency', 'is_active' , 'quiz1_id', 'answer1', 'quiz2_id', 
        'answer2', 'quiz3_id', 'answer3' ]);


        return view('usersView.setting',[
            'infos'=>$data,
            'page_name'=>'setting',
            "devises"=>Devise::all()
        ]);
    }

    function SaveSetting(Request $req){

        $user = User::find(Auth::user()->id);
        $user->language_id = $req['language'];
        $user->currency = $req['currency'];

        $user->quiz1_id=$req['quiz1'];
        $user->answer1 =$req['answer1'];

        $user->quiz2_id=$req['quiz2'];
        $user->answer2 =$req['answer2'];

        $user->quiz3_id=$req['quiz3'];
        $user->answer3 =$req['answer3'];

        $user->save();

        return redirect()->route('u.setting')->with('msg','Modification enregistrée');
    }
    function Inactif(Request $req){

        $user = User::find(Auth::user()->id);
        $user->is_active = 0;
        $user->desactivated_by='User';
        $user->desactivated_at= date('Y-m-d H:i');
        $user->save();


        auth()->logout();
        return redirect('/');

        //return redirect()->route('u.setting')->with('msg-inactif','Compte à été bloqué');
    }

    function Actif(Request $req){

        $user = User::find(Auth::user()->id);
        $user->is_active = 1;
        $user->desactivated_by=null;
        $user->desactivated_at=null;
        $user->save();

        return redirect()->route('u.setting')->with('msg-actif','Compte à été débloqué');
    }
}

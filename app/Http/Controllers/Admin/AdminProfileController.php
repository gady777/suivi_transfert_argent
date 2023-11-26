<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class AdminProfileController extends Controller
{
    use PasswordValidationRules;

    private const page = 'profile';

    public function index()
    {
        return view('adminView.admin.profile',[
            "user"=>Auth()->user(),
            "page"=>self::page        
        ]);
    }

    public function updateProfileImage(Request $request){
        $val = Validator::make($request->all(),[
            "photo"=>[
                'required', 
                'file', 
                'mimes:png,jpg,jpeg'
            ]
        ]);

        if($val->fails()){
            return back()->withErrors($val); 
        }

        $dest = public_path('upload_profil');
        $name ='pictur_'.time().'-'.uniqid().'.'.$request['photo']->extension();

        $request['photo']->move($dest, $name);

        $pay= User::find(Auth()->user()->id);
        $tmp = $pay->photo;
        $pay->photo='upload_profil/'.$name;
        $pay->save();

        if(File::exists(public_path($tmp))){
            File::delete(public_path($tmp));
        }

        flash("Photo de profil modifiée avec succès")->success();
        return redirect()->route("admin.profile.home");
    }

    function DeletePhotoProfil()
    {

        $pay= User::find(Auth()->user()->id);
        $tmp = $pay->photo;
        if($tmp){
            // supprimer du disque
            if(File::exists(public_path($tmp))){
                File::delete(public_path($tmp));
            }
        }
        $pay->photo=null;
        
        $pay->save();

        flash('Photo supprimée avec succès')->success();

        return redirect()->route('admin.profile.home');
    }

    public function updateName(Request $request){
        $input = $request->all();
        $val = Validator::make($input,[
            "pseudo"=>[
                'required', 
                'string', 
                'max:255',
                'regex:/^[A-Za-z0-9_]+$/',
            ]
        ]);

        if($val->fails()){
            return back()->withErrors($val); 
        }

        $pseudo = $input['pseudo'];

        $ps = User::where('pseudo',$pseudo)->first();

        if($ps){
            if($ps->id !=  Auth()->user()->id ){
                return back()->withInput()->with('name_error','Ce pseudo est déjà utilisé par un autre utilisateur');
            }
        }

        $user = User::where('id',Auth()->user()->id)->first();
        $user->pseudo = $input['pseudo'];
        $user->lastname = $input['lastname'];
        $user->firstname = $input['firstname'];

        $user->save();

        flash('Informations modifiées avec succès')->success();

        return redirect()->route('admin.profile.home');
    }

    public function updateLogin(Request $request)
    {
        $email = $request->email;
        if(empty($email) or  \filter_var($email,FILTER_VALIDATE_EMAIL) == false ){
            $error = "Veuillez renseigner un email valide";
            return back()->withInput()->with('mail_error',$error);
        }

        $old = User::where('email',$email)->first();

        if( $old ){
            if( $old->id == Auth()->user()->id ){
                return back()->withInput(); 
            }else{
                $error = "Cet email est déjà utilisé par un utilisateur";
                return back()->withInput()->with('mail_error',$error); 
            }
        }

        $user = User::where('id',Auth()->user()->id)->first();
        $user->email = $email;

        $user->save();

        flash("Email de connexion modifié avec succès")->success();

        return redirect()->route("admin.profile.home");
    }

    public function updatePassword(Request $request){
        $input = $request->all();
        $val = Validator::make($input,[
            "password"=>$this->passwordRules()
        ]);
        if($val->fails()){
            return back()->withErrors($val); 
        }
        $user = User::where('id',Auth()->user()->id)->first();
        ///

        if( Hash::check($input['old_password'], $user->password) == false ){
            return back()->withErrors($val)->with("password_error","Ancien mot de passe incorrect"); 
        }
        ///

        $p = Hash::make($input['password']);

       
        $user->password = $p;

        $user->save();

        flash("Mot de passe modifié avec succès")->success();

        return redirect()->route("admin.profile.home");
    }
}

<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        if($input['typeCompte']=="individuel"){

            Validator::make($input, [
                'pseudo' => [
                                'required', 
                                'string', 
                                'max:255',
                                'regex:/^[A-Za-z0-9_]+$/',
                                Rule::unique(User::class),
                            ],
                'dateAnnif' => ['required'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),
            ])->validate();

            //Creer maintenant le user
            return  User::create([
                'pseudo' => $input['pseudo'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'role'=>2,  //Car user
                'type_compte'=>2,  //car compte individ
                'dateAnnif' => $input['dateAnnif'],
                'adresse'=>null,
                'photo'=>null,
                'solde'=>0,
                'is_active'=>true,
                'admin_can_active_account'=>true,
                'desactivated_by'=>null,
                'desactivated_at'=>null,
            ]);


        }elseif($input['typeCompte']=="pro"){

            Validator::make($input, [
                'nomSociete'=> ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'service'=>['required', 'string', 'max:255'],
                'password' => $this->passwordRules(),
            ])->validate();

            return  User::create([
                'pseudo' => $input['nomSociete'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'role'=>2,  //Car user
                'type_compte'=>3,  //car compte prof
                'dateAnnif' => null,
                'adresse'=>null,
                'photo'=>null,
                'telephoneSociete'=>null,
                'serviceSociete'=>$input['service'],
                'solde'=>0,
                'adresseSociete'=>null,
                'nameSociete' => $input['nomSociete'],
                'is_active'=>true,
                'admin_can_active_account'=>true,
                'desactivated_by'=>null,
                'desactivated_at'=>null,
            ]);


        }


    }
}

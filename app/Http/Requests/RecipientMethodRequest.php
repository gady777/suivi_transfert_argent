<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecipientMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "recipient"=>'exists:recipients,id',
            //les infos sur la méthode
            "method"=>['required', Rule::in(['bank',"interact","mobile",'cash'])],
        ];
    }
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        //bank
        $validator->sometimes("bank_name","required|string|max:200",function($input){
            return $input->method == 'bank';
        });
        $validator->sometimes("account_name","required|string|max:200",function($input){
            return $input->method == 'bank';
        });
        $validator->sometimes("account_number","required|string|max:200",function($input){
            return $input->method == 'bank';
        });
        $validator->sometimes("rib","required|string|max:10",function($input){
            return $input->method == 'bank';
        });
        // end bank

        //interact
        $validator->sometimes("interact","required|string|max:400",function($input){
            return $input->method == 'interact';
        });
        //end interact

        //mobile
        $validator->sometimes("phone_number","required|string|max:50",function($input){
            return $input->method == 'mobile';
        });
        $validator->sometimes("phone_name","required|string|max:100",function($input){
            return $input->method == 'mobile';
        });
        //end mobile

        //cash
        $validator->sometimes("cash_name_fname","required|string|max:100",function($input){
            return $input->method == 'cash';
        });
        $validator->sometimes("cash_cni","required|string|max:50",function($input){
            return $input->method == 'cash';
        });
        //
        return $validator;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnlineBankRequest extends FormRequest
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
            'account_name'=>'required|string|max:100',
            "number"=>'required|string|max:50',
            "bank_name"=>"required|string|max:100"
        ];
    }
}

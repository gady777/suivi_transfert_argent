<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecipientRequest extends FormRequest
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
            'name'=>'required|max:100',
            'fname'=>'required|max:100',
            'city'=>'required|max:100',
            'country'=>'required|exists:countries,id',
            "email"=>"required|unique:recipients,email,id=".Auth()->user()->id,
        ];
    }

    
}

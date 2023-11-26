<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryEditRequest extends FormRequest
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
            "name"=>"required|string|max:100|unique:countries,name,".$this->id,
            "code"=>'required|string|max:7|unique:countries,code,'.$this->id,
            "devise"=>'required|exists:devises,id'
        ];
    }
}

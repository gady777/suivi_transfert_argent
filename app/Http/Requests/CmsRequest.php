<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
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
            "title"=>'required|string|max:100',
            "description"=>"required|string|max:255",
            "content"=>"required|string",
            "image"=>"nullable|image|mimes:png,jpg,jpeg,gif|max:50000",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'description'=>'required|string|max:200',
            "title"=>'required|string|max:100',
            "keywords"=>"required|string|max:100",
            "content"=>"required|string",
            'image' => 'required|image|mimes:png,jpg,jpeg;gif|max:20000',
        ];
    }

    public function messages()
    {
        return [
            'description.*'=>'La description ne doit pas être vide, 200 caractères au plus',
            "title.*"=>'Le titre ne doit pas être vide, 100 caractères au plus',
            "keywords.*"=>"Mots clés: 100 caractères au plus",
            "title.*"=>'Le titre ne doit pas être vide',
            'image.required'=>"Vous devez choisir une image",
            'image.max'=> 'Veuillez choisir une image de 2Mo au plus',
            'image.mimes' => 'Les extensions acceptées sont:png,jpg,jpeg,gif',
        ];
    }
}

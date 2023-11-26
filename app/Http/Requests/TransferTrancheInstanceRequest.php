<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferTrancheInstanceRequest extends FormRequest
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
            "devise"=>"required|exists:devises,id",
            "method"=>"required|exists:transfer_methods,id",
            "amount"=>"required|min:1|numeric",
            "informations"=>"required",
            "pay_date"=>"required|date",
            "type"=>Rule::in(["envoi","reception"]),
            "recipient_id"=>"nullable|exists:recipients,id"
        ];
    }
}

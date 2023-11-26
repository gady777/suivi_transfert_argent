<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessingFeeRequest extends FormRequest
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
            'withdraw_fee'=>'required|integer|min:0',
            'minim_bank_account'=>'required|integer|min:0',
            'minim_tarnsfert_to_paypal'=>'required|integer|min:0',
            'minim_transfert_to_momo'=>'required|integer|min:0',
        ];
    }
}

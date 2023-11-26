<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TransferTrancheRequest extends FormRequest
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
            "email"=>"required|exists:users,email",
            "devise"=>"required|exists:devises,id",
            "amount"=>"required|numeric|min:10",
            "transfer"=>"exists:transfers,id",
        ];
    }
}

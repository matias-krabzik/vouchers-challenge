<?php

namespace App\Http\Requests\Voucher;

use Illuminate\Foundation\Http\FormRequest;

class VoucherFilterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "voucher_num" => [ "number" ],
            "account" => [ "number" ],
            "create_date_from" => [ "date:before,create_date_to" ],
            "create_date_to" => [ "date:after,create_date_from" ],
            "brand" => [ "string" ],
        ];
    }
}
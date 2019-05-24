<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'student_id'    => 'required|integer|exists:students,id',
            'payment_id'    => 'required|integer|exists:payment_ms,id',
            'voucher_id'    => 'required|integer|exists:vouchers,id',
            'currency_id'   => 'required|integer|exists:currencies,id',
            'description'   => 'max:150',
        ];
    }
}

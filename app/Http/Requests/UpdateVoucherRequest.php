<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
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
            'voucher_code' => 'required|unique:vouchers,voucher_code,'.$this->id,
            'start_date' => 'required',
            'end_date' => 'required',
            'capacity' => 'required|numeric|min:1',
            'discount_type' => 'required|in:%,-',
            'master_class' => 'required',
            'nominal' => 'required|numeric'
        ];
    }
}

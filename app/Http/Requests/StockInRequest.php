<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockInRequest extends FormRequest
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
    public function messages(){
        return [
            'total.required' => 'Total is required',
            'net_total.required' => 'Net Total is required',
            'vendor_id.required' => 'Vendor Information is required',
            'phone_number.required' => 'Vendor Phone Number is required',
            'vendor_name.required' => 'Vendor Name is required',
            'vendor_address.required' => 'Vendor Address is required',
            'voucher_number.required' => 'Voucher Number is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();

        return match ($method) {
            'PUT', 'POST' => [
                'total' => 'required',
                'net_total' => 'required',
                'phone_number' => 'required',
                'vendor_name' => 'required',
                'vendor_address' => 'required',
                'voucher_number' => 'required',
            ],
            default => [],
        };
    }
}

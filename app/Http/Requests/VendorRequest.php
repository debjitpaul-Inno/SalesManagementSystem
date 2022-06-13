<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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

    public function messages()
    {
        return [

            'vendor_name.required' => 'Vendor Name is required',
            'phone_number.required' => 'Vendor Phone Number is required',
            'vendor_address.required' => 'Vendor Address is required',
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
        return match ($method){
            'PUT', 'POST' => [
                'vendor_name' => 'required',
                'phone_number' => 'required',
                'vendor_address' => 'required',
            ],
            default => []
        };
    }
}

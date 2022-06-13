<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'membership_type_id.required' => 'Membership Type is required',
            'membership_date.required' => 'Membership Date is required',
            'customer_id.required' => 'Customer is required'
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        $method = $this->method();

        return match ($method) {
            'PUT', 'POST' => [
                'membership_type_id' => 'required',
                'membership_date' => 'required',
                'customer_id' => 'required',
            ],
            default => [],
        };
    }
}

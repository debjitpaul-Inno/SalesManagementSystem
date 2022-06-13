<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DamageRequest extends FormRequest
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
            'reference_number.required' => 'Reference Number is required',
            'net_total.required' => 'Total Amount is required',
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
                'reference_number' => 'required',
                'net_total' => 'required',
            ],
            default => [],
        };
    }
}

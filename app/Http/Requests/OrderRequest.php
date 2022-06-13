<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'unit_price.required' => 'Unit Price is required',
            'total.required' => 'Total is required',
            'net_total.required' => 'Net Total is required',
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
                'unit_price' => 'required',
                'total' => 'required',
                'net_total' => 'required',
            ],
            default => [],
        };
    }
}

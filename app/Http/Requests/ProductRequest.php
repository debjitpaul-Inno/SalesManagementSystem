<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title.required' => 'Title is required',
            'price.required' => 'Price is required',
            'unit.required' => 'Unit is required',
//            'status.required' => 'Status is required',
            'sub_category_id.required' => 'Sub Category is required',
            'rack_id.required' => 'Rack Number is required',
            'vendor_id.required' => 'Vendor is required',
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
                'title' => 'required',
                'price' => 'required',
                'unit' => 'required',
//                'status' => 'required',
                'sub_category_id' => 'required',
                'rack_id' => 'required',
                'vendor_id' => 'required',
            ],
            default => [],
        };
    }
}

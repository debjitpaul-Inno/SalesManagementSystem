<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipTypeRequest extends FormRequest
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
            'title.required' => 'Title is required',
            'discount.required' => 'Discount is required'
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
               'title' => 'required',
               'discount' => 'required',
           ],
           default => [],
       };
    }
}

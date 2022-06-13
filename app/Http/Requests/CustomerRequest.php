<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'nickname.required' => 'NickName is required',
            'phone_number.required' => 'Phone Number is required',
            'phone_number.max' => 'Phone Number must not be greater than 11 digit',
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
               'nickname' => 'required',
               'phone_number' => 'required|max:11',
           ],
            default => []
        };
    }
}

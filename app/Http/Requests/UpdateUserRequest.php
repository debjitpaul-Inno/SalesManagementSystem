<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'salary.required' => 'Salary is required',
            'joining_date.required' => 'Joining Date is required',
            'role_id.required' => 'Role is required',
            'email.required' => 'Email is required',
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
        switch($method){
            case 'POST':
                return [
                    'joining_date' => 'required',
                    'salary' => 'required',
                    'role_id' => 'required',
                    'email' => 'required',
                ];

            default:
                return[];

        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsTemplateRequest extends FormRequest
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
            'subject.required' => 'Subject is required',
            'body.required' => 'Sms Body is required',
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
                'subject' => 'required',
                'body' => 'required',
            ],
            default => [],
        };
    }
}

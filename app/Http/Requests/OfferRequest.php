<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'type.required' => 'Offer Type is required',
//            'offer_on.required' => 'Offer Policy is required',
            'start_date.required' => 'Start Date is required',
            'end_date.required' => 'End Date is required',
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
                'type' => 'required',
//                'offer_on' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ],
            default => [],
        };
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimatedPriceRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'time' => 'required'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'date.required' => 'A date is required',
            'time.required' => 'A time is required'
        ];
    }
}

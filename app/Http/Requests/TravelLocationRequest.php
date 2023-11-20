<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TravelLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'string|required',
            'type'=> 'required',
            'description'=> 'required',
            'ticket_price'=> 'nullable|numeric',
            'open_time'=> 'date_format:H:i|nullable',
            'close_time'=> 'date_format:H:i|nullable',
            'province' => 'string|required',
            'district' => 'string|required',
            'location_link' => 'nullable',
            'img' => 'required'
        ];
    }
}

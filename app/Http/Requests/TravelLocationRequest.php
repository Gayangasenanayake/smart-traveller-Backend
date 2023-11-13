<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'string|required',
            'type'=> 'required',
            'description'=> 'required',
            'ticket_price'=> 'nullable|numeric',
            'open_time'=> 'time|nullable',
            'close_time'=> 'time|nullable',
            'province' => 'string|required',
            'district' => 'string|required',
            'location_link' => 'string|nullable',
        ];
    }
}

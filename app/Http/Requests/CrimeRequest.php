<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrimeRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id' => 'required',
            'description' => 'required',
            'crime_location' => 'required',
            'device_type' => 'nullable',
            'mac_address' => 'nullable',
            'status' => 'nullable'
        ];
        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrimeCategoryRequest extends FormRequest
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
            'category_code' => 'required|unique:crime_categories,category_code',
            'category_name' => 'required|unique:crime_categories,category_name',
            'description' => 'nullable'
        ];

        return $rules;
    }
}

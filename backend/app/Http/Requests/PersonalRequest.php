<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
        return [

            'name' => 'required|max:8',
            'age' => 'required|integer|max:130|min:0',
            'height' => 'required|numeric|max:300|min:1',
            'kcalParday' => 'required|numeric|min:1|max:9999',

        ];
    }
}

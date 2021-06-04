<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProtainRequest extends FormRequest
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

            'name' => 'required|max:20',
            'kcal' => 'required|numeric|max:999|min:1',
            'protain' => 'required|numeric|max:999|min:1',
            'carbo' => 'required|numeric|max:999|min:1',
            'fat' => 'required|numeric|max:999|min:1',

        ];
    }
}

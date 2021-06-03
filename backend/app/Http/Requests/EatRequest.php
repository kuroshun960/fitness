<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EatRequest extends FormRequest
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
            'net' => 'required|numeric|max:1000|min:0.1',
        ];
    }
}

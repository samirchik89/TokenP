<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestStore extends FormRequest
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
            'nooftoken' => 'required',
            'payby' => 'required',            
        ];
    }

    public function messages(){
        return [
            'nooftoken.required' => 'The no of token is required',
            'payby.required' => 'the Pay Value is required'
        ];
    }
}

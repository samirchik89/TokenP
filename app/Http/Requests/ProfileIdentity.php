<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileIdentity extends FormRequest
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
        $user = Auth::user();
        return [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'dob' => 'nullable|max:20',
            'citizenship' => 'nullable|max:100',
            'residence' => 'nullable|max:100',
            'ssn_tax_id' => 'nullable|max:50',
            'document' => 'mimes:jpeg,jpg,bmp,png,pdf|max:5120',
            'photo' => 'mimes:jpeg,jpg,bmp,png,pdf|max:5120',
            'primary_phone' => 'nullable|max:16',
            'secondary_phone' => 'nullable|max:16',
            'address_line_1' => 'nullable|max:200',
            'address_line_2' => 'nullable|max:200',
            'country_code' => 'nullable|max:30|exists:countries,code',
            'city_id' => 'nullable|max:30|exists:cities,id',
            'province' => 'nullable|max:100',
            'postal_code' => 'nullable|max:50',
            'email'       => 'required|email|unique:users,email,'.$user->id,
        ];
    }
}

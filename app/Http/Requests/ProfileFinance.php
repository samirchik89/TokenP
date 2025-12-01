<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileFinance extends FormRequest
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
            'type_of_ownership' => 'required|max:50',
            'us_resident' => 'in:YES,NO',
            'us_citizen' => 'in:YES,NO',
            'ssn_tax_id' => 'in:SSN,TAX ID',
            'custodial_account' => 'in:YES,NO', 
            'e_signature' => 'mimes:jpeg,jpg,bmp,png,pdf|max:2048',
            'preferred_distribution' => 'required|max:20', 
            'routing_aba_number' => 'required|max:50',
            'swift_code' => 'required|max:50',
            'financial_insitution' => 'required|max:100',
            'financial_insitution_address' => 'required|max:200',
            'beneficiary_name' => 'required|max:100',
            'beneficiary_acc_number' => 'required|max:100',
            'beneficiary_acc_address' => 'required|max:200',
            'funding_note' => 'required|max:200',
            'further_credit' => 'required|max:100',
            'attn' => 'required|max:100',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AssetFundRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyName'                  =>  'required|max:200',
            'totalDealSize'                 => 'required|gt:initialInvestment',
            'expectedIrr'                   =>  'required|numeric|min:0|max:100|gte:0',
            'initialInvestment'             => 'required|numeric|max:999999999|gte:0',
            'fundedMembers'                 =>  'required|numeric|min:0|max:999999999',
            'holdingPeriod'                 =>  'required',
            'propertyOverview'              => 'required',
            'propertyHighlights'            =>  'required',
            'token_name'                    =>  'required|max:100',
            'token_symbol'                  =>  'required|max:4',
            'token_value'                   => 'required|numeric|lte:totalDealSize',
            'token_supply'                  =>  'required|numeric|min:0|gte:0', //varchar
            'token_decimal'                 =>  'required|numeric|digits_between:1,2',
            'ManagementTeamDescription'     =>  'required',
            'propertyLogo'                  =>  'required|mimes:jpeg,jpg,bmp,png|max:70000',
            'investor'                      =>  'required|mimes:pdf|max:70000',
            'titlereport'                   =>  'required|mimes:pdf|max:70000',
            'termsheet'                     =>  'mimes:pdf|max:70000',
            'propertyUpdatesDoc'            =>  'mimes:pdf|max:70000',
            'brochure'                      =>  'required|mimes:pdf|max:70000',
            'token_image'                   =>  'required|mimes:jpeg,jpg,bmp,png|max:70000',
        ];
    }
}

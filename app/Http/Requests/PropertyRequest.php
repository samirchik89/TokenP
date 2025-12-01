<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class PropertyRequest extends FormRequest
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
            'propertyName'                  => 'required|max:200',
            'propertyLocation'              => 'required|max:200',
            'propertyType'                  => 'required',
            'totalDealSize'                 => 'required|gt:initialInvestment',
            'expectedIrr'                   => 'required|numeric|max:100',
            'initialInvestment'             => 'required|numeric|max:999999999|gte:0',  
            'holdingPeriod'                 => 'required',
            'propertyOverview'              => 'required', //Long text
            'locality'                      => 'required|max:200',
            'yearOfConstruction'            => 'numeric|digits:4',
            'propertyTotalBuildingArea'     => 'numeric|max:999999999',
            'propertyDetailsHighlights'     =>  'max:200',
            'airport'                       =>  'max:200',
            'hospitals'                     =>  'max:200',
            'fire_services'                 =>  'max:200',
            'industrial'                    =>  'max:200',
            'token_name'                    =>  'required|max:100',
            'token_symbol'                  =>  'required|max:4',
            'token_value'            => 'required|numeric|lte:totalDealSize',
            'token_supply'                  =>  'required|numeric|min:0|gte:0', //varchar
            'token_decimal'                 =>  'required|numeric|digits_between:1,2',
            'propertylogoimage'             =>  'mimes:jpeg,png|max:5120',
            'map'                           =>  'mimes:pdf|max:5120',
            // 'comparabledetails'             =>  'required|mimes:pdf|max:5120',
            'investor'                      =>  'required|mimes:pdf|max:5120',
             'titlereport'                   =>  'mimes:pdf|max:5120',
             'termsheet'                     =>  'mimes:pdf|max:5120',
             'propertyUpdatesDoc'            =>  'mimes:pdf|max:5120',
            'brochure'                      =>  'required|mimes:pdf|max:5120',
            'floorplan'                     =>  'mimes:pdf|max:5120',
            'token_image'                   =>  'required|mimes:jpeg,png|max:5120',
        ];
    }

    public function messages(){
        return [
            'investor.max' => 'Prospectus file should not be greater than 5120 kilobytes',
            'titlereport.max' => 'Reports file should not be greater than 5120 kilobytes',
            'termsheet.max' => 'Agreements file should not be greater than 5120 kilobytes',
            'propertyUpdatesDoc.max' => 'Additional Information file should not be greater than 5120 kilobytes',
        ];
    }
}

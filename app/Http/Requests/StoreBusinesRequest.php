<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinesRequest extends FormRequest
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
            'name'=> 'required|min:3|max:255',
            'type_investment_id'=>'required',
            'district_id'=>'required',
            'ward_id'=>'required',
             'code'         => 'required|numeric|digits_between:6,9|unique:business,code',
            'day_register'=>'required',
             'number_people'         => 'required|numeric|min:1|max:1000000',
            'number_certificate'         => 'required|numeric|digits_between:6,9|unique:business,number_certificate',
            'day_number_certificate'=>'required',
            'name_user'=>'required',
            'house_hold'         => 'required|numeric|digits_between:9,12',
            'position_business'=>'required',
            'address'=>'required',
        ];
    }

    
}

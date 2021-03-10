<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateViolateRequest extends FormRequest
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
            'busines_name'=> 'required',
            'day_check'=>'required|date_format:"d/m/Y"', 
            'error_violate'=>'required', 
            'note_error'=>'required',
            'processing_level_id'=>'required',
            'user_decision_id'=>'required',
            'user_handler_id'=>'required',
            'form_violate'=>'required',
            'status'=>'required',
            'note_form_violate'=>'required',
        ];
    }

    
}

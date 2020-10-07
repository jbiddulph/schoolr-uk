<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenuePostRequest extends FormRequest
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
            'school'=>'required',
            'byb_type'=>'required',
            'address_1'=>'required',
            'address_2'=>'required',
            'town'=>'required',
            'county'=>'required',
            'postcode'=>'required',
            'telephone'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'website'=>'required'
        ];
    }
}

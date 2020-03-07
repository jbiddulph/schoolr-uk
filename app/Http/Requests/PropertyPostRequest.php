<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyPostRequest extends FormRequest
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
            'propname'=>'required',
            'propcost'=>'required',
            'proptype'=>'required',
            'propimage'=>'required',
            'address'=>'required',
            'town'=>'required',
//            'county'=>'required',
            'postcode'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
//            'description'=>'required',
            'floorplan'=>'required',
            'brochure'=>'required',
            'last_date'=>'required',
            'category_id'=>'required'
        ];
    }
}

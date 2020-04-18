<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventPostRequest extends FormRequest
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
            'eventName'=>'required',
            'venue_id'=>'required',
            'eventPhoto'=>'required',
            'eventDate'=>'required',
            'eventTimeStart'=>'required',
            'eventTimeEnd'=>'required',
            'eventType'=>'required',
            'eventCost'=>'required'
        ];
    }
}

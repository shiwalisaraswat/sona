<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;


class RoomRequest extends FormRequest
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
		if($this->id){
			$room = [
                'room_type_id' => 'required|integer', 
                'room_number'  => 'required|string|max:10|unique:room_types,name,'.$this->id.',id', 
                'price'        => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 
                'status'       => 'nullable|string'
			];
		} else {
			$room = [
				'room_type_id' => 'required|integer', 
                'room_number'  => 'required|string|max:10|unique:room_types,name,'.$this->id.',id', 
                'price'        => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 
                'status'       => 'nullable|string'
			];
		}
        return $room;
    }

    public function messages()
    {
        return [
            'room_type_id.required' => 'RoomType is required!',
            'room_number.required' => 'Room Number is required!',
        ];
    }
}

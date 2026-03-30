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
        return [
            // ROOM
            'room_type_id' => 'required|exists:room_types,id',
            'room_number'  => 'required|max:10|unique:rooms,room_number,' . $this->id,
            'price'        => 'required|decimal:0,2',
            'status'       => 'required|string',

            // FEATURES
            'size'        => 'required|integer|min:1',
            'capacity'    => 'required|integer|min:1',
            'bed'         => 'required|string|max:50',
            'description' => 'nullable|string',

            // SERVICES
            'services'    => 'nullable|array',
            'services.*'  => 'exists:services,id',

            // IMAGES
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpg,jpeg,png|max:2048'
        ];

		// if($this->id){
		// 	$room = [
        //         'room_type_id' => 'required|integer', 
        //         'room_number'  => 'required|string|max:10|unique:room_types,name,'.$this->id.',id', 
        //         'price'        => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 
        //         'status'       => 'nullable|string'
		// 	];
		// } else {
		// 	$room = [
		// 		'room_type_id' => 'required|integer', 
        //         'room_number'  => 'required|string|max:10|unique:room_types,name,'.$this->id.',id', 
        //         'price'        => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 
        //         'status'       => 'nullable|string'
		// 	];
		// }
        // return $room;
    }

    public function messages()
    {
        return [
            'room_type_id.required' => 'RoomType is required!',
            'room_number.required' => 'Room Number is required!',
        ];
    }
}

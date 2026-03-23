<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;


class RoomTypeRequest extends FormRequest
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
			$roomType = [
				'name'        => 'required|max:180|unique:room_types,name,'.$this->id.',id',
				'description' => 'nullable|string',
                'status'      => 'nullable|string'
			];
		} else {
			$roomType = [
				'name'        => 'required|max:180|unique:room_types,name,'.$this->id.',id',
				'description' => 'nullable|string',
                'status'      => 'nullable|string'
			];
		}
        return $roomType;
    }

    public function messages()
    {
        return [
            'name.required' => 'RoomType name is required!',
        ];
    }
}

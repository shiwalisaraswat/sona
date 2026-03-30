<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;

class ServiceRequest extends FormRequest
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
			$service = [
                'name'   => 'required|string|max:10|unique:services,name,'.$this->id.',id',  
                'status' => 'nullable|string'
			];
		} else {
			$service = [
				'name'   => 'required|string|max:10|unique:services,name,'.$this->id.',id',  
                'status' => 'nullable|string'
			];
		}
        return $service;
    }

    public function messages()
    {
        return [
            'name.required' => 'Service Name is required!',
        ];
    }
}

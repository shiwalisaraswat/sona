<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'role' => 'nullable|in:super_admin,sub_admin,staff',
            'name' => 'required|max:150',
            'email' => 'required|max:255|email|unique:admins,email,'.$this->id,
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        if($this->id){
            $rules['password'] = 'nullable|confirmed|min:6';
        }else{
            $rules['password'] = 'required|confirmed|min:6';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',

            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email',
            'email.unique' => 'Email already exists',

            'role.required' => 'Role is required',
            'role.in' => 'Invalid role selected',

            'password.required' => 'Password is required',
            'password.confirmed' => 'Passwords do not match',
        ];
    }
}
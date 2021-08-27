<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'fname' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:50',
            'lname' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:50',
            'gender' => 'required',
            'dob' => 'required|before:18 years ago',
            'email' => 'required|max:50|unique:user,email,NULL,id',
            'mobile' => 'required|digits:10|unique:user,mobile,NULL,ids',
            'dob' => 'required|before:18 years ago',
            'password' => 'required',
            'confirm_password' =>'required_with:password|same:password|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required'
        ];
    }
}

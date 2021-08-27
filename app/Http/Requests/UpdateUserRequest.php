<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required',
            'mobile' => 'required',
            'dob' => 'required|before:18 years ago',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required'
        ];
    }
}

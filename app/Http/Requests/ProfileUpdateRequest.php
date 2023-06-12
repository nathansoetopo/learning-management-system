<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required',
            'address'   => 'required',
            'email'     => 'required|unique:users,email,'.Auth::user()->id,
            'username'  => 'required|unique:users,username,'.Auth::user()->id,
            'phone'     => 'required',
            'gender'    => 'required|in:male,female',
            'file'      => 'sometimes|mimes:png,jpg,jpeg|max:2000'
        ];
    }
}

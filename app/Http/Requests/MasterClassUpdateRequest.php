<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterClassUpdateRequest extends FormRequest
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
            'name' => 'required|max:100|unique:master_class,name,'.$this->id,
            'image' => 'mimes:PNG,jpg,jpeg,bmp,gif,svg|max:2000|sometimes',
            'event_id' => 'required|uuid'
        ];
    }
}

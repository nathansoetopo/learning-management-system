<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterClassStoreRequest extends FormRequest
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
            'name' => 'required|max:100|unique:master_class,name',
            'image' => 'mimes:png,jpg,jpeg,bmp,gif,svg|max:2000|required',
            'event_id' => 'required|uuid',
            'price' => 'sometimes|min:0',
            'duration' => 'required|numeric',
            'description' => 'required'
        ];
    }
}

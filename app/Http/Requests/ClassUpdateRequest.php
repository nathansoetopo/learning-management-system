<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassUpdateRequest extends FormRequest
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
            'name' => 'required|unique:class,name,'.$this->id,
            'master_class_id' => 'required|uuid',
            'responsible_id' => 'required|uuid',
            'description' => 'required|min:20',
            'capacity' => 'required|numeric',
            'link' => 'sometimes',
            'start_time' => 'required',
            'end_time' => 'required'
        ];
    }
}

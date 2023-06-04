<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateUpdateRequest extends FormRequest
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
            'certificate_number' => 'required|unique:certificate,certificate_number,'.$this->id,
            'realese_date' => 'required|date',
            'master_class_id' => 'required|uuid',
            'class_id.*' => 'required|uuid'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\DurationRule;
use Illuminate\Foundation\Http\FormRequest;

class PresenceUpdateRequest extends FormRequest
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
            'name' => 'required',
            'duration' => [new DurationRule($this->class_id, 'update', $this->old_duration), 'required', 'numeric'],
            'open_clock' => 'required|date',
            'closed_clock' => 'required|date|after_or_equal:open_clock'
        ];
    }
}

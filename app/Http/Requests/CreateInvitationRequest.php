<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateInvitationRequest extends FormRequest
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
            'surname' => 'required|string',
            'display_name' => 'required|string',
            'type' => [
                'required',
                Rule::in(['family', 'single']),
            ],
            'plus_one' => [
                'required',
                Rule::in(['yes', 'no']),
            ],
            'guests' => 'required|numeric',
            'notes' => 'nullable|string|max:2000',
        ];
    }
}
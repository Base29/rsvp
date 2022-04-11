<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvitationRequest extends FormRequest
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
            'invitation' => 'required|numeric|exists:invitations,id',
            'confirmation' => ['nullable', Rule::in(['yes', 'no'])],
            'guests' => 'nullable|numeric',
            'plus_one' => ['nullable', Rule::in(['yes', 'no'])],
        ];
    }
}
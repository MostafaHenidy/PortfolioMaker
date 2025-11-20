<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'about'    => 'required|boolean',
            'skills'   => 'required|boolean',
            'projects' => 'required|boolean',
            'contact'  => 'required|boolean',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'about.required' => 'The "About" section visibility status is mandatory and must be set.',
            'about.boolean' => 'The "About" section status must be designated as a boolean value (True or False).',

            'skills.required' => 'The "Skills" section visibility status is mandatory and must be set.',
            'skills.boolean' => 'The "Skills" section status must be designated as a boolean value (True or False).',

            'projects.required' => 'The "Projects" section visibility status is mandatory and must be set.',
            'projects.boolean' => 'The "Projects" section status must be designated as a boolean value (True or False).',

            'contact.required' => 'The "Contact" section visibility status is mandatory and must be set.',
            'contact.boolean' => 'The "Contact" section status must be designated as a boolean value (True or False).',
        ];
    }
}

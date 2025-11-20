<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string',
            'level' => 'required|numeric|max:100',
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
            'name.required' => 'The Name field is mandatory and must contain a non-empty value.',
            'name.string' => 'The Name field must be submitted as a valid text string.',

            'level.required' => 'The Level field is mandatory and must be provided.',
            'level.numeric' => 'The Level value must be a valid numeric entry.',
            'level.max' => 'The Level value cannot exceed the defined maximum threshold of 100.',

            'user_id.required' => 'The User Identifier is mandatory and must be associated with a user.',
            'user_id.integer' => 'The User Identifier must be a valid integer value.',
            'user_id.exists' => 'The provided User Identifier does not correspond to an existing record in the users database table.',
        ];
    }
}

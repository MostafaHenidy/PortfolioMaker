<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'project-skill' => 'nullable|array',
            'project-skill.*' => 'exists:skills,id',
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
            'title.required' => 'The Project Title is a mandatory field and must be provided.',
            'title.string' => 'The Project Title must be submitted as a valid text string.',
            'title.max' => 'The Project Title exceeds the maximum allowed length of 100 characters.',

            'description.required' => 'The Project Description is mandatory and cannot be left empty.',
            'description.string' => 'The Project Description must be submitted as a valid text string.',
            'description.max' => 'The Project Description exceeds the maximum allowed length of 255 characters.',

            'project-skill.array' => 'The Project Skills field must be formatted as a valid list or array of identifiers.',
            'project-skill.*.exists' => 'One or more of the selected Skill identifiers are invalid or not found in the system records.',

            'user_id.required' => 'The User Identifier is mandatory and must be associated with a user.',
            'user_id.integer' => 'The User Identifier must be a valid integer value.',
            'user_id.exists' => 'The provided User Identifier does not correspond to an existing record in the users database table.',
        ];
    }
}

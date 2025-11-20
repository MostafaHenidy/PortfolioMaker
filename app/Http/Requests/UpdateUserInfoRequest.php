<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoRequest extends FormRequest
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
            'name' => 'required|string|max:255|regex:/^[\pL\s\-\.]{2,255}$/u',
            'professional_headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'experience' => 'nullable|numeric|min:1|max:50',
            'projects_made' => 'nullable|integer|min:0|max:1000',
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
            'name.required' => 'The Name field is mandatory and must be provided.',
            'name.regex' => 'The Full Name field must consist of letters, spaces, hyphens, or periods and cannot be purely numeric or contain special symbols.',

            'professional_headline.string' => 'The Professional Headline must be a valid text string.',

            'bio.max' => 'The biography exceeds the maximum allowed character limit.',

            'experience.max' => 'The experience value submitted exceeds the defined maximum threshold.',
            'experience.integer' => 'The Experience value must be a whole number (integer) representing years.',

            'projects_made.integer' => 'The Projects Made count must be a valid integer.',
            'projects_made.min' => 'The Projects Made count cannot be a negative value.',
            'projects_made.max' => 'The Projects Made count exceeds the reasonable maximum limit.',
        ];
    }
}

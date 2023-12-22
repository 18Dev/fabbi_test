<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @stepOneRequest
 */
class StepOneRequest extends FormRequest
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
            'meal' => "bail|required|in:BREAKFAST,LUNCH,DINNER",
            'number_people' => "bail|required|numeric|min:1|max:10",
        ];
    }

    /**
     * @return void
     */
    public function messages()
    {
        return [
            'number_people.required' => __('validation.required', ['attribute' => 'number people']),
            'number_people.numeric' => __('validation.size.numeric', ['attribute' => 'number people']),
        ];
    }
}

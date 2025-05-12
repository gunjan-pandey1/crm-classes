<?php

namespace App\Http\Requests\Crm;

use Illuminate\Foundation\Http\FormRequest;

class LeadsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'query' => 'string|max:255',
            'fromdate' => 'required|date',
            'todate' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'query.string' => 'The query must be a string.',
            'query.max' => 'The query cannot be longer than 255 characters.',
            'fromdate.required' => 'The from date is required.',
            'fromdate.date' => 'The from date must be a valid date.',
            'todate.required' => 'The to date is required.',
            'todate.date' => 'The to date must be a valid date.'
        ];
    }
}
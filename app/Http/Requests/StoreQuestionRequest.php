<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
        'lesson_id' => ['required', 'exists:lessons,id'],
        'text' => ['required', 'string'],
        'type' => ['required', 'in:0,1'],
        'difficulty' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }
}

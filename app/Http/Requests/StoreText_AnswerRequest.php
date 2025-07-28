<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreText_AnswerRequest extends FormRequest
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
            'expected_answer' => 'required|string',
            'question_id' => 'required|exists:questions,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimbreIesrRequest extends FormRequest
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
            'intitule' => 'required|string',
            'type' => 'required|string',
            'ministere' => 'required|string',
            'denomMinistere' => 'required|string',
            'description' => 'required|string',
            'iesr_id' => 'required'
        ];
    }
}

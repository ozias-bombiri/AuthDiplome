<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSignataireActeRequest extends FormRequest
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
            'statut' => 'required|string',
		    'debut' => 'required|string',
            'fin' => 'required|string',
            'categorieActe_id' => 'required|string',
            'institution_id' => 'required|string',
            'signataire_id' => 'required|string',
        ];
    }
}


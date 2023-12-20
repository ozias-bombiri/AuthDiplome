<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFiliereRequest extends FormRequest
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
            'reference' => 'required|string',
            'numero' => 'required',
            'lieu' => 'required|string',
            'dateSignature' => 'required',
            'statutSignature' => 'required',
            'validite' => 'required',
            'resultatAcademique_id' => 'required',
            'signataireActe_id' => 'required',
            'categorieActe_id' => 'required',
            'resultatAcademique_id' => 'required',
        ];
    }
}

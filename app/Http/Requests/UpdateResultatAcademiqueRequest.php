<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResultatAcademiqueRequest extends FormRequest
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
            'dateSignature' => 'required|string',
            'moyenne' => 'required|string',
            'cote' => 'required|string',
            'session' => 'required|string',
            'dateSoutenance' => 'required',
            'etudiant_id' => 'required|string',
            'parcours_id' => 'required|string',
            'anneeAcademique_id' => 'required|string',
        ];
    }
}

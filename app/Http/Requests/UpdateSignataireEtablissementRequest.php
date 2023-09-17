<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSignataireEtablissementRequest extends FormRequest
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
            'nom' => 'required|string',
            'prenom'  => 'required|string',
            'nip'  => 'required|string',
            'sexe'  => 'required|string',
            'typeDocument'  => 'required|string',
            'fonction'  => 'required|string',
            'fonctionLongue'  => 'required|string',
            'grade' => 'required|string',
            'titreAcademique'  => 'required|string',
            'titreHonorifique'  => 'required|string',
            'etablissement_id'  => 'required'
        ];
    }
}

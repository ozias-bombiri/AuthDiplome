<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSignataireRequest extends FormRequest
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
            'grade' => 'string',
            'titreAcademique'  => 'string',
            'titreHonorifique'  => 'string',
            'institution_id'  => 'required'
        ];
    }
}

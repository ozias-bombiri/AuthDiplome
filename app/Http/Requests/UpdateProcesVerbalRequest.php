<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcesVerbalRequest extends FormRequest
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
            'nomFichierPdf' => 'required|string',
            'session' => 'required|string',
            'dateDeliberation' => 'required|string',
            'nombreEtudiants' => 'required|string',
            'description' => 'required|string',
            'parcours_id' => 'required|string',
            'anneeAcademique_id' => 'required|string',
            'user_id' => 'required|string',
        ];
    }
}

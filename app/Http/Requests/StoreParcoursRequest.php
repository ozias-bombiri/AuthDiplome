<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParcoursRequest extends FormRequest
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
            'code'=> 'required|string',
            'intitule' => 'required|string',
            'domaine'  => 'required|string',
            'mention'  => 'required|string',
            'specialite'  => 'required|string',
            'description'  => 'nullable',
            'filiere_id'  => 'required',
            'niveauEtude_id'  => 'required'
        ];
    }
}

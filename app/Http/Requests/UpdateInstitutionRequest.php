<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstitutionRequest extends FormRequest
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
            'sigle' =>'required|string',
            'denomination' =>   'required|string',
            'telephone'    =>   'required|string',
            'adresse'      =>   'required|string',
            'email'        =>   'required|string',
            'type'         =>   'required|string',
            'siteWeb'      =>   'string|max:30|min:5',
            'logo'         =>   'required|max:2048',
            'description'  =>   'nullable',
            'parent_id'    =>   'nullable'
        ];
    }
}

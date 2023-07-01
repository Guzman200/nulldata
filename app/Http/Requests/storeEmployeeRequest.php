<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required',
            'email'       => 'required|email|unique:users,email',
            'job'         => 'required',
            'birthdate'   => 'required|date_format:Y-m-d',
            'residence'   => 'required',
            'skills'      => 'array|required',
            'skills.*.id' => 'present|exists:skills,id'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'Nombre',
            'job'  => 'Puesto',
            'birthdate' => 'Fecha de nacimiento',
            'residence' => 'Domicilio',
            'skills' => 'Skills'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiendaRequest extends FormRequest
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
            'imagen' => 'nullable',
            'nombre' => 'required|max:40',
            'nombre_legal' => 'required|max:191',
            'cif' => 'required|max:191',
            'telefono' => 'required|max:20',
            'email' => 'required|email:rfc,dns|max:60',
            'url' => 'required|max:191',
            'descripcion' => 'required|max:191',
            'direccion' => 'required|max:191',
            'codigo_postal' => 'required|max:20',
            'ciudad' => 'required|max:191',
            'provincia' => 'required|max:191',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InmuebleRequest extends FormRequest
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
            'numero_catastral' => 'required',
            'contribuyente_id' => 'required',
            'direccion_inmueble'=> 'required',
            'medida_inmueble' => 'required',
            'numero_escritura' => 'required',
            'metros_acera' => 'required|numeric',
        ];
    }
}

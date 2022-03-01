<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoRequest extends FormRequest
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
            'empleado_id'=>'required',
            'banco_id'=>'required',
            'numero_de_cuenta'=>'required',
            'monto'=>'required|numeric|min:0.01',
            'numero_de_cuotas'=>'required|numeric|min:1',
            'cuota'=>'required|numeric|min:0.01',
            'tasa_interes'=>'required|numeric|min:0.01',

        ];
    }
    public function messages()
     {
         return [
         'empleado_id.required'=>'El campo empleado es obligatorio',
         'banco_id.required'=>'El campo banco es obligatorio',
         'numero_de_cuenta.required'=>'El campo número de cuenta es obligatorio',
         'monto.required'=>'El campo monto es obligatorio',
         'numero_de_cuotas.required'=>'El campo número de cuotas es obligatorio',
         'cuota.required'=>'El campo cuota es obligatorio',
         'tasa_interes.required'=>'El campo tasa de interés es obligatorio',
         ];
     }
}

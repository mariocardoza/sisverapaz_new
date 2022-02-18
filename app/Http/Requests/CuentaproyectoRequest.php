<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaproyectoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'proyecto_id'=>'required',
            'cargo_id'=>'required',
            'salario'=>'required',
            'funciones' => 'required|min:3|max:500',
            'inicio_contrato'=>'required|date',
            'fin_contrato'=>'unique|date',
            'hora_entrada' => 'required|time',
            'hora_salida' => 'unique|time',
        ];
    }
}

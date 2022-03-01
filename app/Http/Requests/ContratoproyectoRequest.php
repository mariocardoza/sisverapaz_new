<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoproyectoRequest extends FormRequest
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
             'proyecto' => 'required',
             'motivo_contratacion' => 'required',
             'inicio_contrato' => 'required',
             'fin_contrato' => 'required',
             'hora_entrada' => 'required',
             'hora_salida' => 'required',
         ];
     }
}

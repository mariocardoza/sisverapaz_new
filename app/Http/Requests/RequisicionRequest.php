<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisicionRequest extends FormRequest
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
            'actividad' => 'required',
            'user_id' => 'required',
            'unidad_id' => 'required',
            'fecha_solicitud'=>'required',
            'justificacion'=>'required',
        ];
    }

    public function messages()
    {
      return [
      'actividad.required'=>'El campo actividad es obligatorio',
      'justificacion.required' => 'La justificación es obligatoria',
      'unidad_id.required' => 'La unidad solicitante es obligatoria',
      'fecha_solicitud.required'=>'La fecha de la solicitud es obligatoria',
      ];
    }
}

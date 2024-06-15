<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportesEstanteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'codigo_proyecto' => 'required|string',
			'codigo_partida' => 'required|string',
			'fecha' => 'required',
			'hora' => 'required',
			'accion' => 'required',
			'estatus' => 'required',
			'id_estante' => 'required',
        ];
    }
}

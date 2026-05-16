<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlumnoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can(
            'alumnos.crear'
        );
    }

    public function rules(): array
    {
        return [

            'matricula' => [
                'required',
                'string',
                'max:30',
                'unique:alumnos,matricula',
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'apellido_paterno' => [
                'required',
                'string',
                'max:255',
            ],

            'apellido_materno' => [
                'nullable',
                'string',
                'max:255',
            ],

            'curp' => [
                'required',
                'string',
                'size:18',
                'unique:alumnos,curp',
            ],

            'fecha_nacimiento' => [
                'required',
                'date',
            ],

            'sexo' => [
                'required',
                'in:Hombre,Mujer',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'direccion' => [
                'nullable',
                'string',
            ],

            'ciclo_escolar_id' => [
                'required',
                'exists:ciclo_escolars,id',
            ],

            'grado_id' => [
                'required',
                'exists:grados,id',
            ],

            'grupo_id' => [
                'required',
                'exists:grupos,id',
            ],

            'tutor_id' => [
                'nullable',
                'exists:users,id',
            ],

            'activo' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [

            'matricula' => 'matrícula',

            'apellido_paterno' => 'apellido paterno',

            'apellido_materno' => 'apellido materno',

            'fecha_nacimiento' => 'fecha de nacimiento',

            'ciclo_escolar_id' => 'ciclo escolar',

            'grado_id' => 'grado',

            'grupo_id' => 'grupo',

            'tutor_id' => 'tutor',
        ];
    }

    public function messages(): array
    {
        return [

            'curp.size' => 'La CURP debe tener 18 caracteres.',

            'sexo.in' => 'El sexo seleccionado no es válido.',
        ];
    }
}

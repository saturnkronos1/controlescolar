<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('roles.editar');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',

                Rule::unique('roles', 'name')
                    ->ignore($this->role),
            ],

            'permissions' => [
                'nullable',
                'array',
            ],

            'permissions.*' => [
                'exists:permissions,name',
            ],
        ];
    }
}

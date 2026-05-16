<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('roles.crear');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'unique:roles,name',
                'max:255',
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

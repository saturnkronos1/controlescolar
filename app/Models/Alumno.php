<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $fillable = [

        'matricula',

        'nombre',

        'apellido_paterno',

        'apellido_materno',

        'curp',

        'fecha_nacimiento',

        'sexo',

        'telefono',

        'email',

        'direccion',

        'ciclo_escolar_id',

        'grado_id',

        'grupo_id',

        'tutor_id',

        'activo',
    ];

    protected function casts(): array
    {
        return [

            'fecha_nacimiento' => 'date',

            'activo' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function cicloEscolar(): BelongsTo
    {
        return $this->belongsTo(
            CicloEscolar::class
        );
    }

    public function grado(): BelongsTo
    {
        return $this->belongsTo(
            Grado::class
        );
    }

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(
            Grupo::class
        );
    }

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'tutor_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getNombreCompletoAttribute(): string
    {
        return trim(

            "{$this->nombre}
            {$this->apellido_paterno}
            {$this->apellido_materno}"

        );
    }
}

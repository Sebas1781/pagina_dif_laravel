<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadMedica extends Model
{
    protected $table = 'unidades_medicas';

    protected $fillable = [
        'nombre',
        'subtitulo',
        'direccion',
        'icono',
        'tema',
        'imagen',
        'horario_1',
        'horario_2',
        'servicios',
        'activo',
        'orden',
    ];

    protected $casts = [
        'servicios' => 'array',
        'activo' => 'boolean',
    ];

    public function scopeActivas($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('id');
    }
}

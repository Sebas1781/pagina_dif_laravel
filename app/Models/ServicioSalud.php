<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioSalud extends Model
{
    protected $table = 'servicios_salud';

    protected $fillable = [
        'nombre',
        'descripcion',
        'horario',
        'color_horario',
        'imagen',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('id');
    }
}

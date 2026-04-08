<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectorioItem extends Model
{
    protected $table = 'directorio_items';

    protected $fillable = [
        'nombre',
        'direccion',
        'horario',
        'icono',
        'color_gradiente',
        'servicios',
        'activo',
        'orden',
    ];

    protected $casts = [
        'servicios' => 'array',
        'activo' => 'boolean',
    ];

    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('id');
    }
}

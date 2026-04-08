<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaludServicio extends Model
{
    protected $table = 'salud_servicios';

    protected $fillable = [
        'nombre',
        'icono',
        'color_gradiente',
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

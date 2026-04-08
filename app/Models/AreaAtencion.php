<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaAtencion extends Model
{
    protected $table = 'areas_atencion';

    protected $fillable = [
        'nombre',
        'icono',
        'color_gradiente',
        'enlace',
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

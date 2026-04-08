<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioSeccionItem extends Model
{
    protected $table = 'servicio_seccion_items';

    protected $fillable = [
        'categoria',
        'nombre',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public const CATEGORIAS = [
        'bienestar_social' => 'Bienestar Social',
        'derechos' => 'Atencion y Defensa de Derechos',
        'salud' => 'Salud',
        'educacion_cultura' => 'Educacion y Cultura',
        'juridico' => 'Juridico',
    ];

    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('id');
    }
}

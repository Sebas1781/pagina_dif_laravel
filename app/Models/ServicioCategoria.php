<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioCategoria extends Model
{
    protected $table = 'servicio_categorias';

    protected $fillable = [
        'clave',
        'nombre',
        'subtitulo',
        'icono',
        'tema',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function scopeActivas($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('id');
    }
}

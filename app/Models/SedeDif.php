<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SedeDif extends Model
{
    protected $table = 'sedes_dif';

    protected $fillable = [
        'nombre',
        'icono',
        'color',
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

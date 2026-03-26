<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrusel extends Model
{
    protected $table = 'carrusel';

    protected $fillable = [
        'titulo',
        'imagen',
        'url',
        'archivo',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderByDesc('created_at');
    }
}

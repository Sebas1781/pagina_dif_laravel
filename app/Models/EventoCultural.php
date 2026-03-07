<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoCultural extends Model
{
    protected $table = 'eventos_culturales';

    protected $fillable = ['titulo', 'subtitulo', 'descripcion', 'imagen', 'activo', 'orden'];

    protected $casts = ['activo' => 'boolean'];

    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderByDesc('created_at');
    }
}

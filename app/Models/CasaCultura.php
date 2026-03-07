<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CasaCultura extends Model
{
    protected $table = 'casas_cultura';

    protected $fillable = ['nombre', 'direccion', 'icono', 'color_gradiente', 'imagen', 'activo', 'orden'];

    protected $casts = ['activo' => 'boolean'];

    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('nombre');
    }
}

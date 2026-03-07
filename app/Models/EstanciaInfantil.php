<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstanciaInfantil extends Model
{
    protected $table = 'estancias_infantiles';

    protected $fillable = ['nombre', 'icono', 'color_gradiente', 'activo', 'orden'];

    protected $casts = ['activo' => 'boolean'];

    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('nombre');
    }
}

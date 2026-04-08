<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemtysCard extends Model
{
    protected $table = 'remtys_cards';

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

    public function documentos()
    {
        return $this->hasMany(RemtysDocumento::class, 'remtys_card_id')->orderBy('orden')->orderBy('id');
    }

    public function scopeActivas($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DocumentoInicio extends Model
{
    protected $table = 'documentos_inicio';

    protected $fillable = [
        'nombre',
        'archivo',
        'link_externo',
        'orden',
        'activo',
    ];

    protected $casts = [
        'orden'  => 'integer',
        'activo' => 'boolean',
    ];

    public function getUrlAttribute(): ?string
    {
        if ($this->archivo) {
            return asset('storage/' . $this->archivo);
        }
        return $this->link_externo;
    }

    public function tieneArchivo(): bool
    {
        return !empty($this->archivo);
    }

    public function tieneLink(): bool
    {
        return !empty($this->link_externo);
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}

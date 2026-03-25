<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DocumentoPresupuesto extends Model
{
    protected $table = 'documentos_presupuesto';

    protected $fillable = [
        'anio',
        'categoria',
        'nombre',
        'archivo',
        'link_externo',
        'orden',
        'activo',
    ];

    protected $casts = [
        'anio'   => 'integer',
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

    public function scopeDelAnio($query, int $anio)
    {
        return $query->where('anio', $anio);
    }

    public static function agrupadosPorAnio(): array
    {
        $docs = static::activos()
            ->orderBy('anio', 'desc')
            ->orderBy('categoria')
            ->orderBy('orden')
            ->get();

        $resultado = [];
        foreach ($docs as $doc) {
            $resultado[$doc->anio][$doc->categoria][] = $doc;
        }

        return $resultado;
    }

    public static function aniosDisponibles(): array
    {
        return static::activos()
            ->select('anio')
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio')
            ->toArray();
    }
}

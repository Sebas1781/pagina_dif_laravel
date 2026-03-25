<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DocumentoSevac extends Model
{
    protected $table = 'documentos_sevac';

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

    /**
     * Devuelve la URL pública del documento (archivo local o link externo).
     */
    public function getUrlAttribute(): ?string
    {
        if ($this->archivo) {
            return asset('storage/' . $this->archivo);
        }

        return $this->link_externo;
    }

    /**
     * ¿Tiene archivo subido al servidor?
     */
    public function tieneArchivo(): bool
    {
        return !empty($this->archivo);
    }

    /**
     * ¿Tiene link externo?
     */
    public function tieneLink(): bool
    {
        return !empty($this->link_externo);
    }

    /**
     * Scope: solo activos.
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope: filtrar por año.
     */
    public function scopeDelAnio($query, int $anio)
    {
        return $query->where('anio', $anio);
    }

    /**
     * Obtiene los documentos agrupados por año → categoría, ordenados.
     * Ideal para la vista pública.
     */
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

    /**
     * Devuelve los años disponibles (con al menos 1 doc activo).
     */
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemtysDocumento extends Model
{
    protected $table = 'remtys_documentos';

    protected $fillable = [
        'remtys_card_id',
        'titulo',
        'archivo',
        'url',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function card()
    {
        return $this->belongsTo(RemtysCard::class, 'remtys_card_id');
    }
}

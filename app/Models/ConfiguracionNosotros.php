<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionNosotros extends Model
{
    protected $table = 'configuracion_nosotros';

    protected $fillable = [
        'mision',
        'vision',
        'valores',
    ];

    protected $casts = [
        'valores' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $fillable = ['personas_cedula', 'area_id', 'observaciones', 'estado'];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'personas_cedula', 'cedula');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}

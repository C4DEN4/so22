<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'cedula';
    public $incrementing = false;    
    protected $keyType = 'string';

    protected $fillable = ['cedula', 'nombre', 'apellido', 'correo', 'numero','active'];
    protected $attributes = [
        'active' => 'true',
    ];
    public function ingresos(): HasMany
    {
        return $this->hasMany(Ingreso::class, 'personas_cedula', 'cedula');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomina extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = "nomina";

    protected $fillable =  [
        'curp',
        'horas',
        'minutos',
        'total',
        'imss',
        'prima_v',
        'festivos',
        'descuentos',
        'comida',
        'prima_d',
        'bonos',
        'host',
        'gasolina',
        'uniformes',
        'uniformes_export',
        'fecha_inicio',
        'fecha_fin',
        'isr',
        'dias',
    ];

    public function empleado(){
        return $this->belongsTo(NumTrabajo::class, 'curp', 'numero');
    }

    public function pivote(){
        return $this->hasMany(PivoteNomina::class, 'id_nomina', 'curp');
    }

}

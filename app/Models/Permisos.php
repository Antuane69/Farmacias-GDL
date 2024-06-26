<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permisos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = "permisos";

    protected $fillable =  [    
        'curp',
        'fecha_solicitud',
        'fecha_inicio',
        'fecha_regreso',
        'dias_totales',
        'motivo',
        'fecha_anteriorPermiso',
        'estado',
        'comentario',
        'empleados_cubren'
    ];

    public function empleado(){
        return $this->belongsTo(Empleados::class, 'curp', 'curp');
    }

}

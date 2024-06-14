<?php

namespace App\Models;

use Illuminate\Auth\Events\Authenticated;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Empleados extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $dates = ['deleted_at'];
    protected $table = "empleados";

    protected $fillable =  [
        'nombre',
        'curp',
        'rfc',
        'nss',
        'puesto',
        'fecha_ingreso',
        'fecha_nacimiento',
        'fecha_2doContrato',
        'fecha_3erContrato',
        'fecha_indefinido',
        'telefono',
        'num_clinicaSS',
        'salario_dia',
        'imagen_perfil',
        'dias_vacaciones',
        'antecedentes',
        'recomendacion',
        'estudios',
        'nacimiento',
        'domicilio',
        'ine',
        'nomina',
        'ine_trasera',
        'ine_delantera',
        'liquidacion_dias',
        'civil',
        'sexo',
        'descanso',
        'quincena',
        'domicilio_contrato',
        'evaluacion_export',
        'evaluacion_fecha',
        'correo_fecha'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public function vacaciones() {
        return $this->hasMany(Vacaciones::class, 'curp', 'curp');
    }

    public function incapacidades() {
        return $this->hasMany(Incapacidades::class, 'curp', 'curp');
    }

    public function permisos() {
        return $this->hasMany(Permisos::class, 'curp', 'curp');
    }

    public function uniformes() {
        return $this->hasMany(Uniformes::class, 'curp', 'curp');
    }

    public function faltas() {
        return $this->hasMany(Faltas::class, 'curp', 'curp');
    }

    // En el modelo Empleado.php

    public function validacionContrato()
    {
        // Implementa lógica para verificar si todas las columnas están completas
        // Retorna true si todas las columnas están completas, de lo contrario, retorna false
        $columnasRequeridas = 25;
        $columnasCompletas = 0;

        foreach ($this->getAttributes() as $valor) {
            if (!empty($valor)) {
                $columnasCompletas++;
            }
        }

        return $columnasCompletas >= $columnasRequeridas;
    }


}

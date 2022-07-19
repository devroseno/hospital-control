<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $casts = [
        'sintomas' => 'array'
    ];

    protected $fillable = [
        'nome',
        'idade',
        'dia',
        'mes',
        'ano',
        'cpf',
        'wpp',
        'status',
        'sintomas',
        'avatar'
    ];

    function getOrganizationAttribute() {
        $sintomas = json_decode($this->attributes['sintomas']);
        sort($sintomas);
        return $sintomas;
    }

    protected function defineStatus(array $status) {
        if(isset($this->attributes['sintomas'])) {
            $info = json_decode($this->attributes['sintomas']);
            $contar = count($info);
            if($contar >= 1 && $contar <= 5) {
                $status = $this->attributes['status'] = $status[0];
            }elseif($contar >= 6 && $contar <= 9) {
                $status = $this->attributes['status'] = $status[1];
            }elseif($contar >= 10) {
                $status = $this->attributes['status'] = $status[2];
            }
        }else {
            $status = $this->attributes['status'] = $status[3];
        }
        return $status;
    }

    function getStatusAttribute() {
        return $this->defineStatus([
            '<i class="bi bi-check-circle" style="color: green;"></i> SINTOMAS INSUFICIENTES',
            '<i class="bi bi-bell" style="color: orange;"></i> POTENCIAL INFECTADO',
            '<i class="bi bi-exclamation-triangle" style="color: red;"></i> POSSÍVEL INFECTADO',
            '<i class="bi bi-exclamation-circle" style="color: blue;"></i> PACIENTE NÃO ATENDIDO'
        ]);
    }
}

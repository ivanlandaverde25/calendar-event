<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoNuevo extends Model
{
    use HasFactory;

    protected $table = 'eventos_nuevo';

    protected $fillable = [
        'nombre',
        'grupo',
        'responsable',
        'estado',
        'prioridad',
        'fecha_creacion',
        'fecha_inicio',
        'fecha_fin'
    ];
}

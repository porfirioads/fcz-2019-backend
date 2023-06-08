<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuesta';
    public $timestamps = false;

    protected $fillable = [
        'procedencia',
        'sexo',
        'edad',
        'evento_id',
        'calificacion',
        'comentario'
    ];
}

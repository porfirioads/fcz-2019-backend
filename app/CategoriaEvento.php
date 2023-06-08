<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaEvento extends Model
{
    protected $table = 'categoria_evento';
    public $timestamps = false;

    protected $fillable = [
        'evento_id',
        'categoria_id',
        'nombre_campo_orden'
    ];
}

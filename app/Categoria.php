<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'icono',
        'categoria_padre_id',
        'link'
    ];
}

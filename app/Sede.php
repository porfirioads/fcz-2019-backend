<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sede';
    public $timestamps = false;

    protected $fillable = [
        'lat',
        'lon',
        'categoria_id'
    ];
}

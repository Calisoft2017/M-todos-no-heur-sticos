<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    protected $table = 'rol';

    protected $fillable = ['name_rol'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_rol';
}

<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class prueba_carga extends Model
{
    protected $table = 'prueba_carga';

    protected $fillable = ['id_casoPrueba','usuarios'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_prueba_carga';
}
<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class prueba extends Model
{
    protected $table = 'prueba';

    protected $fillable = ['id_casoPrueba','name_Prueba'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_prueba';
}

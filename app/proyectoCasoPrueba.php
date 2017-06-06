<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class proyectoCasoPrueba extends Model
{
    protected $table = 'proyectoCasoPrueba';

    protected $fillable = ['id_proyecto','id_casoPrueba','id_usuario'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_proyectoCasoPrueba';
}

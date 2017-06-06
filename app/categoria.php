<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    protected $table = 'categoria';

    protected $fillable = ['name_categoria','porcPlataforma','porcModelado','prioridadAlta','prioridadMedia','prioridadBaja','dClases','dCasos','dDespliegue','dSecuencias','dActividades','MER'];

    protected $dateFormat = 'd.m.Y H:i:s';

    protected $primaryKey = 'id_categoria';
}

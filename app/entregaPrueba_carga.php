<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class entregaPrueba_carga extends Model
{
    protected $table = 'entregaPrueba_carga';

    protected $fillable = ['id_prueba_carga','n_entrega','estado','observacion','usuarios_realizados','tiempos'];

    protected $dateFormat = 'd.m.Y H:i:s';

    protected $primaryKey = 'id_entregaPrueba_carga';
}

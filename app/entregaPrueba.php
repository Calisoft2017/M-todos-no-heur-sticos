<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class entregaPrueba extends Model
{
    protected $table = 'entregaPrueba';

    protected $fillable = ['id_prueba','n_entrega','estado','observacion'];

    protected $dateFormat = 'd.m.Y H:i:s';

    protected $primaryKey = 'id_entregaPrueba';
}

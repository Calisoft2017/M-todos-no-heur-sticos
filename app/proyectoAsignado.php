<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class proyectoAsignado extends Model
{
    protected $table = 'proyectoAsignado';

    protected $fillable = ['id_usuario','id_proyecto'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_proyectoAsignado';
}

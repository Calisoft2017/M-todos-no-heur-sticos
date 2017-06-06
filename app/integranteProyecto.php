<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class integranteProyecto extends Model
{
    protected $table = 'integranteProyecto';

    protected $fillable = ['id_proyecto','id_usuario'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_integranteProyecto';
}

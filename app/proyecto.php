<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    protected $table = 'proyecto';

    protected $fillable = ['name_proyecto','name_investigacion','name_semillero','id_categoria'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_proyecto';
}

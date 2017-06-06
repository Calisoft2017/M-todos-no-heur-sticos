<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class configPorcentaje extends Model
{
    protected $table = 'configPorcentaje';

    protected $fillable = ['name_campo'.'valor'];

    protected $dateFormat = 'd.m.Y H:i:s';

    protected $primaryKey = 'id_campo';
}

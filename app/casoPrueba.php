<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class casoPrueba extends Model
{
    protected $table = 'casoPrueba';

    protected $fillable = ['name_casoPrueba','proposito','objetivo','alcance','resultadoEsperado','criteriosEvaluacion','prioridad','fecha_limite','txt','observacionEstudiante','conclucion','estado','entrega'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_casoPrueba';
}

<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;
use DB;

class documentosProyecto extends Model
{
    protected $table = 'documentosProyecto';
    
    protected $fillable = ['url_documento','nombre_documento','id_proyecto','id_tipo_documento'];

    protected $primaryKey = 'id_documentos_proyecto';

    public static function DocProyecto($id_proyecto){
    	return DB::table('documentosProyecto')
    	->join('tipoDocumento','tipoDocumento.id_tipo_documento','=','documentosProyecto.id_tipo_documento')
    	->where('documentosProyecto.id_proyecto','=',$id_proyecto)
    	->select('documentosProyecto.*','tipoDocumento.*')
    	->get();
    }

    public static function Componentes($id_tipo){
        return DB::table('documentoComponente')
        ->where('documentoComponente.id_tipo_documento','=',$id_tipo)
        ->select('documentoComponente.*')
        ->get();
    }
    public static function IntegranteProyecto($id_usuario){
        return DB::table('integranteProyecto')
        ->where('integranteProyecto.id_usuario','=',$id_usuario)
        ->select('integranteProyecto.*')
        ->get();
    }
}

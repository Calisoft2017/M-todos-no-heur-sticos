<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;
use DB;

class documentoComponente extends Model
{
    protected $table = 'documentoComponente';
    
    protected $fillable = ['nom_componente', 'opcional_componente','descripcion','id_tipo_documento'];

    protected $primaryKey = 'id_documento_componente';

    public static function DocComponente($id){
    	return DB::table('documentoComponente')
    	->join('tipoDocumento','tipoDocumento.id_tipo_documento','=','documentoComponente.id_tipo_documento')
    	->where('tipoDocumento.id_tipo_documento','=',$id)
    	->select('documentoComponente.*','tipoDocumento.*')
    	->get();
    }
    public static function DocComponentes(){
    	return DB::table('documentoComponente')
    	->join('tipoDocumento','tipoDocumento.id_tipo_documento','=','documentoComponente.id_tipo_documento')
    	->select('documentoComponente.*','tipoDocumento.*')
    	->get();
    }
    public static function id_proyecto($id){
        return DB::table('integranteProyecto')
        ->where('integranteProyecto.id_usuario','=',$id)
        ->select('integranteProyecto.id_proyecto')
        ->get();
    }
}

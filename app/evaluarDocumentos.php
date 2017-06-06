<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;
use DB;

class evaluarDocumentos extends Model
{
    protected $table = 'evaluarDocumento';
    
    protected $fillable = ['id_documentos_proyecto', 'check','observaciones','id_usuario'];

    protected $primaryKey = 'id_evaluar_documento';

    public static function EvalDoc($id_usuario,$id_proyecto){
        return DB::table('evaluarDocumento')
        ->where('evaluarDocumento.id_documentos_proyecto','=',$id_proyecto)
        ->where('evaluarDocumento.id_usuario','=',$id_usuario )
        ->select('evaluarDocumento.*')
        ->get();
    }
    public static function Reporte(){
    	 return DB::table('documentosProyecto')
    	->join('evaluarDocumento','evaluarDocumento.id_documentos_proyecto','=','documentosProyecto.id_documentos_proyecto')
    	->select('documentosProyecto.*','evaluarDocumento.*')
    	->get();
    }
    public static function Cantidad_Comp(){
    	 return DB::table('documentoComponente')
    	 ->count('id_documento_componente');
    }
    public static function EvalDocReporte($id_usuario,$id_proyecto){
    	 return DB::table('evaluarDocumento')
    	->join('documentosProyecto','documentosProyecto.id_documentos_proyecto','=','evaluarDocumento.id_documentos_proyecto')
    	->where('documentosProyecto.id_proyecto','=',$id_proyecto)
        ->where('evaluarDocumento.id_usuario','=',$id_usuario )
    	->select('evaluarDocumento.*')
    	->get();
    }
}

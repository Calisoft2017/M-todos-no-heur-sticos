<?php  //Modelo
namespace calidad;

use Illuminate\Database\Eloquent\Model;

class tipoDocumento extends Model
{
    protected $table = 'tipoDocumento';
    
    protected $fillable = ['nom_tipo', 'opcional_tipo'];

    protected $primaryKey = 'id_tipo_documento';

    public static function DocComponente(){
    	return DB::table('documentoComponente')
    	->join('tipoDocumento','tipoDocumento.id_tipo_documento','=','documentoComponente.id_tipo_documento')
    	->select('documentoComponente.*','tipoDocumento.nom_tipo')
    	->get();
    }
}

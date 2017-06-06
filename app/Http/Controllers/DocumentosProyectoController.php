<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;
use calidad\documentosProyecto;
use calidad\tipoDocumento;
use calidad\documentoComponente;
use calidad\Http\Requests;
use Carbon\Carbon;

class DocumentosProyectoController extends Controller
{

    public function index(Request $request){
      
      if(isset($request['h_id_usuario'])){
       $id_usuario = $request['h_id_usuario'];
       $res = documentoComponente::id_proyecto($id_usuario);      
       $id_proyecto = $res[0]->id_proyecto;}
      else{
       $id_proyecto =  $request['h_id_proyecto'];
       }
       $mensaje = "";
       $documentosproyecto = documentosProyecto::DocProyecto($id_proyecto);
       $tipoDocumento = tipoDocumento::All();       
       return view('viewEstudiante.index',compact('documentosproyecto','tipoDocumento','mensaje','id_proyecto'));
    }
    public function create(Request $request){
        $mensaje = "";
        $file = $request->file('url_documento');
        if($request->file('url_documento')==false){
 	return header('Location: ../estudiante');
 	}
        $id_proyecto = $request['h_id_proyecto'];
        $nombre = $file->getClientOriginalName();
        $day = Carbon::now()->day.Carbon::now()->month.Carbon::now()->year.Carbon::now()->minute.Carbon::now()->second;
 
        if ($_FILES['url_documento']['type'] !='application/pdf'){
          $mensaje = 'El archivo no es de tipo .PDF';
        }else{
        if ($_FILES['url_documento']['size']/1024 > '10000'){ //10MB
          $mensaje = 'Tamaño del archivo mayor de 10 MB';
        }else{
        documentosProyecto::create([
            'nombre_documento' => $request['nombre_documento'],
            'url_documento' => $day.$nombre,
            'id_tipo_documento'=> $request['id_tipo_documento'],
            'id_proyecto' => $id_proyecto,
            ]);
        \Storage::disk('documento')->put($day.$nombre,\File::get($file));
     
         }
       }
       $documentosproyecto = documentosProyecto::DocProyecto($id_proyecto);
       $tipoDocumento = tipoDocumento::All();
       return view('viewEstudiante.index',compact('documentosproyecto','tipoDocumento','mensaje','id_proyecto'));
    }
    public function update(Request $request){
        $mensaje = "";
        $file = $request->file('url_documento');
        if($request->file('url_documento')==false){
 	return header('Location: ../estudiante');
 	}
        $id_proyecto = $request['h_id_proyecto'];
        $nombre = $file->getClientOriginalName();
        $day = Carbon::now()->day.Carbon::now()->month.Carbon::now()->year.Carbon::now()->minute.Carbon::now()->second;
  
        if ($_FILES['url_documento']['type'] !='application/pdf'){
          $mensaje = 'El archivo no es de tipo .PDF';
        }else{
        if ($_FILES['url_documento']['size']/1024 > '10000'){ //10MB
          $mensaje = 'Tamaño del archivo mayor de 10 MB';
        }else{
          $crud = documentosProyecto::find($request['Aceptar']);
          $crud->nombre_documento = $request['nombre_documento'];
          $crud->url_documento= $day.$nombre;
          $crud->save(); 
          \Storage::disk('documento')->put($day.$nombre,\File::get($file));
        }
      }
       $documentosproyecto = documentosProyecto::DocProyecto($id_proyecto);
       $tipoDocumento = tipoDocumento::All();
       return view('viewEstudiante.index',compact('documentosproyecto','tipoDocumento','mensaje','id_proyecto'));
    }
}
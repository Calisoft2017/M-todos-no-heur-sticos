<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;
use calidad\documentosProyecto;
use calidad\documentoComponente;
use calidad\evaluarDocumentos;
use calidad\escenario;
use calidad\prueba;
use calidad\Http\Requests;

class EvaluarDocumentosController extends Controller
{
    public function index(Request $request){
       $id_proyecto = $request['h_id_proyecto'];
       $id_usuario=$request['h_id_usuario'];
       $documentosproyecto = documentosProyecto::DocProyecto($id_proyecto);
       $id = '1';
       $componente  = documentoComponente::DocComponente($id);
       $evaluacion = evaluarDocumentos::All();
       return view('viewEvaluador/index', compact('documentosproyecto','componente','evaluacion','id_usuario'));
    }
    public function create(Request $request){
       $id_proyecto = $request['h_id_proyecto'];
       $id_usuario= $request['h_id_usuario'];
       $id_tipo = $request['id_tipo_documento'];
       $id_doc = $request['Evaluar'];
       $documentosproyecto = documentosProyecto::DocProyecto($id_proyecto);
       $componente = documentosproyecto::Componentes($id_tipo);
       $evaluacion = evaluarDocumentos::EvalDoc($id_usuario,$id_doc);
       return view('viewEvaluador/index', compact('documentosproyecto','componente','evaluacion','id_usuario'));
    }
    public function edit(Request $request){
       $id_usuario= $request['h_id_usuario'];
       $id_proyecto = $request['h_id_proyecto'];
       $j =  $request['cont'];
       $nuevo_eval = ".";
       $evalua = explode(".", $request['comp']);
       for ($i=1; $i <= $j; $i++) { 
        if($request[$evalua[$i]]!="")
         $nuevo_eval = $nuevo_eval.$evalua[$i].".".$request[$evalua[$i]].".";
       }
      
       evaluarDocumentos::create([
            'id_documentos_proyecto' => $request['Aceptar'],
            'check' => $nuevo_eval,
            'observaciones'=> $request['Observaciones'],
            'id_usuario' => $id_usuario,
            ]);
       $documentosproyecto = documentosProyecto::DocProyecto($id_proyecto);
       $id = '1';
       $componente  = documentoComponente::DocComponente($id);
       $evaluacion = evaluarDocumentos::All();
       return view('viewEvaluador/index', compact('documentosproyecto','componente','evaluacion','id_usuario'));

    }
   public function resultados(Request $request){
      if(isset($request['h_id_usuario'])){
       $id_usuario= $request['h_id_usuario'];
       $id_evaluador = $request['h_id_evaluador'];
       $res = documentosProyecto::IntegranteProyecto($id_usuario);
       $id_proyecto = $res[0]->id_proyecto;}
       else{
       $id_evaluador = $request['h_id_evaluador'];
       $id_proyecto =  $request['h_id_proyecto'];
       }
       $documentosproyecto = documentosProyecto::DocProyecto($id_proyecto);
       $id = '1';
       $componente  = documentoComponente::DocComponente($id);
       $evaluacion = evaluarDocumentos::All();
       return view('viewEstudiante/resultadosevaluaciondoc', compact('documentosproyecto','componente','evaluacion','id_evaluador'));
    }
    public function detalles(Request $request){
       $id_proyecto = $request['h_id_proyecto'];;
       $id_evaluador = $request['h_id_evaluador'];
       $id_tipo = $request['id_tipo_documento'];
       $id_doc = $request['Detalle'];
       $documentosproyecto = documentosProyecto::DocProyecto($id_proyecto);
       $componente = documentosproyecto::componentes($id_tipo);
       $evaluacion = evaluarDocumentos::EvalDoc($id_evaluador,$id_doc);
       return view('viewEstudiante/resultadosevaluaciondoc', compact('documentosproyecto','componente','evaluacion','id_evaluador'));
    }
 
    public function reportepruebas(Request $request){
        $reporte = EvaluarDocumentos::Reporte();
        $cantidad_comp = EvaluarDocumentos::Cantidad_Comp();
        $pruebas = prueba::All();
        //return $pruebas;
        return view('viewEstudiante/reportepruebas', compact('reporte','cantidad_comp','pruebas'));
    }
    public function graficas(){
      
       return view('viewEvaluador/graficas');
    }
}
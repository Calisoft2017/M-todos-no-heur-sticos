<?php

namespace calidad\Http\Controllers;

use Auth;
use Redirect;
use Illuminate\Http\Request;
use calidad\Http\Requests;
use calidad\Http\Requests\LoginRequest;
use calidad\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use calidad\casoPrueba;
use calidad\documentosProyecto;
use calidad\documentoComponente;
use calidad\evaluarDocumentos;
use Carbon\Carbon;

class reporteController extends Controller
{
    public function reporte_generalEva($tipo, Request $request){
        $vistaurl="pdf.reporte_generalEva"; 
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        $evaluador = \calidad\usuario::where('id_usuario',$request['id_usuario']) -> get();
        $proyecto = \calidad\proyecto::where('id_proyecto',$request['id_proyecto']) -> get();

        $documentosproyecto = \calidad\documentosProyecto::DocProyecto($request['id_proyecto']);
        $componente = \calidad\documentoComponente::All();
        $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_usuario'],$request['id_proyecto']);
        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();
            $porcentaje= \calidad\configPorcentaje::orderBy('id_campo', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('casoPrueba','pruebas','date','proyecto','evaluador','documentosproyecto','componente','evaluacion','porcentaje'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        if($tipo==1){
           return $pdf->stream("verReporteGeneral-");
        } 
        if($tipo==2){
            return $pdf->download('reporteGeneral.pdf'); 
        }
    }
    public function reporte_generalEst($tipo, Request $request){
            $vistaurl="pdf.reporte_generalEst";
            $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario']) ->get();
            foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }

            $estudiante = \calidad\usuario::where('id_usuario',$request['id_usuario']) -> get();
            $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador']) -> get();
            $proyecto = \calidad\proyecto::where('id_proyecto',$id_proyecto) -> get();
            $casoPrueba = \calidad\casoPrueba
                ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
                ->where('proyectoCasoPrueba.id_proyecto',$id_proyecto)
                ->where('proyectoCasoPrueba.id_usuario',$request['id_evaluador'])
                ->select('casoPrueba.*','proyectoCasoPrueba.*')
                ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

            $documentosproyecto = \calidad\documentosProyecto::DocProyecto($id_proyecto);
            $componente = \calidad\documentoComponente::All();
            $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_evaluador'],$id_proyecto);
            $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();
            $porcentaje= \calidad\configPorcentaje::orderBy('id_campo', 'asc')->get();

            $date = date('Y-m-d');
            $view =  \View::make($vistaurl,compact('casoPrueba','pruebas','date','proyecto','evaluador','documentosproyecto','componente','evaluacion','estudiante','porcentaje'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
        if($tipo==1){
            return $pdf->stream("verReporteGeneral-");
        }
        if($tipo==2){
            return $pdf->download('reporteGeneral.pdf'); 
        }
    }

   public function reporte_modeladoEva($tipo, Request $request){
     if($tipo==1){
            $vistaurl="pdf.reporte_modeladoEva";

            $proyecto = \calidad\proyecto::where('id_proyecto',$request['h_id_proyecto']) -> get();
            $evaluador = \calidad\usuario::where('id_usuario',$request['h_id_usuario']) -> get();

            $reporte = EvaluarDocumentos::Reporte();
            $cantidad_comp = EvaluarDocumentos::Cantidad_Comp();

            $documentosproyecto = \calidad\documentosProyecto::DocProyecto($request['h_id_proyecto']);
            $componente = \calidad\documentoComponente::All();
            $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['h_id_usuario'],$request['h_id_proyecto']);
            $date = date('Y-m-d');
            $view =  \View::make($vistaurl, compact('casoPrueba','pruebas', 'date','proyecto','evaluador','reporte','cantidad_comp','documentosproyecto','componente','evaluacion'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream("verReporteFinal-");
        }
        if($tipo==2){
            $vistaurl="pdf.reporte_modeladoEva";

            $proyecto = \calidad\proyecto::where('id_proyecto',$request['h_id_proyecto1']) -> get();
            $evaluador = \calidad\usuario::where('id_usuario',$request['h_id_usuario1']) -> get();

            $reporte = EvaluarDocumentos::Reporte();
            $cantidad_comp = EvaluarDocumentos::Cantidad_Comp();

            $documentosproyecto = \calidad\documentosProyecto::DocProyecto($request['h_id_proyecto1']);
            $componente = \calidad\documentoComponente::All();
            $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['h_id_usuario1'],$request['h_id_proyecto1']);
            $date = date('Y-m-d');
            $view =  \View::make($vistaurl, compact('casoPrueba','pruebas', 'date','proyecto','evaluador','reporte','cantidad_comp','documentosproyecto','componente','evaluacion'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->download('reporteFinal.pdf'); 
        }
    }
    public function reporte_modeladoEst($tipo, Request $request){
        if($tipo==1){
            $vistaurl="pdf.reporte_modeladoEst";
            $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario']) ->get();
            foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }

            $estudiante = \calidad\usuario::where('id_usuario',$request['id_usuario']) -> get();
            $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador']) -> get();
            $proyecto = \calidad\proyecto::where('id_proyecto',$id_proyecto) -> get();

            $documentosproyecto = \calidad\documentosProyecto::DocProyecto($id_proyecto);
            $componente = \calidad\documentoComponente::All();
            $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_evaluador'],$id_proyecto);

            $date = date('Y-m-d');
            $view =  \View::make($vistaurl, compact('date','proyecto','evaluador','documentosproyecto','componente','evaluacion','estudiante'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream("verReporteFinal-");
        }
        if($tipo==2){
            $vistaurl="pdf.reporte_modeladoEst";
            $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario1']) ->get();
            foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }

            $estudiante = \calidad\usuario::where('id_usuario',$request['id_usuario1']) -> get();
            $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador1']) -> get();
            $proyecto = \calidad\proyecto::where('id_proyecto',$id_proyecto) -> get();

            $documentosproyecto = \calidad\documentosProyecto::DocProyecto($id_proyecto);
            $componente = \calidad\documentoComponente::All();
            $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_evaluador1'],$id_proyecto);

            $date = date('Y-m-d');
            $view =  \View::make($vistaurl, compact('date','proyecto','evaluador','documentosproyecto','componente','evaluacion','estudiante'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->download('reporteFinal.pdf'); 
        }
    }

    public function reporte_final(Request $request){
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto2'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario2'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        $date = date('Y-m-d');
        $proyecto = \calidad\proyecto::where('id_proyecto',$request['id_proyecto2']) -> get();
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_usuario2']) -> get();

        $reporte = EvaluarDocumentos::Reporte();
        $cantidad_comp = EvaluarDocumentos::Cantidad_Comp();
        return view('pdf.reporte_final',compact('casoPrueba', 'date', 'proyecto', 'evaluador','reporte','cantidad_comp'));
    }

    public function reporte_gestionEva($tipo, Request $request){
        $vistaurl="pdf.reporte_gestionEva";
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_usuario']) -> get();
        $proyecto = \calidad\proyecto::where('id_proyecto',$request['id_proyecto']) -> get();
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();
        $porcentaje= \calidad\configPorcentaje::orderBy('id_campo', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('casoPrueba','pruebas', 'date','proyecto','evaluador','porcentaje'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream("verReporteGestionPruebas-");}
        if($tipo==2){return $pdf->download('reporteGestionPruebas.pdf'); }
    }

    public function reporte_gestionEst($tipo, Request $request){
            $vistaurl="pdf.reporte_gestionEst";
            $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario']) ->get();
            foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }

            $estudiante = \calidad\usuario::where('id_usuario',$request['id_usuario']) -> get();
            $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador']) -> get();
            $proyecto = \calidad\proyecto::where('id_proyecto',$id_proyecto) -> get();
            $casoPrueba = \calidad\casoPrueba
                ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
                ->where('proyectoCasoPrueba.id_proyecto',$id_proyecto)
                ->where('proyectoCasoPrueba.id_usuario',$request['id_evaluador'])
                ->select('casoPrueba.*','proyectoCasoPrueba.*')
                ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

            $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_evaluador'],$id_proyecto);
            $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();
            $porcentaje= \calidad\configPorcentaje::orderBy('id_campo', 'asc')->get();

            $date = date('Y-m-d');
            $view =  \View::make($vistaurl,compact('casoPrueba','pruebas','date','proyecto','evaluador','estudiante','porcentaje'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
        if($tipo==1){
            return $pdf->stream("verReportePruebas-");
        }
        if($tipo==2){
            return $pdf->download('reportePruebas.pdf'); 
        }
    }
}

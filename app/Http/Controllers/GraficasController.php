<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;

use calidad\Http\Requests;
use calidad\Http\Controllers\Controller;/*
use calidad\User;
use calidad\Publicaciones;
use calidad\TipoPublicaciones;
use calidad\Pais;*/

class GraficasController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getUltimoDiaMes($elAnio,$elMes) {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }



    public function registros_mes($anio,$mes)
    {
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $usuarios=\calidad\casoPrueba::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        $ct=count($usuarios);

        for($d=1;$d<=$ultimo_dia;$d++){
            $registros[$d]=0;     
        }

        foreach($usuarios as $usuario){
        //$diasel=intval(date("d",strtotime($usuario->created_at) ) );
        $diasel = $usuario->id_casoPrueba;
        $registros[$diasel]++;    
        }

        $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
        return   json_encode($data);
    }


    public function total_publicaciones(){
        $tipospublicacion=\calidad\rol::All();
        $ctp=count($tipospublicacion);
        $publicaciones=\calidad\usuario::all();
        $ct =count($publicaciones);
        
        foreach ($tipospublicacion as $roles) {
            $idTP=$roles->id_rol;
            $numerodepubli[$idTP]=0;
        }

        foreach ($publicaciones as $user) {
            $idTP = $user->id_rol;
            $numerodepubli[$idTP]++;
        }

        $data=array("totaltipos"=>$ctp,"tipos"=>$tipospublicacion, "numerodepubli"=>$numerodepubli);
        return json_encode($data);
    }


    public function index()
    {
        $anio=date("Y");
        $mes=date("m");
        return view("pdf.listado_graficas")
               ->with("anio",$anio)
               ->with("mes",$mes);
    }


    public function crearPDF($vistaurl,$ano,$me){

        $anio = $ano;
        $mes = $me;
        $view =  \View::make($vistaurl, compact('anio', 'mes'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        return $pdf->stream('reporte');
    }

    public function crear_reporte_usuario(){

        $anio=date("Y");
        $mes=date("m");
        $vistaurl="pdf.listado_graficas";
         
        return $this->crearPDF($vistaurl,$anio,$mes);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

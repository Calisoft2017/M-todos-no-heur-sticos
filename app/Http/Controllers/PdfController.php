<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;

use calidad\Http\Requests;
use calidad\Http\Controllers\Controller;
use calidad\casoPrueba;
use calidad\documentosProyecto;
use calidad\documentoComponente;
use calidad\evaluarDocumentos;


class PdfController extends Controller{
    
    public function index()
    {
        return view("pdf.listado_reportes");
    }

    public function crearPDF($datos,$vistaurl,$tipo){

        $data = $datos;
        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream('reporte');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }

    public function crear_reporte_porpais($tipo){

        $vistaurl="pdf.reporte_por_pais";
        $paises=\calidad\casoPrueba::all();
         
        return $this->crearPDF($paises, $vistaurl,$tipo);
    }

    public function reporte_por_pais(){
        $data=\calidad\casoPrueba::all();
        $date = date('Y-m-d');
        return view('pdf.reporte_por_pais',compact('data', 'date'));
    }
    
    public function reportepruebas(Request $request){
        $reporte = EvaluarDocumentos::Reporte();
        $cantidad_comp = EvaluarDocumentos::Cantidad_Comp();
        return view('viewEstudiante/reportepruebas', compact('reporte','cantidad_comp'));
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

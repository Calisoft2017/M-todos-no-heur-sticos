<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;
use calidad\tipoDocumento;
use calidad\documentoComponente;
use calidad\Http\Requests;

class TipoDocumentoController extends Controller
{
    public function index(){
       $tipoDocumento = tipoDocumento::All();
       $componente = documentoComponente::DocComponentes();
       return view('viewAdministrador.tipodocumento',compact('tipoDocumento','componente'));

    }
    public function store(Request $request){
        tipoDocumento::create([
                'nom_tipo' => $request['nom_tipo'],
                'opcional_tipo' => $request['drop'],

        ]);
       $tipoDocumento = tipoDocumento::All();
       $componente = documentoComponente::DocComponentes();
       return view('viewAdministrador.tipodocumento',compact('tipoDocumento','componente'));
    }
    public function update(Request $request){
        $tipoDocumento = tipoDocumento::find($request['Aceptar']); 
        $tipoDocumento->fill($request->All());
        $tipoDocumento->save();
       $tipoDocumento = tipoDocumento::All();
       $componente = documentoComponente::DocComponentes();
       return view('viewAdministrador.tipodocumento',compact('tipoDocumento','componente'));
    }
    public function destroy(Request $request){
        tipoDocumento::destroy($request['Eliminar']); 
        $tipoDocumento = tipoDocumento::All();
        $componente = documentoComponente::DocComponentes();
        return view('viewAdministrador.tipodocumento',compact('tipoDocumento','componente'));
    }
       

}

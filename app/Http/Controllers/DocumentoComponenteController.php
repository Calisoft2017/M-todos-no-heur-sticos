<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;
use calidad\documentoComponente;
use calidad\tipoDocumento;
use calidad\Http\Requests;

class DocumentoComponenteController extends Controller
{
	public function index(){
       $tipoDocumento = tipoDocumento::All();
       $componente = documentoComponente::DocComponentes();
       return view('tipodocumento.tipodocumento',compact('tipoDocumento','componente'));
    }
    public function store(Request $request){
        documentoComponente::create([
                'nom_componente' => $request['nom_componente'],
                'opcional_componente' => $request['opcional_componente'],
                'descripcion' => $request['descripcion'],
                'id_tipo_documento' => $request['id_tipo_documento'],
        ]);
       $tipoDocumento = tipoDocumento::All();
       $componente = documentoComponente::DocComponentes();
       return view('tipodocumento.tipodocumento',compact('tipoDocumento','componente'));
    }
    public function update(Request $request){
        $componente = documentoComponente::find($request['Aceptar']); 
        $componente->fill($request->All());
        $componente->save();
        $componente = tipoDocumento::All();
       $tipoDocumento = tipoDocumento::All();
       $componente = documentoComponente::DocComponentes();
       return view('tipodocumento.tipodocumento',compact('tipoDocumento','componente'));
    }
    public function destroy(Request $request){
        documentoComponente::destroy($request['Eliminar']); 
       $tipoDocumento = tipoDocumento::All();
       $componente = documentoComponente::DocComponentes();
       return view('tipodocumento.tipodocumento',compact('tipoDocumento','componente'));
    }
}

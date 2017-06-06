<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;

use calidad\Http\Requests;

class nombre_controlador extends Controller
{
    //crear
	public function create(Request $request){
    	
    	\calidad\crud::create([
    			'_bigint' => $request['_bigint'],
	            '_integer'=> $request['_integer'],
	            '_char' => $request['_char'],
	            '_date'=> $request['_date'],
	            '_datetime' => $request['_datetime'],
	            '_timestamp'=> $request['_timestamp'],
	            '_double'=> $request['_double'],
	            '_float' => $request['_float'],
	            '_text'=> encrypt($request['_text']),
	            '_string' => $request['_string'],
    		]);
    	
        $crud = \calidad\crud::All();
        return view('viewGuias/crud',compact('crud'));
    }
    //read
    public function index(){
    	$crud = \calidad\crud::All();
    	return view('viewGuias/crud',compact('crud'));
    }
    //modificar
    public function update(Request $request){
        
        $crud = \calidad\crud::find($request['aceptar']);
        $crud->_bigint = $request['edit_bigint'];
        $crud->_integer= $request['edit_integer'];
        $crud->_char = $request['edit_char'];
        $crud->_date= $request['edit_date'];
        $crud->_datetime = $request['edit_datetime'];
        $crud->_timestamp= $request['edit_timestamp'];
        $crud->_double= $request['edit_double'];
        $crud->_float = $request['edit_float'];
        $crud->_text= encrypt($request['edit_text']);
        $crud->_string = $request['edit_string'];
        $crud->save();
        
        $crud = \calidad\crud::All();
        return view('viewGuias/crud',compact('crud'));
    }

    public function destroy(Request $request){
    	\calidad\crud::destroy($request['eliminar']);
    	
        $crud = \calidad\crud::All();
        return view('viewGuias/crud',compact('crud'));
    }
}

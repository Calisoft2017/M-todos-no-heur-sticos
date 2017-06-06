<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;
use calidad\Http\Requests;
use Illuminate\Support\Facades\Session;

class indexController extends Controller
{
    public function actionPaginauno(Request $request){

    	if ($_POST) {
    		Session::put('miSesionTexto',($request['txtTexto']));
    		return view('ViewSesion/paginauno');
    	}
    	return view('ViewSesion/paginauno');
    }
    public function actionPaginados(){
    	return view('ViewSesion/paginados');
    }
    public function actionPaginatres(){
    	return view('ViewSesion/paginatres');
    }
    public function actionPaginacuatro(){
        return view('ViewSesion/paginacuatro');
    }
    public function actionHome(){
        return view('home');
    }

}

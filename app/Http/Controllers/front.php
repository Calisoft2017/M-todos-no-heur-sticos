<?php

namespace calidad\Http\Controllers;

use Illuminate\Http\Request;

use calidad\Http\Requests;

class front extends Controller
{
    public function index(){
    	return view("index");
    }
    public function registro(){
        return view("viewRegistro/registro");
    }
    public function guia(){
    	return view("viewGuias/guia");
    }
    public function componentes(){
        return view("viewGuias/componentes");
    }
    public function crud(){
        return view("viewGuias/crud");
    }
    public function administrador(){
        return view("viewAdministrador/administrador");
    }
    public function evaluador(){
        return view("viewEvaluador/evaluador");
    }
    public function estudiante(){
        return view("viewEstudiante/estudiante");
    }
    public function registroProyecto(){
        return view("viewRegistro/registroProyecto");
    }
    public function registroEvaluador(){
        return view("viewRegistro/registroEvaluador");
    }
    public function recuperarContrasena(){
        return view("viewRegistro/recuperarContrasena");
    }
    public function consultaUsuarios(){
        return view("viewAdministrador/consultaUsuarios");
    }
    public function consultaEvaluadores(){
        return view("viewAdministrador/consultaEvaluadores");
    }
    public function consultaPeticiones(){
        return view("viewAdministrador/consultaPeticiones");
    }
    public function consultaProyectos(){
        return view("viewAdministrador/consultaProyectos");
    }
    public function asignarEvaluador(){
        return view("viewAdministrador/asignarEvaluador");
    }
    public function configuracionPorcentajes(){
        return view("viewAdministrador/configuracionPorcentajes");
    }
    public function realizarEvaluacion(){
        return view("viewEvaluador/realizarEvaluacion");
    }
    public function evaluarModelado(){
        return view("viewEvaluador/evaluarModelado");
    }
    public function evaluarPlataforma(){
        return view("viewEvaluador/evaluarPlataforma");
    }
    public function crearCasoprueba(){
        return view("viewEvaluador/crearCasoprueba");
    }
    public function detallesCasoprueba(){
        return view("viewEvaluador/detallesCasoprueba");
    }
    public function historialPruebas(){
        return view("viewEvaluador/historialPruebas");
    }
    public function verEvaluador(){
        return view("viewEstudiante/verEvaluador");
    }
    public function subirDocumento(){
        return view("viewEstudiante/subirDocumento");
    }
    public function verEvaluacion(){
        return view("viewEstudiante/verEvaluacion");
    }
    public function evaluacionPlataforma(){
        return view("viewEstudiante/evaluacionPlataforma");
    }
    public function evaluacionModelado(){
        return view("viewEstudiante/evaluacionModelado");
    }
    public function detailsCasoprueba(){
        return view("viewEstudiante/detailsCasoprueba");
    }
    public function resultadoCasoPrueba(){
        return view("viewEstudiante/resultadoCasoPrueba");
    }
    
}

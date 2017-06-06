<?php

namespace calidad\Http\Controllers;

use Auth;
//use Session;
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

class usuarios extends Controller
{
    public function registroProyecto(){
        $categoria = \calidad\categoria::All();
        return view('viewRegistro/registroProyecto',compact('categoria')); 
    }
    public function create_proyetco(Request $request){

        try {
            $proyect = \calidad\proyecto::where('name_proyecto',$request->name_proyecto) -> first();
            $user = \calidad\usuario::where('nom_usuario',$request->nom_usuario) -> first();
            $id = \calidad\usuario::where('id_usuario',$request->id_usuario) -> first();
            $correo = \calidad\usuario::where('id_usuario',$request->correo) -> first();

            if ($request['radio-button']=="2") {
                $user2 = \calidad\usuario::where('nom_usuario',$request->nom_usuario_int2) -> first();
                $id2 = \calidad\usuario::where('id_usuario',$request->id_usuario_int2) -> first();
                $correo2 = \calidad\usuario::where('id_usuario',$request->correo_int2) -> first();
            }

            if ($request->name_proyecto == ($proyect['name_proyecto'])) {
                echo "<script type=\"text/javascript\">alert(\"". "proyecto ya existe" . "\");window.open('registroProyecto','_self');</script>";
            }
            elseif ($request->nom_usuario == ($user['nom_usuario'])) {
                echo "<script type=\"text/javascript\">alert(\"". "estudiante 1 ya existe" . "\");window.open('registroProyecto','_self');</script>";
            }
            elseif ($request->id_usuario == ($id['id_usuario'])) {
                echo "<script type=\"text/javascript\">alert(\"". "codigo estudiante 1 ya existe" . "\");window.open('registroProyecto','_self');</script>";
            }
            elseif ($request->correo== ($correo['correo'])) {
                echo "<script type=\"text/javascript\">alert(\"". "correo estudiante 1 ya existe" . "\");window.open('registroProyecto','_self');</script>";
            }
            else{
                if ($request['radio-button']=="2" and $request->nom_usuario_int2 == $request->nom_usuario) {
                    echo "<script type=\"text/javascript\">alert(\"". "estudiante 2 no puede ser igual a estudiante 1" . "\");window.open('registroProyecto','_self');</script>";
                }
                elseif ($request['radio-button']=="2" and $request->id_usuario_int2 == $request->id_usuario) {
                    echo "<script type=\"text/javascript\">alert(\"". "el codigo del estudiante 2 no puede ser igual a estudiante 1" . "\");window.open('registroProyecto','_self');</script>";
                }
                elseif ($request['radio-button']=="2" and $request->correo_int2== $request->correo) {
                    echo "<script type=\"text/javascript\">alert(\"". "el correo del estudiante 2 no puede ser igual a estudiante 1" . "\");window.open('registroProyecto','_self');</script>";
                }
                elseif ($request['radio-button']=="2" and $request->nom_usuario_int2 == ($user2['nom_usuario'])) {
                    echo "<script type=\"text/javascript\">alert(\"". "estudiante 2 ya existe" . "\");window.open('registroProyecto','_self');</script>";
                }
                elseif ($request['radio-button']=="2" and $request->id_usuario_int2 == ($id2['id_usuario'])) {
                    echo "<script type=\"text/javascript\">alert(\"". "codigo estudiante 2 ya existe" . "\");window.open('registroProyecto','_self');</script>";
                }
                elseif ($request['radio-button']=="2" and $request->correo_int2== ($correo2['correo'])) {
                    echo "<script type=\"text/javascript\">alert(\"". "correo del estudiante 2 ya existe" . "\");window.open('registroProyecto','_self');</script>";
                }
                else{
                    \calidad\proyecto::create([
                            'name_proyecto'=> $request['name_proyecto'],
                            'name_investigacion'=> $request['name_investigacion'],
                            'name_semillero'=> $request['name_semillero'],
                            'id_categoria'=> $request['id_categoria'],
                        ]);
                    
                    \calidad\usuario::create([
                            'id_usuario'=> $request['id_usuario'],
                            'id_rol'=> 3,
                            'nombre'=> $request['nombre'],
                            'apellido'=> $request['apellido'],
                            'correo'=> $request['correo'],
                            'nom_usuario'=> $request['nom_usuario'],
                            'contrasena'=> encrypt($request['contrasena']),
                            'estado'=> 'peticion',
                            'urlImagen'=> null,
                        ]);
                    
                    $proyecto = \calidad\proyecto::where('name_proyecto',$request->name_proyecto) -> first();
                    $usuario = \calidad\usuario::where('id_usuario',$request->id_usuario) -> first();

                    \calidad\integranteProyecto::create([
                            'id_proyecto'=> $proyecto['id_proyecto'],
                            'id_usuario'=> $usuario['id_usuario'],
                        ]);

                    if ($request['radio-button']=="2") {
                        \calidad\usuario::create([
                            'id_usuario'=> $request['id_usuario_int2'],
                            'id_rol'=> 3,
                            'nombre'=> $request['nombre_int2'],
                            'apellido'=> $request['apellido_int2'],
                            'correo'=> $request['correo_int2'],
                            'nom_usuario'=> $request['nom_usuario_int2'],
                            'contrasena'=> encrypt($request['contrasena_int2']),
                            'estado'=> 'peticion',
                            'urlImagen'=> null,
                        ]);

                        $proyecto = \calidad\proyecto::where('name_proyecto',$request->name_proyecto) -> first();
                        $usuario2 = \calidad\usuario::where('id_usuario',$request->id_usuario_int2) -> first();

                        \calidad\integranteProyecto::create([
                                'id_proyecto'=> $proyecto['id_proyecto'],
                                'id_usuario'=> $usuario2['id_usuario'],
                            ]);
                    }
                    echo "<script type=\"text/javascript\">alert(\"". "Proyecto registrado, al correo se le enviará la respuesta de su petición." . "\"); window.open('/','_self'); </script>";
                }
            }
        } catch (Exception $e) {
            echo "<script type=\"text/javascript\">alert(\"". "Se produjo un error, int\u00E9ntelo de nuevo" . "\"); window.open('/','_self'); </script>";
        }
        
    }

    public function create_evaluador(Request $request){
        $user = \calidad\usuario::where('nom_usuario',$request->nom_usuario) -> first();
        $id = \calidad\usuario::where('id_usuario',$request->id_usuario) -> first();

        if ($request->nom_usuario == ($user['nom_usuario'])) {
            echo "<script type=\"text/javascript\">alert(\"". "usuario ya existe" . "\");</script>";
        }
        elseif ($request->id_usuario == ($id['id_usuario'])) {
            echo "<script type=\"text/javascript\">alert(\"". "codigo ya existe" . "\");</script>";
        }
        else{
            \calidad\usuario::create([
                    'id_usuario'=> $request['id_usuario'],
                    'id_rol'=> 2,
                    'nombre'=> $request['nombre'],
                    'apellido'=> $request['apellido'],
                    'correo'=> $request['correo'],
                    'nom_usuario'=> $request['nom_usuario'],
                    'contrasena'=> encrypt($request['contrasena']),
                    'estado'=> 'peticion',
                     'urlImagen'=> '_',
                ]);
            
            echo "<script type=\"text/javascript\">alert(\"". "Evaluador registrado, al correo se le enviará la respuesta de su petición. " . "\"); window.open('/','_self');</script>";
        }
        return view('viewRegistro/registroEvaluador');
    }

    public function login_leer(loginRequest $request){

        $user = \calidad\usuario::where('nom_usuario',$request->nom_usuario) -> first();
        $id_usuario = $user['id_usuario'];
        $nombre = $user['nombre'];
        $apellido = $user['apellido'];
        $urlImagen = $user['urlImagen'];
        $estado = $user['estado'];
       
        if ($request->nom_usuario == ($user['nom_usuario'])) {
            if($estado != 'peticion'){ 
                if ($request->contrasena == decrypt($user['contrasena'])) {
                    if (($user['id_rol']) == 1) {
                        echo "
                          <script type=\""."text/javascript"."\">
                                sessionStorage['id_rol']=1;
                                sessionStorage['id_usuario']=\""."$id_usuario"."\";
                                sessionStorage['nombre']=\""."$nombre"."\";
                                sessionStorage['apellido']=\""."$apellido"."\";
                                sessionStorage['nom_usuario']= \""."$request->nom_usuario"."\";
                                sessionStorage['urlImagen']= \""."$urlImagen"."\";
                                alert(\"". "BIENVENIDO ADMINISTRADOR" . "\");
                                window.open('administrador','_self');
                          </script>";
                    }
                    elseif (($user['id_rol']) == 2) {
                        echo "
                          <script type=\""."text/javascript"."\">
                                sessionStorage['id_rol']=2;
                                sessionStorage['id_usuario']=\""."$id_usuario"."\";
                                sessionStorage['nombre']=\""."$nombre"."\";
                                sessionStorage['apellido']=\""."$apellido"."\";
                                sessionStorage['nom_usuario']= \""."$request->nom_usuario"."\";
                                sessionStorage['urlImagen']= \""."$urlImagen"."\";
                                alert(\"". "BIENVENIDO EVALUADOR" . "\");
                                window.open('evaluador','_self');
                          </script>";
                    }
                    elseif (($user['id_rol']) == 3) {
                        echo "
                          <script type=\""."text/javascript"."\">
                                sessionStorage['id_rol']=3;
                                sessionStorage['id_usuario']=\""."$id_usuario"."\";
                                sessionStorage['nombre']=\""."$nombre"."\";
                                sessionStorage['apellido']=\""."$apellido"."\";
                                sessionStorage['nom_usuario']= \""."$request->nom_usuario"."\";
                                sessionStorage['urlImagen']= \""."$urlImagen"."\";
                                alert(\"". "BIENVENIDO ESTUDIANTE" . "\");
                                window.open('estudiante','_self');
                          </script>";
                    }
                }
                else{
                    echo "<script type=\"text/javascript\">alert('contrase'+String.fromCharCode(241)+'a incorrecta');window.open('../','_self');</script>";
                }
            }
            else{
                echo "<script type=\"text/javascript\">alert(\"". "usuario no ha sido aceptado" . "\");window.open('../','_self');</script>";
            }
        }
        else{
            echo "<script type=\"text/javascript\">alert(\"". "Usuario no existe" . "\");window.open('../','_self');</script>";
        }
    
        //return $request->nom_usuario;
    }

    public function menuRol($rol){
        if ($rol == 1) { echo "<script type=\"text/javascript\">window.open('../administrador','_self');</script>"; }
        if ($rol == 2) { echo "<script type=\"text/javascript\">window.open('../evaluador','_self');</script>"; }
        if ($rol == 3) { echo "<script type=\"text/javascript\">window.open('../estudiante','_self');</script>"; }
        if ($rol == "null") { echo "<script type=\"text/javascript\">alert(\"". "inicie sesión" . "\");window.open('../','_self');</script>"; }
    }

    public function cerrarSession(){
        echo "
          <script type=\""."text/javascript"."\">
                sessionStorage['id_rol']=null;
                sessionStorage['id_usuario']=null;
                sessionStorage['nom_usuario']= null;
                sessionStorage['urlImagen']= null;
                alert(\"". "sesión cerrada" . "\");
                window.open('../','_self');
          </script>";
    }
/////////////////////////////////////////////////////////////////// consulta estudiante ///////////////////////////////////////////////////////////////////////
    public function readUsuario(){
        $estudiante = \calidad\usuario::where('id_rol',3) -> where('estado','<>','peticion') -> orderBy('id_rol') -> get();
        return view('viewAdministrador/consultaUsuarios',compact('estudiante'));
    }

    public function deleteUsuario(Request $request){
        //\calidad\usuario::destroy($request['eliminar']);  //eliminarte un dato
        $crud = \calidad\usuario::find($request['eliminar']);
        $crud->estado = 'deshabilitado';
        $crud->save();

        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        return view('viewAdministrador/consultaUsuarios',compact('estudiante'));
    }

    //modificar
    public function updateUsuario(Request $request){
        
        $crud = \calidad\usuario::find($request['aceptar']);
        $crud->nombre = $request['edit_nombre'];
        $crud->apellido= $request['edit_apellido'];
        $crud->correo = $request['edit_correo'];
        $crud->nom_usuario= $request['edit_usuario'];
        $crud->estado = $request['edit_estado'];
        $crud->save();
        
        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        return view('viewAdministrador/consultaUsuarios',compact('estudiante'));
    }
//////////////////////////////////////////////////////////// consulta evaluador /////////////////////////////////////////////////////////////////////////////////////
    public function readEvaluador(){
        $evaluador  = \calidad\usuario::where('id_rol',2) ->  where('estado','<>','peticion') -> orderBy('id_rol') -> get();
        return view('viewAdministrador/consultaEvaluadores',compact('evaluador'));
    }
    public function deleteEvaluador(Request $request){
        $crud = \calidad\usuario::find($request['eliminar']);
        $crud->estado = 'deshabilitado';
        $crud->save();

        $evaluador  = \calidad\usuario::where('id_rol',2) -> get();
        return view('viewAdministrador/consultaEvaluadores',compact('evaluador'));
    }

    public function updateEvaluador(Request $request){
        
        $crud = \calidad\usuario::find($request['aceptar']);
        $crud->nombre = $request['edit_nombre'];
        $crud->apellido= $request['edit_apellido'];
        $crud->correo = $request['edit_correo'];
        $crud->nom_usuario= $request['edit_usuario'];
        $crud->estado = $request['edit_estado'];
        $crud->save();
        
        $evaluador  = \calidad\usuario::where('id_rol',2) -> get();
        return view('viewAdministrador/consultaEvaluadores',compact('evaluador'));
    }
//////////////////////////////////////////////////////////// consulta peticion /////////////////////////////////////////////////////////////////////////////////
    public function readpeticion(){
        $proyecto = \calidad\proyecto::All();
        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        $integranteProyecto = \calidad\integranteProyecto::All();
        $peticion = \calidad\usuario::where('estado','peticion') -> get();
        $categoria = \calidad\categoria::All();
        return view('viewAdministrador/consultaPeticiones',compact('peticion','proyecto','estudiante','integranteProyecto','categoria'));
    }
    public function aceptarPeticion(Request $request){
        $user = \calidad\usuario::where('id_usuario',$request['aceptar']) -> first();
        if(count($user) > 0){
            $correo = $user['correo'];
            $contra = decrypt($user['contrasena']);

            $para = "jhoacosta93@hotmail.com";
            $asunto = "peticion de registro calisoft: ";
             
            $message = '<html><link href="../css/estilo-base.css" rel="stylesheet" type="text/css"> <body>';
            $message = '<center><div id="titulo"><h1>PLATAFORMA WEB PARA LA EVALUACI&Oacute;N DE PRODUCTOS SOFTWARE</h1></div></center>';
            $message .= '<div><h3>Petici&oacute;n de registro</h3></div>';
            $message .= '<div>Respuesta de la petici&oacute;n de registro</div>';
            $message .= '<div>Por medio de este correo se le comunica que su petici&oacute;n de registro  como evaluador a la plataforma de calidad de software <b>calisoft</b>, despu&eacute;s de verificar sus datos ha sido aceptada.</div>';
            $message .= '<div>Por favor verifique su acceso a la plataforma.</div>';
            $message .= '<br><div>Este correo es enviado autom&aacute;ticamente, por favor no contestar ya que no obtendr&aacute; respuesta.</div>';
            $message .= '<div>Gracias por usar nuestros servicios.</div>';
            $message .= '<center><div><h2>UNIVERSIDAD DE CUNDINAMARCA</h2></div></center>';
            $message .= '</body></html>';
                
                $de = "administrador@calisoft.com";

            $headers = "From: " . strip_tags($de) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($de) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if(@mail($correo,$asunto,$message,$headers)){
              }  
            else{
                echo "<script type=\"text/javascript\">alert(\"". "Fallo envio" . "\");window.open('/','_self');</script>";
                }
        }
        else{
            echo "<script type=\"text/javascript\">alert(\"". "Usuario no registrado" . "\");window.open('/','_self');</script>";
        }
        
        $crud = \calidad\usuario::find($request['aceptar']);
        $crud->estado = 'activo';
        $crud->save();

        $proyecto = \calidad\proyecto::All();
        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        $integranteProyecto = \calidad\integranteProyecto::All();
        $peticion = \calidad\usuario::where('estado','peticion') -> get();
        return view('viewAdministrador/consultaPeticiones',compact('peticion','proyecto','estudiante','integranteProyecto'));
    }
    
    public function deletePeticion(Request $request){
        $user = \calidad\usuario::where('id_usuario',$request['eliminar']) -> first();
        if(count($user) > 0){
            $correo = $user['correo'];
            $contra = decrypt($user['contrasena']);

            $para = "jhoacosta93@hotmail.com";
            $asunto = "peticion de registro calisoft: ";
             
            $message = '<html><link href="../css/estilo-base.css" rel="stylesheet" type="text/css"> <body>';
            $message = '<center><div id="titulo"><h1>PLATAFORMA WEB PARA LA EVALUACI&Oacute;N DE PRODUCTOS SOFTWARE</h1></div></center>';
            $message .= '<div><h3>Petici&oacute;n de registro</h3></div>';
            $message .= '<div>Respuesta de la petici&oacute;n de registro</div>';
            $message .= '<div>Por medio de este correo se le comunica que su petici&oacute;n de registro  como evaluador a la plataforma de calidad de software <b>calisoft</b>, despu&eacute;s de verificar sus datos no ha sido aceptada.</div>';
            $message .= '<div>La raz&oacute;n se debe a que el solicitante no tiene permisos para registrarse o los datos de registro no son v&aacute;lidos.</div>';
            $message .= '<br><div>Este correo es enviado autom&aacute;ticamente, por favor no contestar ya que no obtendr&aacute; respuesta.</div>';
            $message .= '<div>Gracias por usar nuestros servicios.</div>';
            $message .= '<center><div><h2>UNIVERSIDAD DE CUNDINAMARCA</h2></div></center>';
            $message .= '</body></html>';
                
                $de = "administrador@calisoft.com";

            $headers = "From: " . strip_tags($de) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($de) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if(@mail($correo,$asunto,$message,$headers)){
              }  
            else{
                echo "<script type=\"text/javascript\">alert(\"". "Fallo envio" . "\");window.open('/','_self');</script>";
                }
        }
        else{
            echo "<script type=\"text/javascript\">alert(\"". "Usuario no registrado" . "\");window.open('/','_self');</script>";
        }
        \calidad\usuario::destroy($request['eliminar']);

        $proyecto = \calidad\proyecto::All();
        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        $integranteProyecto = \calidad\integranteProyecto::All();
        $peticion = \calidad\usuario::where('estado','peticion') -> get();
        return view('viewAdministrador/consultaPeticiones',compact('peticion','proyecto','estudiante','integranteProyecto'));
    }

    public function aceptarPeticionProyecto(Request $request){
        $integrante = \calidad\integranteProyecto::where('id_proyecto',$request['aceptar']) -> get();
        for ($i=0; $i < count($integrante); $i++) { 
            $usuario= $integrante[$i]->id_usuario;
            
            $user = \calidad\usuario::where('id_usuario',$usuario) -> first();
            if(count($user) > 0){
                $correo = $user['correo'];
                $contra = decrypt($user['contrasena']);

                $para = "jhoacosta93@hotmail.com";
                $asunto = "peticion de registro calisoft: ";
                 
                $message = '<html><link href="../css/estilo-base.css" rel="stylesheet" type="text/css"> <body>';
                $message = '<center><div id="titulo"><h1>PLATAFORMA WEB PARA LA EVALUACI&Oacute;N DE PRODUCTOS SOFTWARE</h1></div></center>';
                $message .= '<div><h3>Petici&oacute;n de registro</h3></div>';
                $message .= '<div>Respuesta de la petici&oacute;n de registro</div>';
                $message .= '<div>Por medio de este correo se le comunica que su petici&oacute;n de registro  como proyecto a la plataforma de calidad de software <b>calisoft</b>, despu&eacute;s de verificar sus datos ha sido aceptada.</div>';
                $message .= '<div>Por favor verifique su acceso a la plataforma.</div>';
                $message .= '<br><div>Este correo es enviado autom&aacute;ticamente, por favor no contestar ya que no obtendr&aacute; respuesta.</div>';
                $message .= '<div>Gracias por usar nuestros servicios.</div>';
                $message .= '<center><div><h2>UNIVERSIDAD DE CUNDINAMARCA</h2></div></center>';
                $message .= '</body></html>';
                    
                    $de = "administrador@calisoft.com";

                $headers = "From: " . strip_tags($de) . "\r\n";
                $headers .= "Reply-To: ". strip_tags($de) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                if(@mail($correo,$asunto,$message,$headers)){
                  }  
                else{
                    echo "<script type=\"text/javascript\">alert(\"". "Fallo envio" . "\");window.open('/','_self');</script>";
                    }
            }
            else{
                echo "<script type=\"text/javascript\">alert(\"". "Usuario no registrado" . "\");window.open('/','_self');</script>";
            }
            $crud = \calidad\usuario::find($usuario);
            $crud->estado = 'activo';
            $crud->save();
        }

        $proyecto = \calidad\proyecto::All();
        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        $integranteProyecto = \calidad\integranteProyecto::All();
        $peticion = \calidad\usuario::where('estado','peticion') -> get();
        return view('viewAdministrador/consultaPeticiones',compact('peticion','proyecto','estudiante','integranteProyecto'));
    }

    public function deletePeticionProyecto(Request $request){
        $integrante = \calidad\integranteProyecto::where('id_proyecto',$request['eliminar']) -> get();
        for ($i=0; $i < count($integrante); $i++) { 
            $usuario= $integrante[$i]->id_usuario;
            $integranteProyecto= $integrante[$i]->id_integranteProyecto;

            $user = \calidad\usuario::where('id_usuario',$usuario) -> first();
            if(count($user) > 0){
                $correo = $user['correo'];
                $contra = decrypt($user['contrasena']);

                $para = "jhoacosta93@hotmail.com";
                $asunto = "peticion de registro calisoft: ";
                 
                $message = '<html><link href="../css/estilo-base.css" rel="stylesheet" type="text/css"> <body>';
                $message = '<center><div id="titulo"><h1>PLATAFORMA WEB PARA LA EVALUACI&Oacute;N DE PRODUCTOS SOFTWARE</h1></div></center>';
                $message .= '<div><h3>Petici&oacute;n de registro</h3></div>';
                $message .= '<div>Respuesta de la petici&oacute;n de registro</div>';
                $message .= '<div>Por medio de este correo se le comunica que su petici&oacute;n de registro  como proyecto a la plataforma de calidad de software <b>calisoft</b>, despu&eacute;s de verificar sus datos no ha sido aceptada.</div>';
                $message .= '<div>La raz&oacute;n se debe a que el solicitante no tiene permisos para registrarse o los datos de registro no son v&aacute;lidos.</div>';
                $message .= '<br><div>Este correo es enviado autom&aacute;ticamente, por favor no contestar ya que no obtendr&aacute; respuesta.</div>';
                $message .= '<div>Gracias por usar nuestros servicios.</div>';
                $message .= '<center><div><h2>UNIVERSIDAD DE CUNDINAMARCA</h2></div></center>';
                $message .= '</body></html>';
                    
                    $de = "administrador@calisoft.com";

                $headers = "From: " . strip_tags($de) . "\r\n";
                $headers .= "Reply-To: ". strip_tags($de) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                if(@mail($correo,$asunto,$message,$headers)){
                  }  
                else{
                    echo "<script type=\"text/javascript\">alert(\"". "Fallo envio" . "\");window.open('/','_self');</script>";
                    }
            }
            else{
                echo "<script type=\"text/javascript\">alert(\"". "Usuario no registrado" . "\");window.open('/','_self');</script>";
            }
            \calidad\usuario::destroy($usuario);
            \calidad\integranteProyecto::destroy($integranteProyecto);

        }
        \calidad\proyecto::destroy($request['eliminar']);

        $proyecto = \calidad\proyecto::All();
        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        $integranteProyecto = \calidad\integranteProyecto::All();
        $peticion = \calidad\usuario::where('estado','peticion') -> get();
        return view('viewAdministrador/consultaPeticiones',compact('peticion','proyecto','estudiante','integranteProyecto'));
    }
///////////////////////////////////////////////////////////// ver y asignar proyecto ///////////////////////////////////////////////////////////////////////////////////
    public function readProyecto(){
        $proyecto = \calidad\proyecto::All();
        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        $evaluador = \calidad\usuario::where('id_rol',2) -> get();
        $integranteProyecto = \calidad\integranteProyecto::All();
        $proyectoAsignado = \calidad\proyectoAsignado::All();
        $categoria = \calidad\categoria::All();
        return view('viewAdministrador/consultaProyectos',compact('proyecto','estudiante','evaluador','integranteProyecto','proyectoAsignado','categoria'));
    }

    public function leerEvaluador(Request $request){
        $id_proyecto = ($request['aceptar']);
        $evaluador  = \calidad\usuario::where('id_rol',2)->where('estado', '<>','peticion') -> get();
        $proyectoAsignado = \calidad\proyectoAsignado::where('id_proyecto', $id_proyecto) -> get();
        return view('viewAdministrador/asignarEvaluador',compact('evaluador','id_proyecto','proyectoAsignado'));
    }

    public function aceptarAsignacion(Request $request){
        \calidad\proyectoAsignado::create([
                'id_usuario'=> $request['aceptar'],
                'id_proyecto'=> $request['id_proyecto'],
            ]);
        
        $usuario = \calidad\usuario::find($request['aceptar']);
        $usuario->estado = 'activo';
        $usuario->save();

        echo "<script type=\"text/javascript\">alert(\"". "Evaluador asignado" . "\");window.open('consultaProyectos','_self');</script>";
    }
    public function desasignar(Request $request){
        
        $proyectoAsignado = \calidad\proyectoAsignado::where('id_proyecto', $request['id_proyecto']) -> where('id_usuario', $request['eliminar']) -> first();
        \calidad\proyectoAsignado::destroy($proyectoAsignado->id_proyectoAsignado);

        echo "<script type=\"text/javascript\">alert(\"". "Evaluador desasignado" . "\");window.open('consultaProyectos','_self');</script>";
    }
///////////////////////////////////////////////////////////// configuracion de porcentajes ////////////////////////////////////////////////////////////////////////////////

    public function configuracionPorcentajes(Request $request){
        $porcentajes = \calidad\configPorcentaje::All();
        $categoria = \calidad\categoria::All();
        return view('viewAdministrador/configuracionPorcentajes',compact('porcentajes','categoria')); 
    }
    public function actualizarPorcentaje(Request $request){
    
            $crud = \calidad\categoria::find($request['id_categoria']);
            $crud->porcPlataforma = $request['porcPlataforma'];
            $crud->porcModelado = $request['porcModelado'];
            $crud->save();

            $porcentajes = \calidad\configPorcentaje::All();
            $categoria = \calidad\categoria::All();
            return view('viewAdministrador/configuracionPorcentajes',compact('porcentajes','categoria')); 
        
    }
    public function actualizarPrioridad(Request $request){

        try {
            $crud = \calidad\categoria::find($request['id_categoria']);
            $crud->prioridadAlta = $request['prioridadAlta'];
            $crud->prioridadMedia = $request['prioridadMedia'];
            $crud->prioridadBaja = $request['prioridadBaja'];
            $crud->save();

        $porcentajes = \calidad\configPorcentaje::All();
        $categoria = \calidad\categoria::All();
        return view('viewAdministrador/configuracionPorcentajes',compact('porcentajes','categoria')); 
        } catch (Exception $e) {
            echo "<script type=\"text/javascript\">alert(\"". "Se produjo un error, int\u00E9ntelo de nuevo" . "\"); window.open('/','_self'); </script>";
        }
    }
    public function actualizarModelo(Request $request){

        try {
            $usuario = \calidad\categoria::find($request['id_categoria']);
            $usuario->dClases = $request['dClases'];
            $usuario->dCasos = $request['dCasos'];
            $usuario->dDespliegue = $request['dDespliegue'];
            $usuario->dSecuencias = $request['dSecuencias'];
            $usuario->dActividades = $request['dActividades'];
            $usuario->MER = $request['MER'];
            $usuario->save();

        $porcentajes = \calidad\configPorcentaje::All();
        $categoria = \calidad\categoria::All();
        return view('viewAdministrador/configuracionPorcentajes',compact('porcentajes','categoria')); 
        } catch (Exception $e) {
            echo "<script type=\"text/javascript\">alert(\"". "Se produjo un error, int\u00E9ntelo de nuevo" . "\"); window.open('/','_self'); </script>";
        }
    }
/////////////////////////////////////////////////////////////////  categorizacion  //////////////////////////////////////////////////////////////////////////////////////////////
    
    public function categorizacion(Request $request){
        $categoria = \calidad\categoria::All();
        return view('viewAdministrador/categorizacion',compact('categoria'));
    }
    public function crearCategoria(Request $request){
        \calidad\categoria::create([
                'name_categoria'=> $request['name_categoria'],
                'porcPlataforma'=> $request['porcPlataforma'],
                'porcModelado'=> $request['porcModelado'],
                'prioridadAlta'=> $request['prioridadAlta'],
                'prioridadMedia'=> $request['prioridadMedia'],
                'prioridadBaja'=> $request['prioridadBaja'],
                'dClases'=> $request['dClases'],
                'dCasos'=> $request['dCasos'],
                'dDespliegue'=> $request['dDespliegue'],
                'dSecuencias'=> $request['dSecuencias'],
                'dActividades'=> $request['dActividades'],
                'MER'=> $request['MER'],
            ]);

        $categoria = \calidad\categoria::All();
        return view('viewAdministrador/categorizacion',compact('categoria'));
    }
/////////////////////////////////////////////////////////////////  ver datos admi  //////////////////////////////////////////////////////////////////////////////////////////////
    
    public function datosAdministrador(){
        $administrador = \calidad\usuario::where('id_usuario',1) -> get();
        return view('viewAdministrador/datosAdministrador',compact('administrador'));
    }

    public function actualizarDatosAdmi(Request $request){
        $correo = \calidad\usuario::where('correo',$request['edit_correo']) ->where('id_usuario','<>',1) -> get();
        if (count($correo) > 0) {
            echo "<script type=\"text/javascript\">alert(\"". "correo ya existe" . "\");window.open('administrador','_self');</script>";
        }
        else{
            $crud = \calidad\usuario::find($request['id_evaluador']);
            $crud->correo= $request['edit_correo'];
            $crud->save();

        $administrador = \calidad\usuario::where('id_usuario',1) -> get();
        return view('viewAdministrador/datosAdministrador',compact('administrador'));
        }
    }

    public function guardarClaveAdmi(Request $request){
        $evaluador = \calidad\usuario::where('id_usuario',1) -> first();
        if (decrypt($evaluador->contrasena) == ($request->password_usuario)) {
            if ($request->new_password == $request->repeat_new_password) {

                $crud = \calidad\usuario::find(1);
                $crud->contrasena = encrypt($request->new_password);
                $crud->save();
                
                $administrador = \calidad\usuario::where('id_usuario',1) -> get();
                return view('viewAdministrador/datosAdministrador',compact('administrador'));
            }
            else{
                echo "<script type=\"text/javascript\">alert(\"". "clave diferentes" . "\");window.open('administrador','_self');</script>";
            }
        }
        else{
            echo "<script type=\"text/javascript\">alert(\"". "clave incorrecta" . "\");window.open('administrador','_self');</script>";
        }
    }
    public function guardarImagenAdmi(Request $request){
        $mensaje = "";
    
        $file = $request->file('archivo_imagen');
        $nombre = $file->getClientOriginalName();
        $day = Carbon::now()->day.Carbon::now()->month.Carbon::now()->year.Carbon::now()->minute.Carbon::now()->second;
  
        
          if ($_FILES['archivo_imagen']['size']/1024 > '10000'){ //10MB
            $mensaje = 'Tamaño del archivo mayor de 10 MB';
          }else{
            $crud = \calidad\usuario::find($request['id_evaluador']);
            $crud->urlImagen = $day.$nombre;
            $crud->save();
            \Storage::disk('imagen')->put($day.$nombre,\File::get($file));
         }
       
        $administrador = \calidad\usuario::where('id_usuario',1) -> get();
        return view('viewAdministrador/datosAdministrador',compact('administrador'));
    }
/////////////////////////////////////////////////////////////////  ver datos eva  //////////////////////////////////////////////////////////////////////////////////////////////
    
    public function datosEvaluador(Request $request){
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador']) -> get();
        return view('viewEvaluador/datosEvaluador',compact('evaluador'));
    }
    public function guardarClave(Request $request){
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador']) -> first();
        if (decrypt($evaluador->contrasena) == ($request->password_usuario)) {
            if ($request->new_password == $request->repeat_new_password) {

                $crud = \calidad\usuario::find($request['id_evaluador']);
                $crud->contrasena = encrypt($request->new_password);
                $crud->save();
                $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador']) -> get();
                return view('viewEvaluador/datosEvaluador',compact('evaluador'));
            }
            else{
                echo "<script type=\"text/javascript\">alert(\"". "clave diferentes" . "\");window.open('evaluador','_self');</script>";
            }
        }
        else{
            echo "<script type=\"text/javascript\">alert(\"". "clave incorrecta" . "\");window.open('evaluador','_self');</script>";
        }
    }

    public function actualizarDatos(Request $request){
        $correo = \calidad\usuario::where('correo',$request['edit_correo']) ->where('id_usuario','<>',$request['id_evaluador']) -> get();
        if (count($correo) > 0) {
            echo "<script type=\"text/javascript\">alert(\"". "correo ya existe" . "\");window.open('evaluador','_self');</script>";
        }
        else{
            $crud = \calidad\usuario::find($request['id_evaluador']);
            $crud->nombre = $request['edit_nombre'];
            $crud->apellido= $request['edit_apellido'];
            $crud->correo= $request['edit_correo'];
            $crud->save();

            $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador']) -> get();
            return view('viewEvaluador/datosEvaluador',compact('evaluador'));
        }
    }

    public function guardarImagen(Request $request){
        $mensaje = "";
    
        $file = $request->file('archivo_imagen');
        $nombre = $file->getClientOriginalName();
        $day = Carbon::now()->day.Carbon::now()->month.Carbon::now()->year.Carbon::now()->minute.Carbon::now()->second;
  
        
          if ($_FILES['archivo_imagen']['size']/1024 > '10000'){ //10MB
            $mensaje = 'Tama�0�9o del archivo mayor de 10 MB';
          }else{
            $crud = \calidad\usuario::find($request['id_evaluador']);
            $crud->urlImagen = $day.$nombre;
            $crud->save();
            \Storage::disk('imagen')->put($day.$nombre,\File::get($file));
         }
       
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador']) -> get();
        return view('viewEvaluador/datosEvaluador',compact('evaluador'));
    }
    ///////////////////////////////////////////////////////////////////// ver datos est  //////////////////////////////////////////////////////////////////////////////
    
    public function datosEstudiante(Request $request){
        $estudiante = \calidad\usuario::where('id_usuario',$request['id_estudiante']) -> get();
        return view('viewEstudiante/datosEstudiante',compact('estudiante'));
    }

    public function guardarClaveEst(Request $request){
        $estudiante = \calidad\usuario::where('id_usuario',$request['id_estudiante']) -> first();
        if (decrypt($estudiante->contrasena) == ($request->password_usuario)) {
            if ($request->new_password == $request->repeat_new_password) {

                $crud = \calidad\usuario::find($request['id_estudiante']);
                $crud->contrasena = encrypt($request->new_password);
                $crud->save();
        $estudiante = \calidad\usuario::where('id_usuario',$request['id_estudiante']) -> get();
        return view('viewEstudiante/datosEstudiante',compact('estudiante'));
            }
            else{
                echo "<script type=\"text/javascript\">alert(\"". "clave diferentes" . "\");window.open('estudiante','_self');</script>";
            }
        }
        else{
            echo "<script type=\"text/javascript\">alert(\"". "clave incorrecta1" . "\");window.open('estudiante','_self');</script>";
        }
    }

    public function actualizarDatosEst(Request $request){

        $correo = \calidad\usuario::where('correo',$request['edit_correo']) -> where('id_usuario','<>',$request['id_estudiante']) -> get();
        if (count($correo) > 0) {
            echo "<script type=\"text/javascript\">alert(\"". "correo ya existe" . "\");window.open('evaluador','_self');</script>";
        }
        else{
                $crud = \calidad\usuario::find($request['id_estudiante']);
            $crud->nombre = $request['edit_nombre'];
            $crud->apellido= $request['edit_apellido'];
                $crud->correo= $request['edit_correo'];
            $crud->save();
    
            $estudiante = \calidad\usuario::where('id_usuario',$request['id_estudiante']) -> get();
            return view('viewEstudiante/datosEstudiante',compact('estudiante'));
        }

    }
    
    public function guardarImagenEst(Request $request){
        $mensaje = "";
    
        $file = $request->file('archivo_imagen');
        $nombre = $file->getClientOriginalName();
        $day = Carbon::now()->day.Carbon::now()->month.Carbon::now()->year.Carbon::now()->minute.Carbon::now()->second;
  
          if ($_FILES['archivo_imagen']['size']/1024 > '10000'){ //10MB
            $mensaje = 'Tamaño del archivo mayor de 10 MB';
            echo($mensaje);
          }else{
            $crud = \calidad\usuario::find($request['id_estudiante']);
            $crud->urlImagen = $day.$nombre;
            $crud->save();
          \Storage::disk('imagen')->put($day.$nombre,\File::get($file));
     
         }
       
        $estudiante = \calidad\usuario::where('id_usuario',$request['id_estudiante']) -> get();
        return view('viewEstudiante/datosEstudiante',compact('estudiante'));
    }

    ///////////////////////////////////////////////////////////////////// evaluar proyecto  //////////////////////////////////////////////////////////////////////////////

    public function proyectosEvaluador(Request $request){
        $proyecto = \calidad\proyecto::All();
        $estudiante = \calidad\usuario::where('id_rol',3) -> get();
        $id_evaluador = $request['id_usuario'];
        $integranteProyecto = \calidad\integranteProyecto::All();
        $proyectoAsignado = \calidad\proyectoAsignado::All();
        $categoria = \calidad\categoria::All();
        return view('viewEvaluador/verProyectos',compact('proyecto','estudiante','id_evaluador','integranteProyecto','proyectoAsignado','categoria'));
    }

    public function readCasoPrueba(Request $request){
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();
     
        return view('viewEvaluador/evaluarPlataforma',compact('casoPrueba'));
    }
    
    public function createCasoPrueba(Request $request){
        $caso = \calidad\casoPrueba::create([
                'name_casoPrueba' => $request['name_casoPrueba'],
                'proposito'=> $request['proposito'],
                'objetivo' => $request['objetivo'],
                'alcance'=> $request['alcance'],
                'resultadoEsperado' => $request['resultadosEsperados'],
                'criteriosEvaluacion' => $request['criterios'],
                'prioridad' => $request['prioridad'],
                'fecha_limite'=> $request['fecha_limite'],
                'txt'=> "_",
                'observacionEstudiante' => "_",
                'conclucion'=> "_",
                'estado' => "cargar",
                'entrega'=> 1,
            ]);

        \calidad\proyectoCasoPrueba::create([
                'id_proyecto' => $request['id_proyecto'],
                'id_casoPrueba'=>  $caso->id_casoPrueba,
                'id_usuario'=>  $request['id_usuario'],
            ]);

        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();
     
        return view('viewEvaluador/evaluarPlataforma',compact('casoPrueba'));
    }

    public function detallesCasoprueba(Request $request){
        $casoPrueba = \calidad\casoPrueba::where('id_casoPrueba',($request['caso'])) -> get();
        return view('viewEvaluador/detallesCasoprueba',compact('casoPrueba'));
    }
    
    public function historialPruebas(Request $request){
        $casoPrueba = \calidad\casoPrueba::where('id_casoPrueba',($request['caso'])) -> get();

        $pruebas = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',$request['caso'])
            ->Where('entregaPrueba.estado', '!=', 'sin calificar')
            ->select('entregaPrueba.observacion','entregaPrueba.estado','entregaPrueba.id_prueba', 'prueba.name_Prueba')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        return view('viewEvaluador/historialPruebas',compact('casoPrueba','pruebas'));
    }
    public function terminarEvaluacion(Request $request){
        $crud = \calidad\casoPrueba::find($request['caso']);
            $crud->estado = "terminado";
            $crud->entrega = $crud->entrega + 1;
            $crud->save();

        $casoPrueba = \calidad\casoPrueba::where('id_casoPrueba',($request['caso'])) -> get();


        return view('viewEvaluador/detallesCasoprueba',compact('casoPrueba'));
    }
    public function nuevaEvaluacion(Request $request){
        $crud = \calidad\casoPrueba::find($request['caso']);
            $crud->estado = "cargar";
            $crud->save();

        $pruebas = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',($request['caso']))
            ->select('entregaPrueba.id_entregaPrueba','prueba.*')
            ->orderBy('prueba.id_prueba', 'asc')-> get();


        foreach ($pruebas as $prueba) { 
            \calidad\entregaPrueba::create([
                'id_prueba' => $prueba->id_prueba,
                'n_entrega'=> $crud->entrega,
                'estado'=> 'sin calificar',
                'observacion' => 'sin calificar',
            ]);
        }
        $casoPrueba = \calidad\casoPrueba::where('id_casoPrueba',($request['caso'])) -> get();

        return view('viewEvaluador/detallesCasoprueba',compact('casoPrueba'));
    }
    public function modificarCasoprueba(Request $request){
            $crud = \calidad\casoPrueba::find($request['caso']);
            $crud->name_casoPrueba = $request['name_casoPrueba'];
            $crud->proposito = $request['proposito'];
            $crud->objetivo = $request['objetivo'];
            $crud->alcance = $request['alcance'];
            $crud->resultadoEsperado = $request['resultadosEsperados'];
            $crud->prioridad = $request['prioridad'];
            $crud->save();

        $casoPrueba = \calidad\casoPrueba::where('id_casoPrueba',($request['caso'])) -> get();
        return view('viewEvaluador/detallesCasoprueba',compact('casoPrueba'));
    }
//////////////////////////////////////////////////////////// reportes ////////////////////////////////////////////////////////////////////////////////////////////////////
    public function reporte_generalEva_ejemplo(Request $request){
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
        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();
        return view('pdf.reporte_generalEva',compact('casoPrueba','pruebas', 'date','proyecto','evaluador','reporte','cantidad_comp'));
    }

    public function reporte_generalEva_graficos($tipo, Request $request){

        $data1 = $request['archivo_imagen1'];

        $base64_str = $data1;
        $image = base64_decode($base64_str);

        list($type, $data1) = explode(';', $data1);
        list(, $data1)      = explode(',', $data1);
        $data1 = base64_decode($data1);
        file_put_contents('img/a.png', $data1);

        $data2 = $request['archivo_imagen2'];

        $base64_str = $data2;
        $image = base64_decode($base64_str);

        list($type, $data2) = explode(';', $data2);
        list(, $data2)      = explode(',', $data2);
        $data2 = base64_decode($data2);
        file_put_contents('img/b.png', $data2);

        $data3 = $request['archivo_imagen3'];

        $base64_str = $data3;
        $image = base64_decode($base64_str);

        list($type, $data3) = explode(';', $data3);
        list(, $data3)      = explode(',', $data3);
        $data3 = base64_decode($data3);
        file_put_contents('img/c.png', $data3);

        $vistaurl="pdf.reporte_generalEva";
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto2'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario2'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        $proyecto = \calidad\proyecto::where('id_proyecto',$request['id_proyecto2']) -> get();
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_usuario2']) -> get();


        $reporte = EvaluarDocumentos::Reporte();
        $cantidad_comp = EvaluarDocumentos::Cantidad_Comp();
        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('casoPrueba','pruebas', 'date','proyecto','evaluador','reporte','cantidad_comp'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        //unlink(public_path('img/t.png'));

        if($tipo==1){return $pdf->stream("verReporteFinal-");}
        if($tipo==2){return $pdf->download('reporteFinal.pdf'); }
    }
    
    public function reporte_generalEva($tipo, Request $request){
    if($tipo==1){
        $vistaurl="pdf.reporte_generalEva";
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto2'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario2'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        $proyecto = \calidad\proyecto::where('id_proyecto',$request['id_proyecto2']) -> get();
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_usuario2']) -> get();

        $documentosproyecto = \calidad\documentosProyecto::DocProyecto($request['id_proyecto2']);
        $componente = \calidad\documentoComponente::All();
        $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_usuario2'],$request['id_proyecto2']);
        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('casoPrueba','pruebas','date','proyecto','evaluador','documentosproyecto','componente','evaluacion'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
       return $pdf->stream("verReporteFinal-");
   }
    if($tipo==2){
        $vistaurl="pdf.reporte_generalEva";
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto4'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario4'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        $proyecto = \calidad\proyecto::where('id_proyecto',$request['id_proyecto4']) -> get();
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_usuario4']) -> get();

        $documentosproyecto = \calidad\documentosProyecto::DocProyecto($request['id_proyecto4']);
        $componente = \calidad\documentoComponente::All();
        $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_usuario4'],$request['id_proyecto4']);
        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('casoPrueba','pruebas','date','proyecto','evaluador','documentosproyecto','componente','evaluacion'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('reporteFinal.pdf'); 
    }
    }
    public function reporte_generalEst($tipo, Request $request){
    if($tipo==1){
        $vistaurl="pdf.reporte_generalEst";
        $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario2']) ->get();
        foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }

        $estudiante = \calidad\usuario::where('id_usuario',$request['id_usuario2']) -> get();
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador2']) -> get();
        $proyecto = \calidad\proyecto::where('id_proyecto',$id_proyecto) -> get();
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$id_proyecto)
            ->where('proyectoCasoPrueba.id_usuario',$request['id_evaluador2'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();


        $documentosproyecto = \calidad\documentosProyecto::DocProyecto($id_proyecto);
        $componente = \calidad\documentoComponente::All();
        $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_evaluador2'],$id_proyecto);
        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl,compact('casoPrueba','pruebas','date','proyecto','evaluador','documentosproyecto','componente','evaluacion','estudiante'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        return $pdf->stream("verReporteFinal-");
    }
    if($tipo==2){
        $vistaurl="pdf.reporte_generalEst";
        $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario3']) ->get();
        foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }

        $estudiante = \calidad\usuario::where('id_usuario',$request['id_usuario3']) -> get();
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador3']) -> get();
        $proyecto = \calidad\proyecto::where('id_proyecto',$id_proyecto) -> get();
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$id_proyecto)
            ->where('proyectoCasoPrueba.id_usuario',$request['id_evaluador3'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();


        $documentosproyecto = \calidad\documentosProyecto::DocProyecto($id_proyecto);
        $componente = \calidad\documentoComponente::All();
        $evaluacion = \calidad\evaluarDocumentos::EvalDocReporte($request['id_evaluador3'],$id_proyecto);
        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl,compact('casoPrueba','pruebas','date','proyecto','evaluador','documentosproyecto','componente','evaluacion','estudiante'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('reporteFinal.pdf'); 
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
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_usuario2']) -> get();
        $proyecto = \calidad\proyecto::where('id_proyecto',$request['id_proyecto2']) -> get();
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$request['id_proyecto2'])
            ->where('proyectoCasoPrueba.id_usuario',$request['id_usuario2'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('casoPrueba','pruebas', 'date','proyecto','evaluador'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream("verReporteGestionPruebas-");}
        if($tipo==2){return $pdf->download('reporteGestionPruebas.pdf'); }
    }

    public function reporte_gestionEst($tipo, Request $request){
        $vistaurl="pdf.reporte_gestionEst";
        $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario2']) ->get();
        foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }

        $estudiante = \calidad\usuario::where('id_usuario',$request['id_usuario2']) -> get();
        $evaluador = \calidad\usuario::where('id_usuario',$request['id_evaluador2']) -> get();
        $proyecto = \calidad\proyecto::where('id_proyecto',$id_proyecto) -> get();

        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$id_proyecto)
            ->where('proyectoCasoPrueba.id_usuario',$request['id_evaluador2'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        $pruebas = \calidad\prueba::orderBy('id_prueba', 'asc')->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('casoPrueba','pruebas', 'date','proyecto','evaluador','estudiante'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream("verReporteGestionPruebas-");}
        if($tipo==2){return $pdf->download('reporteGestionPruebas.pdf'); }
    }
////////////////////////////////////////////////////////////  escenario caso de prueba  ////////////////////////////////////////////////////////////////////////////
    public function escenarioCasoprueba(Request $request){
        $elementos = \calidad\casoPrueba::where('id_casoPrueba',($request['id_casoPrueba'])) -> get();//id_casoPrueba
        $crud = \calidad\casoPrueba::find($request['id_casoPrueba']);
        $pruebas_funcionales = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba.n_entrega', $crud->entrega)
            ->select('entregaPrueba.id_entregaPrueba','prueba.*')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        $pruebas_carga = \calidad\prueba_carga
            ::join('entregaPrueba_carga', 'entregaPrueba_carga.id_prueba_carga', '=', 'prueba_carga.id_prueba_carga')
            ->where('prueba_carga.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba_carga.n_entrega', $crud->entrega)
            ->select('entregaPrueba_carga.id_entregaPrueba_carga','prueba_carga.*')
            ->orderBy('prueba_carga.id_prueba_carga', 'asc')-> get();


        return view('viewEvaluador/escenarioCasoprueba',compact('elementos','pruebas_funcionales','pruebas_carga'));
    }
    public function createPrueba(Request $request){

        \calidad\prueba::create([
                'id_casoPrueba' => $request['id_casoPrueba'],
                'name_Prueba' => $request['name'],
            ]);

        $id_prueba = \calidad\prueba::where('name_Prueba',$request['name']) -> orderBy('id_prueba','des') ->first();
        \calidad\entregaPrueba::create([
                'id_prueba' => $id_prueba->id_prueba,
                'n_entrega'=> $request['entrega'],
                'estado'=> 'sin calificar',
                'observacion' => 'sin calificar',
            ]);
            
        $elementos = \calidad\casoPrueba::where('id_casoPrueba',($request['id_casoPrueba'])) -> get();//id_casoPrueba
        $crud = \calidad\casoPrueba::find($request['id_casoPrueba']);
        $pruebas_funcionales = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba.n_entrega', $crud->entrega)
            ->select('entregaPrueba.id_entregaPrueba','prueba.*')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        $pruebas_carga = \calidad\prueba_carga
            ::join('entregaPrueba_carga', 'entregaPrueba_carga.id_prueba_carga', '=', 'prueba_carga.id_prueba_carga')
            ->where('prueba_carga.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba_carga.n_entrega', $crud->entrega)
            ->select('entregaPrueba_carga.id_entregaPrueba_carga','prueba_carga.*')
            ->orderBy('prueba_carga.id_prueba_carga', 'asc')-> get();


        return view('viewEvaluador/escenarioCasoprueba',compact('elementos','pruebas_funcionales','pruebas_carga'));
    }
    public function createPruebaCarga(Request $request){

        \calidad\prueba_carga::create([
                'id_casoPrueba' => $request['id_casoPruebaCarga'],
                'usuarios' => $request['usuarios'],
            ]);

        $id_prueba = \calidad\prueba_carga::where('usuarios',$request['usuarios']) -> orderBy('id_prueba_carga','des') ->first();
        \calidad\entregaPrueba_carga::create([
                'id_prueba_carga' => $id_prueba->id_prueba_carga,
                'n_entrega'=> $request['entrega'],
                'estado'=> 'sin calificar',
                'observacion' => 'sin calificar',
            ]);

        $elementos = \calidad\casoPrueba::where('id_casoPrueba',($request['id_casoPruebaCarga'])) -> get();//id_casoPrueba
       $crud = \calidad\casoPrueba::find($request['id_casoPruebaCarga']);
        $pruebas_funcionales = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',($request['id_casoPruebaCarga']))
            ->where('entregaPrueba.n_entrega', $crud->entrega)
            ->select('entregaPrueba.id_entregaPrueba','prueba.*')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        $pruebas_carga = \calidad\prueba_carga
            ::join('entregaPrueba_carga', 'entregaPrueba_carga.id_prueba_carga', '=', 'prueba_carga.id_prueba_carga')
            ->where('prueba_carga.id_casoPrueba',($request['id_casoPruebaCarga']))
            ->where('entregaPrueba_carga.n_entrega', $crud->entrega)
            ->select('entregaPrueba_carga.id_entregaPrueba_carga','prueba_carga.*')
            ->orderBy('prueba_carga.id_prueba_carga', 'asc')-> get();


        return view('viewEvaluador/escenarioCasoprueba',compact('elementos','pruebas_funcionales','pruebas_carga'));
    }
    public function deletePrueba1(Request $request){

        \calidad\prueba::destroy($request['eliminar']);
        \calidad\entregaPrueba::destroy($request['id_entregaPrueba']);
        
        
        $elementos = \calidad\casoPrueba::where('id_casoPrueba',($request['id_casoPrueba'])) -> get();//id_casoPrueba
        $crud = \calidad\casoPrueba::find($request['id_casoPrueba']);
        $pruebas_funcionales = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba.n_entrega', $crud->entrega)
            ->select('entregaPrueba.id_entregaPrueba','prueba.*')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        $pruebas_carga = \calidad\prueba_carga
            ::join('entregaPrueba_carga', 'entregaPrueba_carga.id_prueba_carga', '=', 'prueba_carga.id_prueba_carga')
            ->where('prueba_carga.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba_carga.n_entrega', $crud->entrega)
            ->select('entregaPrueba_carga.id_entregaPrueba_carga','prueba_carga.*')
            ->orderBy('prueba_carga.id_prueba_carga', 'asc')-> get();


        return view('viewEvaluador/escenarioCasoprueba',compact('elementos','pruebas_funcionales','pruebas_carga'));
    }
    public function deletePrueba2(Request $request){

        \calidad\entregaPrueba::destroy($request['id_entregaPrueba']);
        
        $elementos = \calidad\casoPrueba::where('id_casoPrueba',($request['id_casoPrueba'])) -> get();//id_casoPrueba
        $crud = \calidad\casoPrueba::find($request['id_casoPrueba']);
        $pruebas_funcionales = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba.n_entrega', $crud->entrega)
            ->select('entregaPrueba.id_entregaPrueba','prueba.*')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        $pruebas_carga = \calidad\prueba_carga
            ::join('entregaPrueba_carga', 'entregaPrueba_carga.id_prueba_carga', '=', 'prueba_carga.id_prueba_carga')
            ->where('prueba_carga.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba_carga.n_entrega', $crud->entrega)
            ->select('entregaPrueba_carga.id_entregaPrueba_carga','prueba_carga.*')
            ->orderBy('prueba_carga.id_prueba_carga', 'asc')-> get();


        return view('viewEvaluador/escenarioCasoprueba',compact('elementos','pruebas_funcionales','pruebas_carga'));
    }
    public function deletePruebaCarga1(Request $request){

        \calidad\prueba_carga::destroy($request['eliminar']);
        \calidad\entregaPrueba_carga::destroy($request['id_entregaPrueba']);
        
        
        $elementos = \calidad\casoPrueba::where('id_casoPrueba',($request['id_casoPrueba'])) -> get();//id_casoPrueba
        $crud = \calidad\casoPrueba::find($request['id_casoPrueba']);
        $pruebas_funcionales = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba.n_entrega', $crud->entrega)
            ->select('entregaPrueba.id_entregaPrueba','prueba.*')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        $pruebas_carga = \calidad\prueba_carga
            ::join('entregaPrueba_carga', 'entregaPrueba_carga.id_prueba_carga', '=', 'prueba_carga.id_prueba_carga')
            ->where('prueba_carga.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba_carga.n_entrega', $crud->entrega)
            ->select('entregaPrueba_carga.id_entregaPrueba_carga','prueba_carga.*')
            ->orderBy('prueba_carga.id_prueba_carga', 'asc')-> get();


        return view('viewEvaluador/escenarioCasoprueba',compact('elementos','pruebas_funcionales','pruebas_carga'));
    }
    public function deletePruebaCarga2(Request $request){

        \calidad\entregaPrueba_carga::destroy($request['id_entregaPrueba']);
        
        $elementos = \calidad\casoPrueba::where('id_casoPrueba',($request['id_casoPrueba'])) -> get();//id_casoPrueba
        $crud = \calidad\casoPrueba::find($request['id_casoPrueba']);
        $pruebas_funcionales = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba.n_entrega', $crud->entrega)
            ->select('entregaPrueba.id_entregaPrueba','prueba.*')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        $pruebas_carga = \calidad\prueba_carga
            ::join('entregaPrueba_carga', 'entregaPrueba_carga.id_prueba_carga', '=', 'prueba_carga.id_prueba_carga')
            ->where('prueba_carga.id_casoPrueba',($request['id_casoPrueba']))
            ->where('entregaPrueba_carga.n_entrega', $crud->entrega)
            ->select('entregaPrueba_carga.id_entregaPrueba_carga','prueba_carga.*')
            ->orderBy('prueba_carga.id_prueba_carga', 'asc')-> get();


        return view('viewEvaluador/escenarioCasoprueba',compact('elementos','pruebas_funcionales','pruebas_carga'));
    }
    public function calificarPrueba(Request $request){

        $prueba = \calidad\entregaPrueba::find($request['id2']);
        $prueba->estado = $request['estado2'];
        $prueba->observacion= $request['observaciones2'];
        $prueba->save();

        echo "<script type=\"text/javascript\">alert(\"". "La calificación se ha guardado correctamente!!" . "\");window.open('/escenarioCasoprueba','_self');</script>";
    }
    public function calificarPruebaCarga(Request $request){
        $prueba = \calidad\entregaPrueba_carga::find($request['id2']);
        $prueba->estado = $request['estado2'];
        $prueba->observacion= $request['observaciones2'];
        $prueba->tiempos= $request['tiempos2'];
        $prueba->usuarios_realizados= $request['usuarios_realizados2'];
        $prueba->save();

        echo "<script type=\"text/javascript\">alert(\"". "La calificación se ha guardado correctamente!!" . "\");window.open('escenarioCasoprueba','_self');</script>";
    }
    public function verPrueba(Request $request){
        $prueba = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('entregaPrueba.id_entregaPrueba',$request['verPrueba'])
            ->select('entregaPrueba.id_entregaPrueba','entregaPrueba.observacion','entregaPrueba.estado','entregaPrueba.id_prueba', 'prueba.name_Prueba')
            ->orderBy('prueba.id_prueba', 'asc')-> get();


        return $prueba;
    }
    public function verPruebaCarga(Request $request){
        $prueba = \calidad\prueba_carga
            ::join('entregaPrueba_carga', 'entregaPrueba_carga.id_prueba_carga', '=', 'prueba_carga.id_prueba_carga')
            ->where('entregaPrueba_carga.id_entregaPrueba_carga',$request['verPrueba'])
            ->select('entregaPrueba_carga.id_entregaPrueba_carga','entregaPrueba_carga.observacion','entregaPrueba_carga.estado','entregaPrueba_carga.id_prueba_carga', 'prueba_carga.usuarios')
            ->orderBy('prueba_carga.id_prueba_carga', 'asc')-> get();


        return $prueba;
    }
    public function p_funcionales(){
        return view("viewEvaluador/pruebas_funcionales");
    }
    public function guardarPrueba(Request $request){

        $casoPrueba = \calidad\casoPrueba::find($request['enviar']);
        $casoPrueba->txt = $request['prueba'];
        $casoPrueba->observacionEstudiante = $request['observaciones'];
        $casoPrueba->estado = "evaluar";
        
        $casoPrueba->save();

        echo "<script type=\"text/javascript\">alert(\"". "El archivo se ha guardado correctamente!!" . "\");window.open('verEvaluacion','_self');</script>";
    }

////////////////////////////////////////////////////////////////// ver proyecto //////////////////////////////////////////////////////////////////////
    public function verEvaluador(Request $request){
        $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario']) ->get();
        foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }
        $evaluador = \calidad\usuario
            ::join('proyectoAsignado', 'proyectoAsignado.id_usuario', '=', 'usuario.id_usuario')
            ->where('proyectoAsignado.id_proyecto',$id_proyecto)
            ->select('usuario.*','proyectoAsignado.*')
            ->orderBy('usuario.id_usuario', 'asc')-> get();

        return view('viewEstudiante/verEvaluador',compact('evaluador','proyectoAsignado'));
    }

    public function leerCasoPrueba(Request $request){
        $integranteProyecto = \calidad\integranteProyecto::where('id_usuario',$request['id_usuario']) ->get();
        foreach ($integranteProyecto as $integrante) { $id_proyecto = $integrante->id_proyecto; }
        $casoPrueba = \calidad\casoPrueba
            ::join('proyectoCasoPrueba', 'proyectoCasoPrueba.id_casoPrueba', '=', 'casoPrueba.id_casoPrueba')
            ->where('proyectoCasoPrueba.id_proyecto',$id_proyecto)
            ->where('proyectoCasoPrueba.id_usuario',$request['id_evaluador'])
            ->select('casoPrueba.*','proyectoCasoPrueba.*')
            ->orderBy('casoPrueba.id_casoPrueba', 'asc')-> get();

        return view('viewEstudiante/evaluacionPlataforma',compact('casoPrueba'));
    }
    
    public function detailsCasoprueba(Request $request){
        $casoPrueba = \calidad\casoPrueba::where('id_casoPrueba',($request['caso'])) -> get();

        $pruebas = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',$request['caso'])
            ->Where('entregaPrueba.estado', '!=', 'sin calificar')
            ->select('entregaPrueba.observacion','entregaPrueba.estado','entregaPrueba.id_prueba', 'prueba.name_Prueba')
            ->orderBy('prueba.id_prueba', 'asc')-> get();

        return view('viewEstudiante/detailsCasoprueba',compact('casoPrueba','pruebas'));
    }
    
    public function resultadoCasoPrueba(Request $request){
        $pruebas = \calidad\prueba
            ::join('entregaPrueba', 'entregaPrueba.id_prueba', '=', 'prueba.id_prueba')
            ->where('prueba.id_casoPrueba',$request['caso'])
            ->Where('entregaPrueba.estado', '!=', 'sin calificar')
            ->select('entregaPrueba.observacion','entregaPrueba.estado','entregaPrueba.id_prueba', 'prueba.name_Prueba')
            ->orderBy('prueba.id_prueba', 'asc')-> get();
            
        return view('viewEstudiante/resultadoCasoPrueba',compact('pruebas'));
    }
    public function cambiarFecha(Request $request){
        try {
            $casoPrueba = \calidad\casoPrueba::find($request['id_casoPrueba']);
            $casoPrueba->fecha_limite = $request['caso'];
            $casoPrueba->save();
            echo "<script type=\"text/javascript\">alert(\"". "La fecha limite se ha cambiado correctamente" . "\"); window.open('../realizarEvaluacion','_self'); </script>";
        } catch (Exception $e) {
            echo "<script type=\"text/javascript\">alert(\"". "Se produjo un error" . "\"); window.open('/','_self'); </script>";
        }
    }
    
    public function recuperarPassword(Request $request){
        $email = $_POST["nombre"];
        if (preg_match("([A-Za-z0-9_.-]+@[A-Za-z0-9_.-]+\.[A-Za-z0-9_-]+)",$email , $resultado))
        {
            $user = \calidad\usuario::where('correo',$_POST["nombre"]) -> first();
        }
        else{
            $user = \calidad\usuario::where('nom_usuario',$_POST["nombre"]) -> first();
        }
        if(count($user) > 0){
            $correo = $user['correo'];
            $contra = decrypt($user['contrasena']);

            $para = "jhoacosta93@hotmail.com";
            $nombre = $_POST["nombre"];
            $asunto = "Calisoft enviado por $nombre: ";
            
            $message = '<html><link href="../css/estilo-base.css" rel="stylesheet" type="text/css"> <body>';
            $message = '<center><div id="titulo"><h1>PLATAFORMA WEB PARA LA EVALUACI&Oacute;N DE PRODUCTOS SOFTWARE</h1></div></center>';
            $message .= '<div><h3>Recuperar contrase&ntilde;a</h3></div>';
            $message .= '<div>Confirmaci&oacute;n de recuperaci&oacute;n de contrase&ntilde;a</div>';
            $message .= '<div>Por medio de este correo se le envia la contrase&ntilde;a que ha solicitado recordar, se le aconseja que cambie la contrase&ntilde;a al iniciar sesi&oacute;n por su seguridad.</div>';
            $message .= '<br><div>Nombre de usuario: '.$user['nom_usuario'].'</div>';
            $message .= '<div>Contrase&ntilde;a: '. $contra.'</div><br>';
            $message .= '<div>Este correo es enviado autom&aacute;ticamente, por favor no contestar ya que no obtendr&aacute; respuesta.</div>';
            $message .= '<div>Gracias por usar nuestros servicios.</div>';
            $message .= '<center><div><h2>UNIVERSIDAD DE CUNDINAMARCA</h2></div></center>';
            $message .= '</body></html>';
                
                $de = "administrador@calisoft.com";

            $headers = "From: " . strip_tags($de) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($de) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if(@mail($correo,$asunto,$message,$headers))
                echo "<script type=\"text/javascript\">alert(\"". "Correo enviado exitosamente" . "\");window.open('../','_self');</script>";
            else
                echo "<script type=\"text/javascript\">alert(\"". "Fallo envio" . "\");window.open('../','_self');</script>";
        }
        else{
            echo "<script type=\"text/javascript\">alert(\"". "Usuario no registrado" . "\");window.open('  ../','_self');</script>";
        }
    }
}

?>
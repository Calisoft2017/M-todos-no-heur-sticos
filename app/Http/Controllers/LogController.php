<?php

namespace calidad\Http\Controllers;
use Auth;
use Session;
use Redirect;
use Illuminate\Http\Request;
use calidad\Http\Requests;
use calidad\Http\Requests\LoginRequest;

class LogController extends Controller
{
    public function validate(LoginRequest $request){

        $user = \calidad\usuario::where('nom_usuario',$request['nom_usuario']) -> first();
       // echo "<script type=\"text/javascript\">console.log(\"". decrypt($user['contrasena']) . " 2 = " . $userdata['contrasena'] ."\");</script>";
    	//if(Auth::attempt(['nom_usuario' => $request['nom_usuario'], 'contrasena' => $request['contrasena']])){
        //if(Auth::attempt($userdata)){
    	//	return Redirect::to('registro');
    	//}
    	//echo "<script type=\"text/javascript\">alert(\"". "datos incorrectos" . "\");</script>";
        
        //return $user->nombre;
        if($user == null)
            return "nombre de usuario no existe";
        else{
            if(decrypt($user->contrasena) == $request['contrasena']){
                Auth::login($user);
                echo "<script type=\"text/javascript\">alert(\"". Auth::check() ."\");</script>";
                Session::set('user', $user);   
                return Redirect::to('/');
            }
            else{
                return "contraseña invalida";
            }
        }
        return $request->nom_usuario;
    }
    public function login(){
    	return view("login");
    }
}

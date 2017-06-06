@extends('layouts.principal')


@section('navegacion')
	<ul>
        <li><a id="inicio-flotante"  class="icon-key2 sesion" href="#">Iniciar Sesion</a></li>
        <li><a class="icon-folder-open" name="b1" class="icon-pencil2" href="#">Configuracion</a></li>
        <li><a class="icon-home salir" href="#">Salir</a></li>
      </ul>
@stop

@section('content')
	<form method="POST" action="log">
	<div class="titulo">LOGIN</div>
	<fieldset>
	<div style="margin-top:0.5%;"><input type="text" name="nom_usuario" placeholder="Nombre de usuario" autofocus required maxlength="50"/></div>
	<div style="margin-top:0.5%;"><input type="password" name="contrasena" placeholder="contraseña" autofocus required maxlength="50"/></div>
	<button class="boton-grande" id="registro_boton">Aceptar</button>
	</fieldset>
	</form>
@stop
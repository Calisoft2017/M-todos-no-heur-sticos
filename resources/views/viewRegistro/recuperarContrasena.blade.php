@extends('layouts.principal')


@section('navegacion')
    <div class="titulo">recuperar contraseña</div>
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >
    <div class="registro_titulo_div">Datos solicitados</div> 

      <form action="recuperarPassword" method="post">
      	<div>Al siguiente usuario se le enviar&aacute; un correo record&aacute;ndole la contrase&ntilde;a, por favor digite el usuario</div>
      	<div>En caso de no recordar el usuario digite el correo con el que se registro.</div>
      	<br>
        <input name="nombre" type="text" id="nombre" placeholder="Nombre de usuario" required/><br>
        <br><br>
        <button class="boton-grande" id="registro_boton">Enviar</button>
      </form>
@stop
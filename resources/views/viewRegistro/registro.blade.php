@extends('layouts.principal')


@section('navegacion')
<div class="titulo">REGISTRO</div>
<div class="contenedor-tabla100">
  <table><tr>
	<form method="POST" action="registroProyecto">
		<th><button name="registroProyectos" class="" id="menu_boton">Registrar proyecto</button></th>
	</form>
    <form method="POST" action="registroEvaluador">
    	<th><button name="registroEvaluador" class="" id="menu_boton">Registrar evaluador</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
	<link href="../css/registro.css"rel="stylesheet" type="text/css" >
@stop
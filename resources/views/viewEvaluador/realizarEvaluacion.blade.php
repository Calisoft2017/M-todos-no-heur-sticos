@extends('layouts.principal')

@section('navegacion')
	<div>
        <div>
			<form method="POST" action="verProyectos">
	      		<input type="hidden" name="id_usuario" id="id_usuario3">
	          	<input style="height: 40px; width: 50px; cursor: auto; float: left; box-shadow: none;border: none;" type="image" name="valor" src="../img/btnAtras.png" onclick="guardar2(this)"/>
        	</form>
        </div>
		<div class="titulo">EVALUAR</div>
	</div>
	<div class="contenedor-tabla100">
	  <table><tr>
		<form method="POST" action="evaluardocumentos">
			<input type="hidden" name="h_id_proyecto" id="h_id_proyecto">
			<input type="hidden" name="h_id_usuario" id="h_id_usuario">
			<th><button name="evaluarModelado" class="" id="menu_boton" onclick="guardar_id_usuario(this)">Evaluar modelado</button></th>
		</form>
	    <form method="POST" action="evaluarPlataforma">
            <input type="hidden" name="id_proyecto" id="id_proyecto">
      		<input type="hidden" name="id_usuario" id="id_usuario">
	    	<th><button name="evaluarPlataforma" class="" id="menu_boton" onclick="guardar(this)" >Evaluar plataforma</button></th>
	    </form>
	  </tr></table>
	</div> 
@stop

@section('content')

  
	<link href="../css/registro.css"rel="stylesheet" type="text/css" >
  	<div class="registro_titulo_div">Reportes</div> 
	<br>
	<div>
	  <table>
	    <tbody>
	      <tr>
	        <td>
	          <form method="POST" action="reporte_generalEva/1" target="_blank">
	            <input type="hidden" name="id_proyecto" id="id_proyecto2">
	            <input type="hidden" name="id_usuario" id="id_usuario2">
	            <button name="reporte_generalEva" id="verReporte_boton" onclick="reporte(this)">Ver reporte general</button>
	          </form>
	        </td>
	        <td>
	        <!--<a href="reporte_generalEva/2" target="_blank" ><button name="descargar_reporte" id="descargarReporte_boton">Descargar reporte general</button></a>-->
	          <form method="POST" action="reporte_generalEva/2" target="_blank">
	            <input type="hidden" name="id_proyecto" id="id_proyecto4">
	            <input type="hidden" name="id_usuario" id="id_usuario4">
	            <button name="descargar_reporte" id="descargarReporte_boton" onclick="reporte_4(this)">Descargar reporte general</button>
	          </form>
	        </td>
	      </tr>
	    </tbody>
	  </table>
	</div>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 2) {
        alert("No ha iniciado sesion");
        window.open('/','_self');
      }
    };
    function guardar(element){
      if (sessionStorage.getItem('id_proyecto') != null) {
	      if (sessionStorage.getItem('id_usuario') != null) {
	        document.getElementById("id_usuario").value = sessionStorage['id_usuario'];
        	document.getElementById("id_proyecto").value = sessionStorage['id_proyecto'];
	      }
	      else{
		window.open('/','_self');
	      }
      }
      else{
        window.open('evaluador','_self');
      }
    }
    function guardar2(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_usuario3").value = sessionStorage['id_usuario'];
      }
      else{
        window.open('evaluador','_self');
      }
    }
    function reporte_4(element){
      if (sessionStorage.getItem('id_proyecto') != null) {
	      if (sessionStorage.getItem('id_usuario') != null) {
	        document.getElementById("id_usuario4").value = sessionStorage['id_usuario'];
        	document.getElementById("id_proyecto4").value = sessionStorage['id_proyecto'];
	      }
	      else{
	        alert("Error, repita el proceso");
	        window.open('/','_self');
	      }
      }
      else{
        window.open('evaluador','_self');
      }
    }
        function reporte(element){
      if (sessionStorage.getItem('id_proyecto') != null) {
	      if (sessionStorage.getItem('id_usuario') != null) {
	        document.getElementById("id_usuario2").value = sessionStorage['id_usuario'];
        	document.getElementById("id_proyecto2").value = sessionStorage['id_proyecto'];
	      }
	      else{
	        alert("Error, repita el proceso");
	        window.open('/','_self');
	      }
      }
      else{
        alert("Error, repita el proceso");
        window.open('evaluador','_self');
      }
    }
	function guardar_id_usuario(element){
	document.getElementById("h_id_proyecto").value = sessionStorage.getItem('id_proyecto');
	document.getElementById("h_id_usuario").value = sessionStorage.getItem('id_usuario');
	};
	</script>
@stop
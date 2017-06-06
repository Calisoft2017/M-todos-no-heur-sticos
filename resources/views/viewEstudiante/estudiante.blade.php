@extends('layouts.principal')

@section('navegacion')
<div class="titulo">ESTUDIANTE</div>
<div class="contenedor-tabla100">
  <table><tr>
    <form method="POST" action="datosEstudiante">
      <input type="hidden" name="id_estudiante" id="id_estudiante">
      <th  style="width: 33.33%;"><button name="datosEvaluador" class="" id="menu_boton" onclick="guardar2(this)" value="">ver datos</button></th>
    </form>
    <form method="POST" action="documentosproyecto">
    <input type="hidden" name="h_id_usuario" id="h_id_usuario">
      <th><button name="subirDocumento" class="menu_est" id="menu_boton" onclick="guardar_id_usuario(this)" value="">Subir documentación</button></th>
    </form>
    <form method="POST" action="verEvaluador">
      <input type="hidden" name="id_usuario" id="id_usuario">
      <th  style="width: 33.33%;"><button name="verEvaluador" class="menu_est" id="menu_boton" onclick="guardar(this)" value="">Ver evaluacion</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 3) {
        window.open('calidad/public/','_self');
      }
    };
    function guardar(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_usuario").value = parseInt(sessionStorage['id_usuario']);
      }
      else{
        alert("Error, repita el proceso");
        window.open('/','_self');
      }
    }
    function guardar2(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_estudiante").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('evaluador','_self');
      }
    }
    function guardar_id_usuario(element){
        document.getElementById("h_id_usuario").value = sessionStorage['id_usuario'];
    }
  </script>
@stop
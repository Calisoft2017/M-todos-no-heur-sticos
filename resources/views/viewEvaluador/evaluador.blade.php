@extends('layouts.principal')

@section('navegacion')
<div class="titulo">EVALUADOR</div>
<div class="contenedor-tabla100">
  <table><tr>
    <form method="POST" action="datosEvaluador">
      <input type="hidden" name="id_evaluador" id="id_evaluador">
      <th class="th_menu"><button name="datosEvaluador" class="" id="menu_boton" onclick="guardar2(this)" value="">ver datos</button></th>
    </form>
    <form method="POST" action="verProyectos">
      <input type="hidden" name="id_usuario" id="id_usuario">
      <th class="th_menu"><button name="verProyecto" class="" id="menu_boton" onclick="guardar(this)" value="">ver proyectos</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 2) {
        alert("No ha iniciado sesion");
        window.open('calidad/public/','_self');
      }
    };
    function guardar(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_usuario").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('evaluador','_self');
      }
    }
    function guardar2(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_evaluador").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('evaluador','_self');
      }
    }
  </script>
@stop
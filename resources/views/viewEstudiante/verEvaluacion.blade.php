@extends('layouts.principal')

@section('navegacion')
  <div>
    <div>
      <form method="POST" action="verEvaluador">
        <input type="hidden" name="id_usuario" id="id_usuario4">
        <input style="height: 40px; width: 50px; cursor: auto; float: left; box-shadow: none;border: none;" type="image" name="valor" src="../img/btnAtras.png" onclick="atras(this)"/>
      </form>
    </div>
    <div class="titulo">VER EVALUACIÓN</div>
  </div>

<div class="contenedor-tabla100">
  <table><tr>
    <form method="POST" action="resultadosevaluaciondoc">
    <input type="hidden" name="h_id_evaluador" id="h_id_evaluador">
    <input type="hidden" name="h_id_usuario" id="h_id_usuario">
      <th><button name="evaluacionModelado" onclick="guardar_ids(this)" class="" id="menu_boton" value="">Evaluación del modelado</button></th>
    </form>
    <form method="POST" action="evaluacionPlataforma">
      <input type="hidden" name="id_evaluador" id="id_evaluador">
      <input type="hidden" name="id_usuario" id="id_usuario">
      <th><button name="evaluacionPlataforma" onclick="guardar(this)" class="" id="menu_boton" value="">Evaluación de la plataforma</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >
  <div class="registro_titulo_div">Reportes</div> 
  <br>

  <div>
    <table><tbody>
      <tr>
        <td>
          <form method="POST" action="reporte_generalEst/1" target="_blank">
            <input type="hidden" name="id_evaluador" id="id_evaluador2">
            <input type="hidden" name="id_usuario" id="id_usuario2">
            <button name="reporte_generalEst" id="verReporte_boton" onclick="reporte(this)">Ver reporte de las pruebas</button>
          </form>
        </td>
        <td>
         <form method="POST" action="reporte_generalEst/2" target="_blank">
            <input type="hidden" name="id_evaluador" id="id_evaluador3">
            <input type="hidden" name="id_usuario" id="id_usuario3">
             <button name="descargar_reporte" id="descargarReporte_boton" onclick="reporte_2(this)">Descargar reporte de las pruebas</button>
          </form>
        </td>
      </tr></tbody>
    </table>
  </div>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 3) {
        alert("No ha iniciado sesion");
        window.open('calidad/public/','_self');
      }
    };
    function guardar(element){
      if (sessionStorage.getItem('id_evaluador') != null) {
        if (sessionStorage.getItem('id_usuario') != null) {
          document.getElementById("id_usuario").value = parseInt(sessionStorage['id_usuario']);
          document.getElementById("id_evaluador").value = sessionStorage['id_evaluador'];
        }
        else{
          alert("Error, repita el proceso");
          window.open('calidad/public/','_self');
        }
      }
      else{
        alert("Error, repita el proceso");
        window.open('calidad/public/evaluador','_self');
      }
    }

    function atras(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_usuario4").value = parseInt(sessionStorage['id_usuario']);
      }
      else{
        alert("Error, repita el proceso");
        window.open('/','_self');
      }
    }
    function reporte(element){
      if (sessionStorage.getItem('id_evaluador') != null) {
        if (sessionStorage.getItem('id_usuario') != null) {
          document.getElementById("id_usuario2").value = sessionStorage['id_usuario'];
          document.getElementById("id_evaluador2").value = sessionStorage['id_evaluador'];
        }
        else{
          alert("Error, repita el proceso");
          window.open('calidad/public/','_self');
        }
      }
      else{
        alert("Error, repita el proceso");
        window.open('calidad/public/evaluador','_self');
      }
    }
    function reporte_2(element){
      if (sessionStorage.getItem('id_evaluador') != null) {
        if (sessionStorage.getItem('id_usuario') != null) {
          document.getElementById("id_usuario3").value = sessionStorage['id_usuario'];
          document.getElementById("id_evaluador3").value = sessionStorage['id_evaluador'];
        }
        else{
          alert("Error, repita el proceso");
          window.open('calidad/public/','_self');
        }
      }
      else{
        alert("Error, repita el proceso");
        window.open('calidad/public/evaluador','_self');
      }
    }
    function guardar_ids(element){
          document.getElementById("h_id_usuario").value = sessionStorage['id_usuario'];
          document.getElementById("h_id_evaluador").value = sessionStorage['id_evaluador'];
    }

  </script>
@stop
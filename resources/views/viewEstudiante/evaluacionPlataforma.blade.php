@extends('layouts.principal')

@section('navegacion')
  <div>
    <div>
      <form method="POST" action="verEvaluacion">
        <input type="hidden" name="id_usuario" id="id_usuario">
        <input style="height: 40px; width: 50px; cursor: auto; float: left; box-shadow: none;border: none;" type="image" name="valor" src="../img/btnAtras.png" onclick="atras(this)"/>
      </form>
    </div>
    <div class="titulo">VER EVALUACIÓN</div>
  </div>

@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >
<div class="titulo">CASOS DE PRUEBA</div>

  <?php
       if(count($casoPrueba) > 0){   
    ?>
      <div class="contenedor-tabla100">
          <table>
            <tbody><tr>
            <th>Nombre del caso de prueba</th>
            <th>Ver detalles</th>
            </tr>
            @foreach($casoPrueba as $fila)
            <tr>
              <td>{{$fila->name_casoPrueba}}</td>
              <form method="POST" action="detailsCasoprueba">
                <td><button name="caso" class="boton-small" id="registro_boton" value="<?php echo $fila->id_casoPrueba; ?>">Aceptar</button></td>
              </form>
            </tr>
            
            @endforeach     
            </tbody>
          </table>
      </div>
  <?php 
  }
  else{
    echo "No hay casos de prueba creados";
  }
  ?>

    <div class="registro_titulo_div">Reportes</div> 

    <div>
      <table><tbody>
        <tr>
        <td>
          <form method="POST" action="reporte_gestionEst/1" target="_blank">
            <input type="hidden" name="id_evaluador" id="id_evaluador2">
            <input type="hidden" name="id_usuario" id="id_usuario2">
            <button name="reporte_generalEst" id="verReporte_boton" onclick="reporte(this)">Ver reporte de las pruebas</button>
          </form>
        </td>
        <td>
         <form method="POST" action="reporte_gestionEst/2" target="_blank">
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
        window.open('/','_self');
      }
    };

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
  </script>
@stop
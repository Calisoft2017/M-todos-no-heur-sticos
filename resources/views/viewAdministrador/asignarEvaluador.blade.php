@extends('layouts.principal')


@section('navegacion')
<div class="titulo">ADMINISTRADOR</div>
<div class="contenedor-tabla100">
  <table><tr>
    <form method="POST" action="datosAdministrador">
      <input type="hidden" name="id_evaluador" id="id_evaluador">
      <th><button name="actualizarDatosAdmi" class="" id="menu_boton" onclick="guardar2(this)" value="">ver datos</button></th>
    </form>
    <form method="POST" action="consultaUsuarios">
      <th><button name="Estdudiantes" class="" id="menu_boton" value="">Ver estudiantes</button></th>
    </form>
    <form method="POST" action="consultaEvaluadores">
      <th><button name="Evaluadores" class="" id="menu_boton" value="">Ver evaluadores</button></th>
    </form>
    <form method="POST" action="consultaPeticiones">
      <th><button name="peticiones" class="" id="menu_boton" value="">Ver peticiones</button></th>
    </form>
  </tr></table>
  <table><tr>
    <form method="POST" action="consultaProyectos">
      <th><button name="proyectos" class="" id="menu_boton" value="">Ver datos de los proyectos</button></th>
    </form>
    <form method="POST" action="categorizacion">
      <input type="hidden" name="id_evaluador" id="id_evaluador">
      <th><button name="categorizacion" class="" id="menu_boton" value="">categorización de los proyectos</button></th>
    </form>
    <form method="POST" action="configuracionPorcentajes">
      <th><button name="porcentajes" class="" id="menu_boton" value="">Ver configuración de porcentajes</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >
<div class="titulo">ASIGNAR EVALUADOR AL PROYECTO</div>

  <?php
  ///////////////////////////////////////////////////// evaluadores //////////////////////////////////////////////////////////////////////
  $i=0;
  if(count($evaluador) > 0){   
  ?>
    <div class="registro_titulo_div">Evaluadores</div> 
    <div class="contenedor-tabla1002">
        <table>
          <tbody><tr>
          <th>código</th>
          <th>nombre</th>
          <th>apellido</th>
          <th>correo</th>
          <th>usuario</th>
          <th>estado</th>
          <th>modificar</th>
          </tr>
          @foreach($evaluador as $fila)
            <?php $mostrar = false; ?>

            @foreach($proyectoAsignado as $fila2)
              <?php 
              if ($fila2->id_usuario==$fila->id_usuario) {
                $mostrar = true;
              }
              ?>
            @endforeach
            <?php 
            if ($mostrar == false) {
            ?>
              <tr>
                <td>{{$fila->id_usuario}}</td>
                <td>{{$fila->nombre}}</td>
                <td>{{$fila->apellido}}</td>
                <td>{{$fila->correo}}</td>
                <td>{{$fila->nom_usuario}}</td>
                <td>{{$fila->estado}}</td>
                <form method="POST" action="aceptarAsignacion">
                    <td>
                      <input type="hidden" name="id_proyecto" id="id_proyecto_<?php echo $i ?>">
                      <button name="aceptar" onclick="guardar(this, <?php echo $i ?>)"  class="boton-small" id="registro_boton" value="{{$fila->id_usuario}}">Asignar</button>
                    </td>
                </form>
              </tr>
            <?php
            $i++;
            }
           
          ?>
          @endforeach     
          </tbody>
        </table>
    </div>
    <?php 
    }
    else{
      echo "No hay evaluadores disponibles";
    }
    if ($i == 0) {
      echo "No hay evaluadores disponibles";
      ?>
      <style>
        .contenedor-tabla1002{
          visibility: hidden;
        }
      </style>
      <?php
    }
  ?>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 1) {
        alert("No ha iniciado sesion");
        window.open('/calidad/public/','_self');
      }
    };

    function guardar(element, num){
      if (sessionStorage.getItem('id_proyecto') != null) {
        document.getElementById("id_proyecto_"+num).value = sessionStorage['id_proyecto'];
        sessionStorage.removeItem('id_proyecto');
      }
      else{
        alert("Error, repita el proceso");
        window.open('consultaProyectos','_self');
      }
        
    }

  </script>
@stop
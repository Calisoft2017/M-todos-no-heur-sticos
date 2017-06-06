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

  <?php
  ///////////////////////////////////////////////////// tabla de las proyectos /////////////////////////////////////////////////////////////////////////
    if(count($proyecto) > 0){   
  ?>
    <div class="registro_titulo_div">Proyectos asignados</div> 
    
    <div class="contenedor-tabla100">
        @foreach($proyecto as $fila)
        <?php $imprimir=false; ?>
          
          @foreach($categoria as $cat)
            <?php 
            if ($fila->id_categoria == $cat->id_categoria) {
              $name_categoria = $cat->name_categoria;
            } 
             ?>
          @endforeach

          @foreach($proyectoAsignado as $proyA)
            <?php 
              if($fila->id_proyecto == $proyA->id_proyecto and $proyA->id_usuario == $id_evaluador){
                $imprimir=true;
              }
            ?> 
          @endforeach 
        <?php if ($imprimir==true) { ?>
        <table><thead><tr><th>Proyecto</th></tr></thead></table>
        <table id="tabla_proyectos">
          <tbody>
            <tr>
              <th class="th_proyectos">Nombre del proyecto</th>
              <td>{{$fila->name_proyecto}}</td>
            </tr>
            <tr>
              <th class="th_proyectos">Grupo de investigación</th>
              <td>{{$fila->name_investigacion}}</td>
            </tr>
            <tr>
              <th class="th_proyectos">Nombre de semillero</th>
              <td>{{$fila->name_semillero}}</td>
            </tr>
                <tr>
                  <th class="th_proyectos">Tipo de proyecto</th>
                  <td>{{$name_categoria}}</td>
                </tr>
          </tbody>
        </table>
        <table><thead><tr><th>Integrante/s</th></tr></thead></table>
        <table>
          <tbody><tr>
          <th>código</th>
          <th>nombre</th>
          <th>apellido</th>
          <th>correo</th>
          <th>usuario</th>
          </tr>

          @foreach($integranteProyecto as $inteP)
          <?php 
            if($fila->id_proyecto == $inteP->id_proyecto){
          ?>
          @foreach($estudiante as $fila2)
          <?php 
              if ($inteP->id_usuario == $fila2->id_usuario) {
          ?>
          <tr>
            <td>{{$fila2->id_usuario}}</td>
            <td>{{$fila2->nombre}}</td>
            <td>{{$fila2->apellido}}</td>
            <td>{{$fila2->correo}}</td>
            <td>{{$fila2->nom_usuario}}</td>
          </tr>
          <?php } ?>
          @endforeach   
          
          <?php 
          }
          ?> 
          @endforeach    

          </tbody>
        </table>
        <table><thead><tr><th>Evaluador/es</th></tr></thead></table>
        <table><tr>
          <form method="POST" action="realizarEvaluacion">
            <td><button name="aceptar" onclick="guardar3(this)" class="boton-small" id="registro_boton" value="<?php echo $fila->id_proyecto; ?>">Ver proyecto</button></td>
          </form>
        </tr></table>
        <br>
      <?php } ?>
      @endforeach    
    </div>
    <?php 
    }
    else{
      echo "No hay proyectos registrados";
    }
  ?>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 2) {
        alert("No ha iniciado sesion");
        window.open('/','_self');
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
      function guardar3(element){
        sessionStorage['id_proyecto']=element.value;
      }
  </script>
@stop
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
<div class="titulo">CONSULTA DE PROYECTOS</div>

  <?php
  ///////////////////////////////////////////////////// tabla de las proyectos /////////////////////////////////////////////////////////////////////////
    if(count($proyecto) > 0){   
  ?>
    <div class="registro_titulo_div">Proyectos</div> 
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

          @foreach($integranteProyecto as $inteP)
            <?php 
              if($fila->id_proyecto == $inteP->id_proyecto){
            ?>
            @foreach($estudiante as $fila2)
              <?php 
                  if ($inteP->id_usuario == $fila2->id_usuario) {
                        if ($fila2->estado!='peticion') {
                          $imprimir=true;
                        }
                  } 
              ?>
            @endforeach   
            
            <?php 
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
                <td >{{$fila2->id_usuario}}</td>
                <td>{{$fila2->nombre}}</td>
                <td>{{$fila2->apellido}}</td>
                <td>{{$fila2->correo}}</td>
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
            <table>
              <tbody><tr>
              <th>código</th>
              <th>nombre</th>
              <th>apellido</th>
              <th>correo</th>
              <th>desasignar</th>
              </tr>


              @foreach($proyectoAsignado as $proyA)
              <?php 
                if($fila->id_proyecto == $proyA->id_proyecto){
              ?>
              @foreach($evaluador as $fila3)
              <?php 
                  if ($proyA->id_usuario == $fila3->id_usuario) {
              ?>
              <tr>
                <td >{{$fila3->id_usuario}}</td>
                <td>{{$fila3->nombre}}</td>
                <td>{{$fila3->apellido}}</td>
                <td>{{$fila3->correo}}</td>
                <form method="POST" action="desasignar">
                  <input type="hidden" name="id_proyecto" value="<?php echo $fila->id_proyecto; ?>">
                <td><button name="eliminar" class="boton-small" id="registro_boton" value="<?php echo $fila3->id_usuario; ?>">desasignar</button></td>
                </form>
              </tr>
              <?php } ?>
              @endforeach   
              
              <?php 
              }
              ?> 
              @endforeach    

              </tbody>
            </table>
            <table><tr>
              <form method="POST" action="asignarEvaluador">
                <td><button name="aceptar" onclick="guardar(this)" class="boton-small" id="btn" value="<?php echo $fila->id_proyecto; ?>">asignar un evaluador</button></td>
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
      if (sessionStorage.getItem('id_rol') != 1) {
        alert("No ha iniciado sesion");
        window.open('calidad/public','_self');
      }
    };
      function guardar(element){
        //sessionStorage[producto]=precio;
        sessionStorage['id_proyecto']=element.value;
      }
  </script>
@stop
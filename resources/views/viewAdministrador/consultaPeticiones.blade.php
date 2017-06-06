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
<div class="titulo">CONSULTA DE PETICIÓN</div>

  <?php
  /////////////////////////////////////////////////////tabla de las paticiones/////////////////////////////////////////////////////////////////////////
  if(count($peticion) > 0){
      $verificacion=false;
      $verificacion2=false;
  ?>
    <div class="registro_titulo_div">Evaluadores</div> 
    @foreach($peticion as $fila)
    <?php 
    if ($fila->id_rol==2) {
      $verificacion=true;
    }
    ?>
    @endforeach  
    <?php 
      if ($verificacion==true) {
    ?>
    <div class="contenedor-tabla100">
        <table>
          <tbody><tr>
          <th>código</th>
          <th>nombre</th>
          <th>apellido</th>
          <th>correo</th>
          <th>usuario</th>
          <th>estado</th>
          <th>modificar</th>
          <th>eliminar</th>
          </tr>
          @foreach($peticion as $fila)
          <?php 
          if ($fila->id_rol==2) {
          ?>
            <tr>
              <td>{{$fila->id_usuario}}</td>
              <td>{{$fila->nombre}}</td>
              <td>{{$fila->apellido}}</td>
              <td>{{$fila->correo}}</td>
              <td>{{$fila->nom_usuario}}</td>
              <td>{{$fila->estado}}</td>
              <form method="POST" action="aceptarPeticion">
              <td><button name="aceptar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_usuario; ?>">Aceptar</button></td>
              </form>
              <form method="POST" action="deletePeticion">
              <td><button name="eliminar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_usuario; ?>">Eliminar</button></td>
              </form>
            </tr>
          <?php }
          ?>
          @endforeach  
          </tbody>
        </table>  
    </div>
    <?php 
    }
    elseif($verificacion==false) {
       echo "No hay peticion de registro de evaluadores";
     } 
     ////////////////////////////////////////////////////////////////peticion de proyectos /////////////////////////////////////////////////////
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
                        if ($fila2->estado=='peticion') {
                          $imprimir=true;
                          $verificacion2=true;
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
                    <td >{{$fila2->id_usuario}}</td>
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
            <table><tr>
              <form method="POST" action="aceptarPeticionProyecto">
                <td><button name="aceptar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_proyecto; ?>">Aceptar</button></td>
              </form>
              <form method="POST" action="deletePeticionProyecto">
                <td><button name="eliminar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_proyecto; ?>">Eliminar</button></td>
              </form>
            </tr></table>
            <br>
          <?php 
        }
        ?>
        @endforeach 
        <?php 
        if($verificacion2==false){
          echo "No hay petición de registro de proyectos";
        } 
         ?>   
    </div>
    <?php 
    }
    else{
      echo "No hay peticiones de registros";
    }
  ?>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 1) {
        alert("No ha iniciado sesion");
        window.open('calidad/public/','_self');
      }
    };
  </script>
@stop
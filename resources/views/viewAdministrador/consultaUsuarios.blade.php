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
<div class="titulo">CONSULTA DE USUARIOS</div>
	<?php 
  if(count($estudiante) > 0){   
  ?>
    <div class="registro_titulo_div">Estudiantes</div> 
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
          <th>deshabilitar</th>
          </tr>
          @foreach($estudiante as $fila)
          <tr>
            <?php //$fila->_text= decrypt($fila->_text);
          
          if($fila->estado!="peticion"){
            if(isset($_POST['modificar'])){ 
                    if($_POST['modificar'] == $fila->id_usuario){ ?>
            <form method="POST" action="updateUsuario">
                <td>{{$fila->id_usuario}}</td>
              <td><div><input type="text" name="edit_nombre" value="{{$fila->nombre}}" placeholder="nombre" autofocus required min="0" max="100"/></span></div></td>
              <td><div><input type="text" name="edit_apellido" value="{{$fila->apellido}}" placeholder="apellido" autofocus required maxlength="50"/></span></div></td>
              <td><div><input type="text" name="edit_correo" value="{{$fila->correo}}" placeholder="correo" autofocus required maxlength="50"/></span></div></td>
              <td><div><input type="text" name="edit_usuario" value="{{$fila->nom_usuario}}" placeholder="usuario" autofocus required maxlength="50"/></span></div></td>
              <td><div><select name="edit_estado" value="{{$fila->estado}}" placeholder="estado" autofocus required>
                        <option value="activo">activo</option>
                        <option value="deshabilitado">deshabilitado</option>
              </select></div></td>
             <td><button name="aceptar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_usuario; ?>">aceptar</button></td>
            </form>
            <form method="POST" action="consultaUsuarios">
              <td><button name="cancelar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_usuario; ?>">cancelar</button></td>
            </form>
            <?php }
              else{ ?>
                <td>{{$fila->id_usuario}}</td>
                <td>{{$fila->nombre}}</td>
                <td>{{$fila->apellido}}</td>
                <td>{{$fila->correo}}</td>
                <td>{{$fila->nom_usuario}}</td>
                <td>{{$fila->estado}}</td>
                <form method="POST" action="consultaUsuarios">
                <td><button name="modificar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_usuario; ?>">modificar</button></td>
                </form>
                <form method="DELETE" action="deleteUsuario">
                <td><button name="eliminar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_usuario; ?>">deshabilitar</button></td>
                </form>
            <?php  }
            } else{  ?>
                <td>{{$fila->id_usuario}}</td>
                <td>{{$fila->nombre}}</td>
                <td>{{$fila->apellido}}</td>
                <td>{{$fila->correo}}</td>
                <td>{{$fila->nom_usuario}}</td>
                <td>{{$fila->estado}}</td>
            <form method="POST" action="consultaUsuarios">
            <td><button name="modificar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_usuario; ?>">modificar</button></td>
            </form>
            <form method="POST" action="deleteUsuario">
            <td><button name="eliminar" class="boton-small" id="registro_boton" value="<?php echo $fila->id_usuario; ?>">deshabilitar</button></td>
            </form>
            <?php }
          }?>
          </tr>
          
          @endforeach     
          </tbody>
        </table>
    </div>
    <?php 
    }
    else{
      echo "No hay Estdudiantes registrados";
    }
  ?>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 1) {
        alert("No ha iniciado sesion");
        window.open('calidad/public','_self');
      }
    };
  </script>
@stop
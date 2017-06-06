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
  <div class="datos_usuario_titulo">CATEGORIAS DE LOS PROYECTOS</div> 
  <hr>
<?php 
  if(count($categoria) > 0){   
  ?>
  <center>
	  <div class="section_datos" style="width: 65%;">
	    <div class="datos_usuario_titulo">Tipos de proyectos</div>
	    <hr>
	    <table><tbody>
	      <tr>
	        <th>numero de categoria</th>
	        <th>nombre de categoria</th>
	      </tr>
	      <?php 
	      foreach($categoria as $fila){
	
	       ?>
	        <tr>
	          <td style="padding: 10px;">{{$fila->id_categoria}}</td>
	          <td style="padding: 10px;">{{$fila->name_categoria}}</td>
	        </tr>
	      <?php 
	      }
	     ?>
	    </tbody></table>
	  </div>
	  <br>
	  <?php 
	  } ?>
  </center>
  <center>

      <div class="section_datos" style="width: 65%;">
        <div class="datos_usuario_titulo">Crear tipo de proyecto</div>
        <hr>
    	<form method="POST" action="crearCategoria" id="crearCategoria">
	        <div class="datos_usuario_titulo">Nombre de la categoria</div> 
	        <input type="text" name="name_categoria" id="edit_nombre" value=""  autofocus required min="0" max="50"/>
	        <br><br>
	        <hr>
	        <div class="datos_usuario_titulo">Porcentaje de evaluacion de la plataforma.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="porcPlataforma" id="porcPlataforma" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <div class="datos_usuario_titulo">Porcentaje de evaluacion del modelado.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="porcModelado" id="porcModelado" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <hr>
	        <div class="datos_usuario_titulo">Prioridad alta.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="prioridadAlta"  id="prioridadAlta" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <div class="datos_usuario_titulo">Prioridad media.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="prioridadMedia" id="prioridadMedia" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <div class="datos_usuario_titulo">Prioridad baja.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="prioridadBaja" id="prioridadBaja" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <hr>
	        <div class="datos_usuario_titulo">Diagrama de clases.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="dClases" id="dClases" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <div class="datos_usuario_titulo">Diagrama de casos de uso.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="dCasos" id="dCasos" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <div class="datos_usuario_titulo">Diagrama de despliegue.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="dDespliegue" id="dDespliegue" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <div class="datos_usuario_titulo">Diagrama de secuencias.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="dSecuencias" id="dSecuencias" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <div class="datos_usuario_titulo">Diagrama de actividades.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="dActividades" id="dActividades" autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <div class="datos_usuario_titulo">Modelo Entidad Relación.</div>
	        <div style="margin-top:0.5%;"><input type="number" name="MER" id="MER"  autofocus required min="0" max="99999999999"/></div>
	        <br>
	        <button id="btn_actualizar" type="submit">Crear tipo de proyecto</button>
    	</form>
      </div>
  </center>
  <br>
@stop
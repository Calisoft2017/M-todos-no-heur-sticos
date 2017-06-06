@extends('layouts.principal')


@section('navegacion')
	<ul>
        <li><a id="inicio-flotante"  class="icon-key2 sesion" href="#">Iniciar Sesion</a></li>
        <li><a class="icon-folder-open" name="b1" class="icon-pencil2" href="#">Configuracion</a></li>
        <li><a class="icon-home salir" href="#">Salir</a></li>
      </ul>
@stop

@section('content')
<div class="titulo">EJEMPLO CRUD</div>
<form method="POST" action="createCrud">
  <div style="margin-top:0.5%;"><input type="number" name="_bigint" placeholder="bigint" autofocus required min="0" max="100" step="10"/></span></div>
  <div style="margin-top:0.5%;"><input type="number" name="_integer" placeholder="integer" autofocus required min="0" max="100"/></span></div>
  <div style="margin-top:0.5%;"><input type="text" name="_char" placeholder="char" autofocus required maxlength="1"/></span></div>
  <div style="margin-top:0.5%;"><input type="date" name="_date" placeholder="date" autofocus required maxlength="10"/></span></div>
  <div style="margin-top:0.5%;"><input type="date" name="_datetime" placeholder="datetime" autofocus required maxlength="10"/></span></div>
  <div style="margin-top:0.5%;"><input type="date" name="_timestamp" placeholder="timestamp" autofocus required maxlength="10"/></span></div>
  <div style="margin-top:0.5%;"><input type="number" name="_double" placeholder="double" autofocus required step="0.01"/></span></div>
  <div style="margin-top:0.5%;"><input type="number" name="_float" placeholder="float" autofocus required step="0.01"/></span></div>
  <div style="margin-top:0.5%;"><input type="text" name="_text" placeholder="text" autofocus required maxlength="10"/></span></div>
  <div style="margin-top:0.5%;"><input type="text" name="_string" placeholder="string" autofocus required maxlength="10"/></span></div>

  <div><button class="boton-grande" id="registro_boton">Guardar</button></div>
</form>
	<?php 
  //echo "<script type=\"text/javascript\">alert(\"". count($crud) . "\");</script>";
  if(count($crud) > 0){   
  ?>
	<div class="contenedor-tabla100">
        <table>
          <tbody><tr>
          <th>_bigint</th>
          <th>_integer</th>
          <th>_char</th>
          <th>_date</th>
          <th>_datetime</th>
          <th>_timestamp</th>
          <th>_double</th>
          <th>_float</th>
          <th>_text</th>
          <th>_string</th>
          <th>modificar</th>
          <th>eliminar</th>
          </tr>
          @foreach($crud as $fila)
          <tr>
            <?php $fila->_text= decrypt($fila->_text);
                  $fila->_char= trim($fila->_char);
            if(isset($_GET['modificar'])){ 
                    if($_GET['modificar'] == $fila->id_crud){ ?>
            <form method="PUT" action="update">
              <td><div><input type="number" name="edit_bigint" value="{{$fila->_bigint}}" placeholder="bigint" autofocus required min="0" max="100" step="10"/></span></div></td>
              <td><div><input type="number" name="edit_integer" value="{{$fila->_integer}}" placeholder="integer" autofocus required min="0" max="100"/></span></div></td>
              <td><div><input type="text" name="edit_char" value="{{$fila->_char}}" placeholder="char" autofocus required maxlength="1"/></span></div></td>
              <td><div><input type="date" name="edit_date" value="{{$fila->_date}}" placeholder="date" autofocus required maxlength="10"/></span></div></td>
              <td><div><input type="date" name="edit_datetime" value="{{$fila->_datetime}}" placeholder="datetime" autofocus required maxlength="20"/></span></div></td>
              <td><div><input type="date" name="edit_timestamp" value="{{$fila->_timestamp}}" placeholder="timestamp" autofocus required maxlength="20"/></span></div></td>
              <td><div><input type="number" name="edit_double" value="{{$fila->_double}}" placeholder="double" autofocus required step="0.01"/></span></div></td>
              <td><div><input type="number" name="edit_float" value="{{$fila->_float}}" placeholder="float" autofocus required step="0.01"/></span></div></td>
              <td><div><input type="text" name="edit_text" value="{{$fila->_text}}" placeholder="text" autofocus required maxlength="10"/></span></div></td>
              <td><div><input type="text" name="edit_string" value="{{$fila->_string}}" placeholder="string" autofocus required maxlength="10"/></span></div></td>
              <td><button name="aceptar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_crud; ?>">aceptar</button></td>
            </form>
            <form method="GET" action="crud">
              <td><button name="cancelar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_crud; ?>">cancelar</button></td>
            </form>
            <?php }else{ ?>
                <td>{{$fila->_bigint}}</td>
                <td>{{$fila->_integer}}</td>
                <td>{{$fila->_char}}</td>
                <td>{{$fila->_date}}</td>
                <td>{{$fila->_datetime}}</td>
                <td>{{$fila->_timestamp}}</td>
                <td>{{$fila->_double}}</td>
                <td>{{$fila->_float}}</td>
                <td>{{$fila->_text}}</td>
                <td>{{$fila->_string}}</td>
                <form method="GET" action="crud">
                <td><button name="modificar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_crud; ?>">modificar</button></td>
                </form>
                <form method="DELETE" action="destroy">
                <td><button name="eliminar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_crud; ?>">eliminar</button></td>
                </form>
            <?php  }
            } else{  ?>
            <td>{{$fila->_bigint}}</td>
            <td>{{$fila->_integer}}</td>
            <td>{{$fila->_char}}</td>
            <td>{{$fila->_date}}</td>
            <td>{{$fila->_datetime}}</td>
            <td>{{$fila->_timestamp}}</td>
            <td>{{$fila->_double}}</td>
            <td>{{$fila->_float}}</td>
            <td>{{$fila->_text}}</td>
            <td>{{$fila->_string}}</td>
            <form method="GET" action="crud">
            <td><button name="modificar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_crud; ?>">modificar</button></td>
            </form>
            <form method="DELETE" action="destroy">
            <td><button name="eliminar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_crud; ?>">eliminar</button></td>
            </form>
            <?php }?>
          </tr>
          
          @endforeach     
          </tbody>
        </table>
    </div>
    <?php 
    }
    else{
      echo "No hay datos registrados";
    }
    ?>

@stop
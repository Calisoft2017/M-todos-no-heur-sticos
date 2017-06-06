@extends('layouts.principal')

@section('navegacion')
Administrador
@stop

@section('content')

<table>
  <tr>
  <th>Registro Tipo de documento</th>
  </tr>
  <tr>
  <td>
      <form method="POST" action="tipodocumentostore">
        <div style="margin-top:0.5%;">
          <input type="text" name="nom_tipo" placeholder="Nombre Tipo" required/>
        </div>
        <label class="texto-control-formulario">Documento opcional </label>
        <select  name="drop">
        <option value="SI">SI</option>
        <option value="NO">NO</option>
        </select>
        <br>
        <button class="boton-grande" id="registro_boton">Guardar</button></div>
      </form>
  </td>
  </tr>
</table>
<br><br>
<?php 
 if(count($tipoDocumento) > 0){   
  ?>
	<div class="contenedor-tabla100">
        <table>
          <tbody><tr>
          <th>Documento</th>
          <th>Opcional</th>
          <th colspan='2'>Operaciones</th>
          </tr>
          @foreach($tipoDocumento as $fila)
          <tr>
            <?php 
            if(isset($_POST['Modificar'])){ 
                    if($_POST['Modificar'] == $fila->id_tipo_documento){ ?>
            <form method="PUT" action="tipodocumentoupdate">
			  <td><div><input type="text" name="nom_tipo" value="{{$fila->nom_tipo}}" placeholder="Tipo Documento" autofocus required/></span></div></td>
              <td>
                <label class="texto-control-formulario">Documento opcional </label>
                <select  name="opcional_tipo">
                <option value="SI" <?php if($fila->opcional_tipo=='SI'){echo "selected";}?> >SI</option>
                <option value="NO" <?php if($fila->opcional_tipo=='NO'){echo "selected";}?> >NO</option>
                </select>
              </td>
              <td><button name="Aceptar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_tipo_documento; ?>">Aceptar</button></td>
            </form>
            <form method="POST" action="tipodocumento">
              <td><button name="Cancelar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_tipo_documento; ?>">Cancelar</button></td>
            </form>
            <?php }else{ ?>
                <td>{{$fila->nom_tipo}}</td>
                <td>{{$fila->opcional_tipo}}</td>
                <form method="POST" action="tipodocumento">
                <td><button name="Modificar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_tipo_documento; ?>">Modificar</button></td>
                </form>
                <form method="DELETE" action="tipodocumentodestroy">
                <td><button name="Eliminar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_tipo_documento; ?>">Eliminar</button></td>
                </form>
            <?php  }
            } else{  ?>
                <td>{{$fila->nom_tipo}}</td>
                <td>{{$fila->opcional_tipo}}</td>
                <form method="POST" action="tipodocumento">
                <td><button name="Modificar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_tipo_documento; ?>">Modificar</button></td>
                </form>
                <form method="DELETE" action="tipodocumentodestroy">
                <td><button name="Eliminar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_tipo_documento; ?>">Eliminar</button></td>
                </form>
            <?php }?>
          </tr>
          
          @endforeach     
          </tbody>
        </table>
    </div>
    <br>
<?php 
}
else{
  echo "No hay documentos registrados";
}
?>


<br><br><br>
<table>
  <tr>
  <th>Registro Componentes de documento</th>
  </tr>
  <tr>
  <td>
    <form method="POST" action="componentedocstore">
    <div style="margin-top:0.5%;"><input type="text" name="nom_componente" placeholder="Nombre Componente"  required/></span></div>
    <div style="margin-top:0.5%;"><textarea  name="descripcion" placeholder="Descripción del Componente"  required/></textarea></span></div>
    <div><label for="drop-down-1" class="texto-control-formulario">Componente opcional</label>
    <select id="drop-down-1" name="opcional_componente">
    <option value="SI">SI</option>
    <option value="NO">NO</option>
    </select></div>
    <div><label for="drop-down-1" class="texto-control-formulario">Tipo de documento</label>
    <select id="drop-down-1" name="id_tipo_documento">
    @foreach($tipoDocumento as $fila)
    <option value="{{$fila->id_tipo_documento}}">{{$fila->nom_tipo}}</option>
    @endforeach  
    </select></div>
    <div><button class="boton-grande" id="registro_boton">Guardar</button></div></div>
    </form>
  </td>
  </tr>
</table>
<br><br>
<?php 
 if(count($componente) > 0){   
  ?>
  <div class="contenedor-tabla100">
        <table>
          <tbody><tr>
          <th>Componente</th>
          <th>Descripción</th>
          <th>Opcional</th>
          <th>Tipo</th>
          <th colspan='2'>Operaciones</th>
          </tr>
          @foreach($componente as $fila)
          <tr>
            <?php 
            if(isset($_POST['Modificars'])){ 
                    if($_POST['Modificars'] == $fila->id_documento_componente){ ?>
            <form method="PUT" action="componentedocupdate">
              <td><div><input type="text" name="nom_componente" value="{{$fila->nom_componente}}" placeholder="Nombre Componente" autofocus required/></span></div></td>
              <td><div><input type="text" name="descripcion" value="{{$fila->descripcion}}" placeholder="Descripción Componente" autofocus required/>
</div></td>
              <td>
                <div><label class="texto-control-formulario">Componente opcional </label>
                <select  name="opcional_componente">
                <option value="SI" <?php if($fila->opcional_componente=='SI'){echo "selected";}?> >SI</option>
                <option value="NO" <?php if($fila->opcional_componente=='NO'){echo "selected";}?> >NO</option>
                </select></div>
              </td>
              <td>
                <div><label for="drop-down-1" class="texto-control-formulario">Tipo de documento</label>
                <select id="drop-down-1" name="id_tipo_documento">
                @foreach($tipoDocumento as $tipoDocumento)
                <option value="{{$tipoDocumento->id_tipo_documento}}" <?php if($tipoDocumento->nom_tipo==$fila->nom_tipo){echo "selected";}?> >{{$tipoDocumento->nom_tipo}}</option>
                @endforeach  
                </select></div>
              </td>
              <td><button name="Aceptar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documento_componente; ?>">Aceptar</button></td>
            </form>
            <form method="POST" action="componentedoc">
              <td><button name="Cancelar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documento_componente; ?>">Cancelar</button></td>
            </form>
            <?php }else{ ?>
                <td>{{$fila->nom_componente}}</td>
                <td>{{$fila->descripcion}}</td>
                <td>{{$fila->opcional_componente}}</td>
                <td>{{$fila->nom_tipo}}</td>
                <form method="POST" action="componentedoc">
                <td><button name="Modificars" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documento_componente; ?>">Modificar</button></td>
                </form>
                <form method="DELETE" action="componentedocdestroy">
                <td><button name="Eliminar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documento_componente; ?>">Eliminar</button></td>
                </form>
            <?php  }
            } else{  ?>
                <td>{{$fila->nom_componente}}</td>
                <td>{{$fila->descripcion}}</td>
                <td>{{$fila->opcional_componente}}</td>
                <td>{{$fila->nom_tipo}}</td>
                <form method="POST" action="componentedoc">
                <td><button name="Modificars" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documento_componente; ?>">Modificar</button></td>
                </form>
                <form method="DELETE" action="componentedocdestroy">
                <td><button name="Eliminar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documento_componente; ?>">Eliminar</button></td>
                </form>
            <?php }?>
          </tr>
          
          @endforeach     
          </tbody>
        </table>
    </div>
    <br>
<?php 
}
else{
  echo "No hay componentes registrados";
}
?>


@stop
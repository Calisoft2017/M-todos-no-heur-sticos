@extends('layouts.principal')


@section('navegacion')
<div class="titulo">ESTUDIANTE</div>
<div class="contenedor-tabla100">
  <table><tr>
    <form method="POST" action="datosEstudiante">
      <input type="hidden" name="id_estudiante" id="id_estudiante">
      <th  style="width: 33.33%;"><button name="datosEvaluador" class="" id="menu_boton" onclick="guardar2(this)" value="">ver datos</button></th>
    </form>
    <form method="POST" action="documentosproyecto">
    <input type="hidden" name="h_id_usuario" id="h_id_usuario">
      <th><button name="subirDocumento" class="menu_est" id="menu_boton" onclick="guardar_id_usuario(this)" value="">Subir documentación</button></th>
    </form>
    <form method="POST" action="verEvaluador">
      <input type="hidden" name="id_usuario" id="id_usuario">
      <th  style="width: 33.33%;"><button name="verEvaluador" class="menu_est" id="menu_boton" onclick="guardar(this)" value="">Ver evaluacion</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >

<?php if($id_proyecto=="" || !isset($id_proyecto)){
header('Location: ../estudiante');
}
 ?>

<form name="form" method="POST" action="subirdocumentos" enctype="multipart/form-data">
   <table>
    <tbody>
    <tr><th>Subir documentación del proyecto</th></tr>
      <tr><td>
        <label for="drop-down-1" class="texto-control-formulario texto-lista-desplegable">Tipo de documento</label>
             <select id="drop-down-1" name="id_tipo_documento" id="id_tipo_documento" onchange="seleccionada()" required>      
             <option value="">Seleccionar</option>   
                 <?php $a = Array(); $b = Array(); $c = Array(); $q = Array();?>
                  @foreach($tipoDocumento as $tipo)
                  <?php  array_push($a,$tipo->id_tipo_documento);    ?>
                      @foreach($documentosproyecto as $docpro)
                      <?php if($tipo->id_tipo_documento==$docpro->id_tipo_documento && $tipo->id_tipo_documento!=7){
                            array_push($b,$tipo->id_tipo_documento);
                          }
                      ?>
                       @endforeach  
                  @endforeach   
                  <?php
                     $a = array_unique($a);
                     $b = array_unique($b);
                     $c = array_diff($a, $b);
                  ?>
                  @foreach($tipoDocumento as $tipo)
                  <?php  foreach ($c as $value) {
                    if($tipo->id_tipo_documento==$value){ ?>
                      <option value="{{$tipo->id_tipo_documento}}">{{$tipo->nom_tipo}}</option>
                  <?php }
                  }
                  ?>
                  @endforeach    
              </select> 
      <div style="margin-top:0.5%;">
        <label for="drop-down-1" class="texto-control-formulario texto-lista-desplegable">T&iacute;tulo del documento</label>
        <input type="text" name="nombre_documento" id="nombre_documento" placeholder="T&iacute;tulo del documento" maxlength="25" required/></span></div>
      <div style="margin-top:0.5%;"><input type="file" name="url_documento" accept="application/pdf" required/></span></div>
      <div style="color:#FF0000;">{{$mensaje}}</div>
      <br><div><button class="boton-grande" id="registro_boton">Agregar</button></div></th></tr>
    </tbody>
  </table>
  <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$id_proyecto}}"> 
</form>
<br><br><br>

<?php 
if(count($documentosproyecto) > 0){   
?>
<div class="contenedor-tabla100">
  <table>
    <tbody>
    <tr>
      <th>Documento</th>
      <th colspan="2">Operaciones</th>
    </tr>
    @foreach($documentosproyecto as $fila)
    <tr>
      <?php 
      if(isset($_POST['Modificar'])){ 
              if($_POST['Modificar'] == $fila->id_documentos_proyecto){ ?>
                <form method="POST" action="subirdocumentosupdate" enctype="multipart/form-data">
                  <td><label for="drop-down-1" class="texto-control-formulario texto-lista-desplegable">Tipo de documento: </label>{{$fila->nom_tipo}}<br><div style="margin-top:0.5%;"><label for="drop-down-1" class="texto-control-formulario texto-lista-desplegable">T&iacute;tulo del documento: </label> <input type="text" name="nombre_documento" placeholder="Titulo documento" value="{{$fila->nombre_documento}}"autofocus required/></span></div>
                  <div style="margin-top:0.5%;"><input type="file" name="url_documento" accept="application/pdf" required/></span></div><div style="color:#FF0000;">{{$mensaje}}</div></td>
                  <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$fila->id_proyecto}}"> 
                  <td><button name="Aceptar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Aceptar</button></td>
                </form>
                <form method="POST" action="documentosproyecto">
                <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$fila->id_proyecto}}">
                  <td><button name="Cancelar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Cancelar</button></td>
                </form>
      <?php }else{ ?>
          <td><?php if($fila->nom_tipo=="Anexos"){ echo '<a target="_blank" href=../Documentacion/'.$fila->url_documento.'>'.$fila->nom_tipo.": ".$fila->nombre_documento.'</a>'; }else{ echo '<a target="_blank" href=../Documentacion/'.$fila->url_documento.'>'.$fila->nom_tipo.'</a>'; }?></td>
          <form method="POST" action="documentosproyecto">     
          <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$fila->id_proyecto}}"> 
          <td colspan="2"><button name="Modificar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Modificar</button></td>
          </form>
      <?php  }
      } else{  ?>
          <td><?php if($fila->nom_tipo=="Anexos"){ echo '<a target="_blank" href=../Documentacion/'.$fila->url_documento.'>'.$fila->nom_tipo.": ".$fila->nombre_documento.'</a>'; }else{ echo '<a target="_blank" href=../Documentacion/'.$fila->url_documento.'>'.$fila->nom_tipo.'</a>'; }?></td>
      <form method="POST" action="documentosproyecto">
          <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$fila->id_proyecto}}">
      <td colspan="2"><button name="Modificar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Modificar</button></td>
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


<script type="text/javascript">
	function seleccionada(){
		var posicion=document.getElementById("drop-down-1").options.selectedIndex; 
		var opcion_lita_texto = document.getElementById("drop-down-1").options[posicion].text;
		var opcion_lita_valor = document.getElementById("drop-down-1").value;
		if(opcion_lita_texto !='Anexos' || opcion_lita_valor!='7' ){
		document.getElementById("nombre_documento").value = document.getElementById("drop-down-1").options[posicion].text;
		//document.getElementById("nombre_documento").readonly= true;
		}
		if(opcion_lita_texto =='Anexos' || opcion_lita_valor=='7' ){
		//document.getElementById("nombre_documento").readonly= false;
		document.getElementById("nombre_documento").value = '';
		}
		//console.log('#', document.getElementById("drop-down-1").options[posicion].text);
	}
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 3) {
        window.open('calidad/public/','_self');
      }
    };
    function guardar(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_usuario").value = parseInt(sessionStorage['id_usuario']);
      }
      else{
        alert("Error, repita el proceso");
        window.open('/','_self');
      }
    }
    function guardar2(element){
      if (sessionStorage.getItem('id_usuario') != null) {
        document.getElementById("id_estudiante").value = sessionStorage['id_usuario'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('evaluador','_self');
      }
    }
    function guardar_id_usuario(element){
        document.getElementById("h_id_usuario").value = sessionStorage['id_usuario'];
    }

</script>
@stop
@extends('layouts.principal')

@section('navegacion')
  <div>
    <div>
      <form method="POST" action="evaluacionPlataforma">
      <input type="hidden" name="id_evaluador" id="id_evaluador">
      <input type="hidden" name="id_usuario" id="id_usuario">
        <input style="height: 40px; width: 50px; cursor: auto; float: left; box-shadow: none;border: none;" type="image" name="valor" src="../img/btnAtras.png" onclick="atras(this)"/>
      </form>
    </div>
    <div class="titulo">VER EVALUACIÓN</div>
  </div>
  
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >
<div class="titulo">Evaluación de la plataforma</div>
	<div class="registro_titulo_div">Resultado del caso de prueba</div> 
	<?php
 	if(count($pruebas) > 0){   
  	?>
	    <div class="detalles_caso_prueba">
	    	<table><tbody>
	    		<tr><th>Detalles de las pruebas</th></tr>
	    	</tbody></table>
	    	@foreach($pruebas as $fila)
		        <table>
		          	<tbody>
		          		<tr>
		          			<th class="th_proyectos">Nombre de la prueba</th>
		          			<td>{{$fila->name_Prueba}}</td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Estado</th>
		          			<?php if($fila->estado == "Aprobado"){   
	  						?>
		          			<td style="color:green;">{{$fila->estado}}</td>
		          			<?php } else{ 
	  						?>
	  						<td style="color:red;">{{$fila->estado}}</td>
	  						<?php } 
	  						?>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Observaciones</th>
		          			<td>{{$fila->observacion}}</td>
		          		</tr>
		          	 	
		          	</tbody>
		        </table>
		        <br>
	        @endforeach 
	    </div>
	<?php 
	    }
	    else{
	      echo "No hay califiacion de la prueba";
	    }
	  ?>
	  
  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 3) {
        alert("No ha iniciado sesion");
        window.open('calidad/public/','_self');
      }
    };
    function atras(element){
      if (sessionStorage.getItem('id_evaluador') != null) {
        if (sessionStorage.getItem('id_usuario') != null) {
          document.getElementById("id_usuario").value = parseInt(sessionStorage['id_usuario']);
          document.getElementById("id_evaluador").value = sessionStorage['id_evaluador'];
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
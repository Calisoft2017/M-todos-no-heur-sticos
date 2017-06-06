@extends('layouts.principal')


@section('navegacion')
  <div>
        <div>
      <form method="POST" action="evaluarPlataforma">
            <input type="hidden" name="id_proyecto" id="id_proyecto2">
      		<input type="hidden" name="id_usuario" id="id_usuario2">
              <input style="height: 40px; width: 50px; cursor: auto; float: left; box-shadow: none;border: none;" type="image" name="valor" src="../img/btnAtras.png" onclick="guardar2(this)"/>
          </form>
        </div>
    <div class="titulo">Evaluar plataforma</div>
  </div>
@stop

@section('content')
	<link href="../css/registro.css"rel="stylesheet" type="text/css" >
    <div class="registro_titulo_div">CASOS DE PRUEBA</div> 

	<?php
 	if(count($casoPrueba) > 0){   
  	?>
	    <div class="registro_titulo_div">Detalles del caso de prueba</div> 
	    <div class="detalles_caso_prueba">
	    	<table><tbody>
	    		<tr><th>Detalles de caso de prueba</th></tr>
	    	</tbody></table>
	        <table>
	          	<tbody>
	          		@foreach($casoPrueba as $fila)

  		      	   <?php
			 		if(isset($_POST['modificar'])){
			  	   ?>
				<form method="POST" action="modificarCasoprueba">
			  	   		<tr>
		          			<th class="th_proyectos">Nombre del caso de prueba</th>
		          			<td><input type="text" id="txtDate" name="name_casoPrueba" value="{{$fila->name_casoPrueba}}" placeholder="Fecha limite para la entrega del caso de prueba" autofocus required /></td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Propósito</th>
	          				<td><input type="text" id="txtDate" name="proposito" value="{{$fila->proposito}}" placeholder="Fecha limite para la entrega del caso de prueba" autofocus required /></td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Objetivo</th>
	          				<td><input type="text" id="txtDate" name="objetivo" value="{{$fila->objetivo}}" placeholder="Fecha limite para la entrega del caso de prueba" autofocus required /></td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Alcance</th>
	          				<td><input type="text" id="txtDate" name="alcance" value="{{$fila->alcance}}" placeholder="Fecha limite para la entrega del caso de prueba" autofocus required /></td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Resultado esperado</th>
	          				<td><input type="text" id="txtDate" name="resultadosEsperados" value="{{$fila->resultadoEsperado}}" placeholder="Fecha limite para la entrega del caso de prueba" autofocus required /></td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Prioridad</th>
	          				<td><div style="margin-top:0.5%;"><select style="width: 62%; margin-left: 10px;" name="prioridad" value="{{$fila->prioridad}}" placeholder="Prioridad" autofocus required>
						        <option value="alta">alta</option>
						        <option value="media">media</option>
						        <option value="baja">baja</option>
						    </select></div></td>
		          		</tr>
      			   <?php
			 		} 
			 		else{
			  	   ?>
	          			<tr>
		          			<th class="th_proyectos">Nombre del caso de prueba</th>
		          			<td>{{$fila->name_casoPrueba}}</td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Propósito</th>
		          			<td>{{$fila->proposito}}</td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Objetivo</th>
		          			<td>{{$fila->objetivo}}</td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Alcance</th>
		          			<td>{{$fila->alcance}}</td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Resultado esperado</th>
		          			<td>{{$fila->resultadoEsperado}}</td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Criterios de evaluación</th>
		          			<td>{{$fila->criteriosEvaluacion}}</td>
		          		</tr>
		          		<tr>
		          			<th class="th_proyectos">Prioridad</th>
		          			<td>{{$fila->prioridad}}</td>
		          		</tr>
      			   <?php
		 			} 
			  	   ?>

		          		

	          		<tr>
      		      	   <?php
				 		if(isset($_POST['cambiarFecha'])){
				  	   ?>
					  		<th class="th_proyectos">Fecha limite</th>
		          			<td><input type="date" id="txtDate" name="fecha_limite" value="" placeholder="Fecha limite para la entrega del caso de prueba" autofocus required /></td>
          			   <?php
				 		} 
				 		else{
				  	   ?>
		          			<th class="th_proyectos">Fecha limite</th>
		          			<td>{{substr($fila->fecha_limite,0, 10)}}</td>
          			   <?php
			 			} 
				  	   ?>
	          		</tr>

	          		   <?php
				 		if($casoPrueba[0]->txt != "_"){
				  	   ?>
	          		<tr>
	          			<th class="th_proyectos">Observaciones de estudiante</th>
	          			<td>{{$fila->observacionEstudiante}}</td>
	          		</tr>
	          		<?php
				 		} 
				  	?>

	          	@endforeach  
	          	</tbody>
	        </table>
	      	   <?php
		 		if(isset($_POST['modificar'])){
		  	   ?>
				    	<input type="hidden" name="caso" id="caso" value="<?php echo $fila->id_casoPrueba; ?>">
				    	<th><button name="aceptar" class=""  id="menu_boton">Actualizar caso de prueba</button></th>
				</form>
			   <?php
		 		} 
		 		else{
		  	   ?>
				  	
  			   <?php
	 			} 
		  	   ?>
	    </div>
	    <br>
	    <div>
	    <?php
	 		if($casoPrueba[0]->estado == "evaluar"){ 
	  	?>
		    <form method="POST" action="escenarioCasoprueba">
            	<input type="hidden" name="id_casoPrueba" id="id_casoPrueba">
		    	<th><button style="width: 40%" name="crearCasoPrueba" onclick="guardar(this)" class="" id="menu_boton">Realizar escenario de prueba</button></th>
		    </form>
		    <?php
		           }
	 		if($casoPrueba[0]->estado == "cargar"){ 
	 		     ?>
	 		     El estudiante a&#250n no ha cargado el archivo del caso de prueba
	 		     <br><br>
	 		     <?php
	 			if(isset($_POST['cambiarFecha'])){
	 			?>
	 				<form method="POST" action="cambiarFecha">
		 				<input type="hidden" name="id_casoPrueba" id="id_casoPrueba2">
		 				<input type="hidden" name="caso" id="caso2">
				    	<th><button style="width: 40%;" name="cambiarFecha" class="" onclick="cambiar(this)" id="menu_boton">cambiar fecha</button></th>
				    </form>
	 			<?php
	 			}
	 			else{
	 		?>
				    <form method="POST" action="detallesCasoprueba">
				    	<input type="hidden" name="caso" id="caso" value="<?php echo $fila->id_casoPrueba; ?>">
				    	<th><button style="width: 40%;" name="cambiarFecha" class=""  id="menu_boton">cambiar fecha limite</button></th>
				    </form>
		    <?php
		    		}
	 		}
	 		if($casoPrueba[0]->estado == "evaluar"){ 
	  	?>
	  	<br>
	  	<form method="POST" action="terminarEvaluacion">
		    	<th><button style="width: 40%; border-radius:0px;" name="caso" class="" onclick="terminar()" value="<?php echo $fila->id_casoPrueba; ?> id="menu_boton">Terminar evaluación</button></th>
		 </form>
		 <?php }
		        if($casoPrueba[0]->estado == "terminado"){ 
		 ?>
		 <br>
	  	<form method="POST" action="nuevaEvaluacion">
		    	<th><button style="width: 40%; border-radius:0px;" name="caso" class="" onclick="terminar()" value="<?php echo $fila->id_casoPrueba; ?> id="menu_boton">Crear nueva Evaluación</button></th>
		 </form>
		 <?php }
		        if($casoPrueba[0]->entrega > 1){ 
		 ?>
		 <br>
		 <form method="POST" action="historialPruebas">
		    	<th><button style="width: 40%" name="caso" class="" value="<?php echo $fila->id_casoPrueba; ?>" id="menu_boton">Ver Historial</button></th>
		    </form>
		 <?php }
		 ?>
		 
	    </div>
    <?php 
    }
    else{
      echo "No cargo el caso de prueba";
    }
  ?>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 2) {
        alert("No ha iniciado sesion");
        window.open('/','_self');
      }
    };
    function terminar(){
    alert("La evaluación del caso de prueba se ha guardado correctamente");
    }
    
    function guardar(element){
      if (sessionStorage.getItem('id_casoPrueba') != null) {
        document.getElementById("id_casoPrueba").value = sessionStorage['id_casoPrueba'];
      }
      else{
        alert("Error, repita el proceso");
        window.open('evaluador','_self');
      }
    }
    function cambiar(element){
      if (sessionStorage.getItem('id_casoPrueba') != null) {
        document.getElementById("id_casoPrueba2").value = sessionStorage['id_casoPrueba'];
        document.getElementById("caso2").value = document.getElementById('txtDate').value;
      }
      else{
        alert("Error, repita el proceso");
        window.open('evaluador','_self');
      }
    }

    function guardar2(element){
      if (sessionStorage.getItem('id_proyecto') != null) {
	      if (sessionStorage.getItem('id_usuario') != null) {
	        document.getElementById("id_usuario2").value = sessionStorage['id_usuario'];
        	document.getElementById("id_proyecto2").value = sessionStorage['id_proyecto'];
	      }
	      else{
	        alert("Error, repita el proceso");
	        window.open('/','_self');
	      }
      }
      else{
        alert("Error, repita el proceso");
        window.open('evaluador','_self');
      }
    }
  </script>
@stop

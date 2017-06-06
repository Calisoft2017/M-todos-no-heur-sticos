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
<div class="titulo">CASOS DE PRUEBA</div>
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
	          		<tr>
	          			<th class="th_proyectos">Fecha limite</th>
	          			<td>{{substr($fila->fecha_limite,0, 10)}}</td>
	          		</tr>
	          	@endforeach  
	          	</tbody>
	        </table>
	    </div>
	    <br>
	    
	    <?php
	 		if($casoPrueba[0]->estado == "cargar"){
	 			$hoy = date("Y-m-d H:i:s", time() - 86400);  

	 			$fecha_limite = date('Y-m-d H:i:s',strtotime($casoPrueba[0]->fecha_limite));

				//echo $hoy;
				//echo ($fecha_limite <= $hoy) ? 'si' : 'no';
	 			if($fecha_limite >= $hoy){
	  	?>
	  	<div>
			<form enctype="multipart/form-data" action="guardarPrueba" method="POST">
			     <input  type="hidden" name="prueba" id="prueba" value="hola" />
			    Enviar este fichero: <input style="width:40%" name="fichero_usuario" type="file" onchange="processFiles(this.files)"/>
			    <br><br><textarea name="observaciones" id="" cols="90" rows="10" placeholder="observaciones" required></textarea>
			    <button name="enviar" style="width:40%; height: 30px;" id="registro_boton" value="<?php echo $casoPrueba[0]->id_casoPrueba ?>">Enviar fichero</button>
			</form>
		</div>
		<?php
				}
	 		}
	 		else{
	 			if(count($pruebas) > 0){   
	  	?>
	    <div >
		    <form method="POST" action="resultadoCasoPrueba">
		    	<th><button style="width: 40%" name="caso" class="" value="<?php echo $casoPrueba[0]->id_casoPrueba ?>" id="menu_boton">ver evaluación de las pruebas</button></th>
		    </form>
	    </div>
	    <?php
	    		}
	 		}
	  	?>
	    <br>
    <script>
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
            function processFiles(files) {
            var file = files[0];
            var reader = new FileReader();

                reader.onload = function (e) {
                    var comillas= replaceAll('\\"','$$$12@',e.target.result);
                    console.log('c: '+comillas); 
                    console.log("a: "+replaceAll("'",'$$12@',comillas));
                    document.getElementById('prueba').value=replaceAll("'",'$$12@',comillas);
                    alert('el documento se ha cargado correctamente');
                };
                function replaceAll(find, replace, str) 
                {
                  while( str.indexOf(find) > -1)
                  {
                    str = str.replace(find, replace);
                  }
                  return str;
                }
	            reader.readAsText(file);
            }

        </script>	
    <?php 
    }
    else{
      echo "No hay peticiones de registros";
    }
  ?>
@stop
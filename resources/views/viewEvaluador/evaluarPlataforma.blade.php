@extends('layouts.principal')


@section('navegacion')
  <div>
        <div>
      <form method="POST" action="realizarEvaluacion">
            <input type="hidden" name="id_usuario" id="id_usuario">
              <input style="height: 40px; width: 50px; cursor: auto; float: left; box-shadow: none;border: none;" type="image" name="valor" src="../img/btnAtras.png" />
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
	    <div class="contenedor-tabla100">
	        <table>
	          <tbody><tr>
	          <th>Nombre del caso de prueba</th>
	          <th>Ver detalles</th>
	          </tr>
	          @foreach($casoPrueba as $fila)
	          <tr>
	            <td>{{$fila->name_casoPrueba}}</td>
	            <form method="POST" action="detallesCasoprueba">
	            	<td><button name="caso" class="boton-small" id="registro_boton" onclick="guardar(this)" value="<?php echo $fila->id_casoPrueba; ?>">Aceptar</button></td>
	            </form>
	          </tr>
	          
	          @endforeach     
	          </tbody>
	        </table>
	    </div>
    <?php 
    }
    else{
      echo "No hay casos de prueba creados";
    }
  ?>
    <form method="POST" action="crearCasoprueba">
    	<th><button name="crearCasoPrueba" class="" id="menu_boton">Crear caso de prueba</button></th>
    </form>
    

    <br>
    <div class="registro_titulo_div">Reportes</div> 

    <div>
      <table><tbody>
        <tr>
          <td>
            <form method="POST" action="reporte_gestionEva/1" target="_blank">
                    <input type="hidden" name="id_proyecto" id="id_proyecto2">
                  <input type="hidden" name="id_usuario" id="id_usuario2">
              <button name="reporte_gestionEva" id="verReporte_boton" onclick="reporte(this)">Ver reporte gestión de pruebas</button>
            </form>
          </td>
          <td>
            <form method="POST" action="reporte_gestionEva/2" target="_blank">
                    <input type="hidden" name="id_proyecto" id="id_proyecto3">
                  <input type="hidden" name="id_usuario" id="id_usuario3">
              <button name="reporte_gestionEva" id="verReporte_boton" onclick="reporte2(this)">Descargar reporte gestión de pruebas</button>
            </form>
            </td>
        </tr></tbody>
      </table>
    </div>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 2) {
        window.open('/','_self');
      }
    };
    
    function guardar(element){
    	sessionStorage['id_casoPrueba']=element.value;
    }

    function guardar2(element){
        sessionStorage['id_proyecto']=element.value;
    }
    function reporte(element){
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
    function reporte2(element){
      if (sessionStorage.getItem('id_proyecto') != null) {
        if (sessionStorage.getItem('id_usuario') != null) {
          document.getElementById("id_usuario3").value = sessionStorage['id_usuario'];
          document.getElementById("id_proyecto3").value = sessionStorage['id_proyecto'];
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
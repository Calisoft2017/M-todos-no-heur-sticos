@extends('layouts.principal')


@section('navegacion')
  <div>
        <div>
      <form method="POST" action="detallesCasoprueba">
      	@foreach($casoPrueba as $fila)
      		<input type="hidden" name="caso" value="{{$fila->id_casoPrueba}}" >
        @endforeach  
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
	
<div class="detalles_caso_prueba">
		        <table><tbody>
		          <tr><th>Entrega N° 1</th></tr>
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
<script>
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
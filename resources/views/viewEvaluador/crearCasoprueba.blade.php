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
  <div class="titulo">Datos de caso de prueba</div>

  <form method="POST" action="createCasoPrueba">
    <div style="margin-top:0.5%;"><input type="text" name="name_casoPrueba" placeholder="Nombre del casos de prueba" autofocus required/></span></div>
    <div style="margin-top:0.5%;"><input type="text" name="proposito" placeholder="Proposito" autofocus required/></span></div>
    <div style="margin-top:0.5%;"><input type="text" name="objetivo" placeholder="Objetivo" autofocus required/></span></div>
    <div style="margin-top:0.5%;"><input type="text" name="alcance" placeholder="Alcance" autofocus required/></span></div>
    <div style="margin-top:0.5%;"><input type="text" name="resultadosEsperados" placeholder="Resultados esperados" autofocus required/></span></div>
    <div style="margin-top:0.5%;"><textarea name="criterios" style="width: 60%; margin-left: 10px;"  placeholder="Criterios de evaluación" autofocus required/></textarea></span></div>
    <div style="margin-top:0.5%;"><select style="width: 62%; margin-left: 10px;" name="prioridad" placeholder="Prioridad" autofocus required>
        <option value="alta">alta</option>
        <option value="media">media</option>
        <option value="baja">baja</option>
    </select></div>
    <div style="margin-top:0.5%;"><input type="date" id="txtDate" name="fecha_limite" placeholder="Fecha limite para la entrega del caso de prueba" autofocus required maxlength="10"/></span></div>
    <br>
    <input type="hidden" name="id_proyecto" id="id_proyecto">
    <input type="hidden" name="id_usuario" id="id_usuario">
    <div><button onclick="guardar(this)" class="boton-grande" id="registro_boton">Guardar</button></div>
  </form>

  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 2) {
        alert("No ha iniciado sesion");
        window.open('calidad/public/','_self');
      }
      var dtToday = new Date();

      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate() +1;
      var year = dtToday.getFullYear();

      if(month < 10)
          month = '0' + month.toString();
      if(day < 10)
          day = '0' + day.toString();

      var minDate = year + '-' + month + '-' + day;    
      $('#txtDate').attr('min', minDate);
    };
    
    function guardar(element){
      if (sessionStorage.getItem('id_proyecto') != null) {
        if (sessionStorage.getItem('id_usuario') != null) {
          document.getElementById("id_usuario").value = sessionStorage['id_usuario'];
          document.getElementById("id_proyecto").value = sessionStorage['id_proyecto'];
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

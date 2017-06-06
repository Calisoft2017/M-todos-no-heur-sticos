@extends('layouts.principal')


@section('navegacion')
<div class="titulo">REGISTRO</div>
<div class="contenedor-tabla100">
  <table><tr>
	<form method="POST" action="registroProyecto">
		<th><button name="registroProyectos" class="" id="menu_boton">Registrar proyecto</button></th>
	</form>
    <form method="POST" action="registroEvaluador">
    	<th><button name="registroEvaluador" class="" id="menu_boton">Registrar evaluador</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
	<link href="../css/registro.css"rel="stylesheet" type="text/css" >
	<div class="registro_titulo">REGISTRAR PROYECTO</div>
	<div>
		<div class="registro_contenido">
			<div class="registro_titulo_div">PROYECTO</div> 
	<form method="POST" action="createProyecto" id="enviar_clave">
			<div><input type="text" name="name_proyecto" placeholder="Nombre del proyecto" autofocus required maxlength="100"/></div>
			<div style="margin-top:0.5%;"><input type="text" name="name_investigacion" placeholder="Grupo de investigación" autofocus required maxlength="50"/></span></div>
			<div style="margin-top:0.5%;"><input type="text" name="name_semillero" placeholder="Semillero" autofocus required maxlength="50"/></span></div>
	        <div>
	        <label>Tipo de proyecto: </label>
			<select name="id_categoria" id="id_categoria" style="    border-radius: 0;    height: 30px;    margin: 10px;">
			  <?php 
			foreach($categoria as $cat){
			  ?>
			  <option value="{{$cat->id_categoria}}">{{$cat->name_categoria}}</option>
			  <?php 
			}
			  ?>
			</select>
			</div>  
		</div>
		<div class="registro_contenido">
			
			<div class="registro_titulo_div">INTEGRANTES</div> 
			   <div class="grupo-controles-formulario">
	            <div class="controles-formulario">
	              <label for="" class="texto-control-formulario texto-grupo-radiobutton">Numero de integrantes:</label>
	              <div class="radiobutton-bloque">
	                <div class="control-radiobutton"><input type="radio" name="radio-button" id="radio-uno" value="1"/><label for="radio-uno" class="radiobutton-label"></label></div><span class="radiobutton-texto">Uno</span>
	              </div>
	              <div class="radiobutton-bloque">
	                <div class="control-radiobutton"><input type="radio" name="radio-button" id="radio-dos" value="2"/><label for="radio-dos" class="radiobutton-label"></label></div><span class="radiobutton-texto">Dos</span>
	              </div>
	            </div>
	          </div>
	        <div id="registro_integrante1" style="width: 100%;">
				<div style="margin-top:0.5%;"><input type="text" name="nombre" placeholder="Nombre" autofocus required maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input type="text" name="apellido" placeholder="Apellido" autofocus required maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input type="email" name="correo" placeholder="Correo" autofocus required maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input type="number" name="id_usuario" placeholder="Código" autofocus required min="0" max="99999999999"/></div>
				<div style="margin-top:0.5%;"><input type="text" name="nom_usuario" placeholder="Nombre de usuario" autofocus required maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input type="password" name="contrasena" id="contrasena" placeholder="contraseña" autofocus required maxlength="20"/></div>
			</div>
	    	<div id="registro_integrante2" style="visibility: hidden;">
				<div style="margin-top:0.5%;"><input id="registro_nombre2" type="text" name="nombre_int2" placeholder="Nombre" autofocus maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input id="registro_apellido2" type="text" name="apellido_int2" placeholder="Apellido" autofocus maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input id="registro_correo2" type="email" name="correo_int2" placeholder="Correo" autofocus maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input id="registro_codigo2" type="number" name="id_usuario_int2" placeholder="Código" autofocus min="0" max="99999999999"/></div>
				<div style="margin-top:0.5%;"><input id="registro_usuario2" type="text" name="nom_usuario_int2" placeholder="Nombre de usuario" autofocus maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input id="registro_contrasena2" type="password" name="contrasena_int2" id="contrasena_int2" placeholder="contraseña" autofocus maxlength="20"/></div>
	    	</div>
	    </div>
	    <button class="boton-grande" id="registro_boton">Aceptar</button>
	</div>
	</form>
	<script type="text/javascript">
		window.onload = (function() {
			//nom_div("integrante2").style.visibility = "hidden";
			document.getElementById('radio-uno').checked=true;
			
			$("#enviar_clave").submit(function(event)
		      {
		                        
		        var enviaForm = true;
		        var campos = ["contrasena","contrasena_int2"];
		        for(var i = 0; i < campos.length; i++)
		        {
		            if($("#" + campos[i]).val().length === 0)
		            {
		                alert("Contraseña no valida");
		                enviaForm = false;
		                break;
		            }
		            if($("#" + campos[i]).val().length > 20)
		            {
		                alert("Contraseña no valida, debe tener maximo 20 caracteres");
		                enviaForm = false;
		                break;
		            }
		        }
		        if(enviaForm)
		        {
		            if(!validaPassword($("#new_password").val()))
		            {
		                alert("Contraseña nueva no valida, La contraseña debe tener minimo 6 caracteres y al menos un numero y una letra");
		                enviaForm = false;
		            }
		        }
		
		        return enviaForm;
		
		      });
		      
		      validaPassword = function(password){
		          var passwordReg = /(?=^.{6,}$)((?=.*\d))(?=.*[A-Za-z]).*/;
		          return passwordReg.test(password);
		      }
	    });
		$('input:radio').on('click', function(e) {
		    console.log(e.currentTarget.name); 
		    console.log(e.currentTarget.value); 
		    if(e.currentTarget.value == 2){
		    	nom_div("registro_integrante2").style.visibility = "visible";
		    	nom_div("registro_integrante1").style.width = "60%";
		    	document.getElementById("registro_nombre2").required = true;
		    	document.getElementById("registro_apellido2").required = true;
		    	document.getElementById("registro_correo2").required = true;
		    	document.getElementById("registro_codigo2").required = true;
		    	document.getElementById("registro_usuario2").required = true;
		    	document.getElementById("registro_contrasena2").required = true;
		    }
		    else{
		    	nom_div("registro_integrante2").style.visibility = "hidden";
		    	nom_div("registro_integrante1").style.width = "100%";
		    	document.getElementById("registro_nombre2").required = false;
		    	document.getElementById("registro_apellido2").required = false;
		    	document.getElementById("registro_correo2").required = false;
		    	document.getElementById("registro_codigo2").required = false;
		    	document.getElementById("registro_usuario2").required = false;
		    	document.getElementById("registro_contrasena2").required = false;
		    }
		
		});
		function nom_div(div)
		{
			return document.getElementById(div);
		}
	</script>
@stop
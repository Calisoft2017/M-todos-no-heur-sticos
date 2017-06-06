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
	<form method="POST" action="createEvaluador" id="enviar_clave">
	<link href="../css/registro.css"rel="stylesheet" type="text/css" >
	<div class="registro_titulo">REGISTRO DE EVALUADOR</div>
	<div>
		<div class="registro_contenido">
			<div class="registro_titulo_div">Datos de evaluador</div> 
	        <div id="registro_integrante1" style="width: 100%;">
				<div style="margin-top:0.5%;"><input type="text" name="nombre" placeholder="Nombre" autofocus required maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input type="text" name="apellido" placeholder="Apellido" autofocus required maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input type="email" name="correo" placeholder="Correo" autofocus required maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input type="number" name="id_usuario" placeholder="cedula" autofocus required max="99999999999"/></div>
				<div style="margin-top:0.5%;"><input type="text" name="nom_usuario" placeholder="Nombre de usuario" autofocus required maxlength="50"/></div>
				<div style="margin-top:0.5%;"><input type="password" name="contrasena" placeholder="contraseÃ±a" autofocus required maxlength="50"/></div>
			</div>
	    </div>
	    <button class="boton-grande" id="registro_boton">Aceptar</button>
	</div>
	</form>

<script type="text/javascript">
    window.onload = function() {

      $("#enviar_clave").submit(function(event)
      {
                        
        var enviaForm = true;
        var campos = ["contrasena"];
        for(var i = 0; i < campos.length; i++)
        {
            if($("#" + campos[i]).val().length === 0)
            {
                alert("Contrase«Ða no valida");
                enviaForm = false;
                break;
            }
            if($("#" + campos[i]).val().length >= 20)
            {
                alert("Contrase«Ða no valida");
                enviaForm = false;
                break;
            }
        }
        if(enviaForm)
        {
            if(!validaPassword($("#new_password").val()))
            {
                alert("Contrase«Ða nueva no valida, La contrase«Ða debe tener minimo 6 caracteres y al menos un numero y una letra");
                enviaForm = false;
            }
        }

        return enviaForm;

      });
      
      validaPassword = function(password){
          var passwordReg = /(?=^.{6,}$)((?=.*\d))(?=.*[A-Za-z]).*/;
          return passwordReg.test(password);
      }
    };
  </script>
@stop
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>PLATAFORMA CALIDAD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <link href="../css/iconos-style.css" rel="stylesheet" type="text/css"> 
    <link href="../css/estilo-base.css" rel="stylesheet" type="text/css"> 
    <script src="../js/jquery.min.2.1.1.js" type="text/javascript"></script>
    <script src="../js/color_fondo.js" type="text/javascript"></script> 
    <script src="../js/backgroundControl.js" type="text/javascript"></script>
    <script src="../js/highcharts.js" type="text/javascript"></script>
    <script type="text/javascript">
    window.onload = (function() {
       $('#titulo').each(function () {
          $(this).css({
              'font-size': ($(window).height() * 0.042)
          });
       });
       $(window).resize(function(event) {
          $('#titulo').each(function () {
            $(this).css({
                'font-size': ($(window).height() * 0.042)
            });
         });
       });
    });
    </script>
    <link rel="icon" type="image/png" href="../imagenes/ESCUDO.png"/>
    
    <style type="text/css">
        .bloque > .titulo-bloque{
            background-color: rgba(0,120,0,1);
        }
        .boton-icono:hover{
            background-color: rgb(40,197,40);
        }
        .control-checkbox > input[type="checkbox"]:checked + .checkbox-label{
            background-color:rgba(0,180,0,1); 
        }
        .control-radiobutton > input[type="radio"]:checked + .radiobutton-label{ 
            background-color:rgba(0,180,0,1); 
        }
        input[type="button"],
        input[type="submit"],
        input[type="reset"],
        button[type="reset"],
        button[type="button"],
        button[type="submit"],
        button,
        a.boton-normal{
            background-image: linear-gradient(to top,rgb(28,183,28),rgb(6,139,6));
        }
        input[type="button"]:hover,
        input[type="submit"]:hover,
        input[type="reset"]:hover,
        button[type="reset"]:hover,
        button[type="button"]:hover,
        button[type="submit"]:hover,
        button:hover,
        a.boton-normal:hover{
            background-image: linear-gradient(to bottom,transparent,transparent);
            /*background-image: linear-gradient(to bottom,rgba(0,180,180,1),rgba(0,250,250,1));*/
            background-color:  rgb(40,197,40);
        }
        input[type="button"]:active,
        input[type="submit"]:active,
        input[type="reset"]:active,
        button[type="reset"]:active,
        button[type="button"]:active,
        button[type="submit"]:active,
        button:active,
        a.boton-normal:active{
            /*background-image: linear-gradient(to bottom,transparent,transparent);*/
            box-shadow: inset 0px 2px 2px 1px rgba(0,0,0,0.5);
            background-color: rgb(40,197,40);
            border-radius: 8px;
        }
        .boton-icono{
          border:2px solid rgb(0,180,0);   
        }
        .boton-icono:active{
          background-color: rgb(40,197,40);
        }
        .grupo-controles-formulario .controles-formulario input[type="text"] + .texto-ayuda i:hover,
        .grupo-controles-formulario .controles-formulario input[type="password"] + .texto-ayuda i:hover,
        .grupo-controles-formulario .controles-formulario textarea + .texto-ayuda i:hover{
            background-color:rgb(50,150,50);
        }
        form select option:nth-child(2n){
            
        } 
    </style>
  </head> 
  <body>
    <div id="fondo-titulo">
      <div id="fondotriangulos" class="fondo">
       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <polygon id="poly1" points="" fill="#b8d19c"/>
            <polygon id="poly2" points="" fill="#009045"/>
            <polygon id="poly3" points="" fill="#006b33"/>
            <polygon id="poly4" points="" fill="#b8d19c"/>
            <polygon id="poly5" points="" fill="#07c555"/>
            <polygon id="poly6" points="" fill="#009045"/>
            <polygon id="poly7" points="" fill="#49ad3b"/>
        </svg>
      </div>
      <div id="tramafondo" class="trama">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <img class="escudo"  title="Udec" src="../imagenes/ESCUDO_UDEC.png"/>

          <img class="colombia" alt="Colombia" title="Udec" src="../imagenes/Escudo_de_Colombia.png"/>
        </svg>
      </div>     
    </div>

  <!--/fondo-titulo-->
  <div class="fondo-inicio-sesion-flotante">
    <div class="inicio-sesion-flotante">
      <form id="formulario-sesion-flotante" method="post" action="loginUsuario">
      <div class="sesion-titulo">
        <h2><i><img class="escudo-sesion"  title="Udec" src="../imagenes/ESCUDO.png"/></i>INICIO DE SESIÓN</h2>
      </div>
      <div class="sesion-cuerpo">
          <ul>
              <li><label for="usuario-flotante">Usuario</label></li>
              <li><input id="usuario-flotante" type="text" name="nom_usuario"></li>
              <li><label for="clave-flotante">Clave</label></li>
              <li><input id="clave-flotante" type="password" name="contrasena"></li> 
              <br>   
              <li><a id="" href="recuperarContrasena">Olvide mi contraseña</a></li>      
          </ul>
      </div>
      <div class="sesion-controles">
           <button id="iniciar-flotante">Iniciar</button>
           <p><a id="iniciar-registro" href="registro">Registrarse</a></p>
      </div>
      </form>
           <button id="cancelar-flotante">Cancelar</button>
    </div>
    <!--/inicio-sesion-flotante-->
  </div>
  <!--/fondo-inicio-sesion-flotante-->
  <div class="principal-pagina pos-z-top">
    <center><div id="titulo">PLATAFORMA WEB PARA LA EVALUACIÓN DE PRODUCTOS SOFTWARE</div></center>
    <div class="barra-menu pos-z-top">
        <div class="datos-usuario">
            <div class="imagen-usuario">
              <span>
                <input style="height: 100%; width: 100%;  margin-left: -10%;" type="image" name="imagen" value="Guardar" src="../imagenes/usuario.jpeg" onclick="menu_rol()"/>
              </span>
            </div>
            <div class="info-basica">
                  <span class="datos-usuario-nombre" id="nombre_user" name="nombre_user">Nombre</span>
                  <span class="datos-usuario-apellido" id="apellido_user" name="apellido_user">Apellido</span>
                  <span class="datos-usuario-rol" id="rol_user" name="rol_user">Rol</span>
                  <div id="cerrar_sesion" style="visibility: hidden;">
                    <a class="icon-home salir" href="cerrarSession">Salir</a>
                  </div>
            </div>
            <div class="iniciar-login">
                <a id="inicio-flotante" href="#" >
                  <span class="datos-usuario-nombre" id="log-in" name="nombre_user">Inciar sesión</span>
                </a>
            </div>
        </div>
        <!--/datos-usuario-->
        <div class="menu-modulos">
          <ul>
            @yield('menu')
            <li>    
              <div style="background-color: rgb(0, 187, 0);" class="modulo-base">
                <span>Acceso rápido</span>
                <a class="desplegar-menu icon-minus" href="#"></a><p></p>
              </div><!--/modulo-base-->
              <div style="background-color: rgb(0, 107, 0);" class="sub-menu-modulo mostrar">
                  <ul>
                  <li><input name="color-modulo" id="color-modulo" value="00bb00" type="hidden"></li>
                  <li><a id="" href="/">inicio</a></li>
                  <li  onclick="menu_rol()"><a id="" href="#">menú de usuario</a></li>
                  <li><a id="" href="">manuales</a></li>
                  </ul>
              </div>
            </li>
            <li>    
              <div style="background-color: rgb(0, 187, 0);" class="modulo-base"><span>Links de interés</span><a class="desplegar-menu icon-minus" href="#"></a><p></p></div><!--/modulo-base-->
              <div style="background-color: rgb(0, 107, 0);" class="sub-menu-modulo mostrar">
                  <ul>
                  <li><input name="color-modulo" id="color-modulo" value="00bb00" type="hidden"></li>
                  <li><a id="" href="">unicundi</a></li>
                  <li><a id="" href="">plataforma</a></li>
                  <li><a id="" href="">facultad</a></li>
                  
                  </ul>
              </div>
            </li>
            <div><center><img style="margin-top:5px; border-radius:8px; box-shadow:2px 2px 5px gray;" src="../imagenes/facatativa.jpg" width="98%"></center></div> 
          </ul>
        </div>
        <!--/menu-modulos-->
    </div>
    <!--/barra-menu-->
    <div class="barra-navegacion pos-z-top">
      @yield('navegacion')
      
    </div>
    <!--/barra-navegacion-->
    <div class="panel-contenido pos-z-top" >
        
      <!--<div class="principal-panel-contenido texto-centro" style="overflow-x:auto; overflow-y:visible;">-->
        <div class="principal-panel-contenido texto-centro" style="overflow-x:visible; overflow-y:visible;">

          @yield('content')
          <?php if(isset($b1)){
          ?>
          <p>Presione uno de los menus en la parte izquierda.</br> 
          Este texto solo es de prueba para informar el funcionamiento basico.</br>
          Pagina funcional 100% css en firefox -  agregando css para otros navegadores.</br>
          Probando tildes á é í ó ú Á É Í Ó Ú ñ Ñ</p>
          <p>Hay muchos motivos por los que convertir los iconos de tu web en una sola fuente es una muy buena idea
                Una de ellas es que así conseguimos reducir drásticamente el peso, y por lo tanto acelerar el tiempo de carga de la web 
                hasta un 14%. Otra razón es la versatilidad que supone a la hora de desarrollar la web, ya que añadir un icono se reduce 
                 introducir una simple línea de HTML y además te ofrece todas las ventajas de tratar ese icono como una fuente en CSS, 
                 pudiendo cambiar el tamaño o color en cualquier momento, sin tener que subir las imágenes por FTP una y otra vez. </p>
          <?php 
          }
          ?>
        </div>
        

        <!--/principal-panel-contenido-->
    </div>
    <!--/panel-contenido-->
    <div class="footer" style="background-image:url('../img/footer.jpg');">
      <center>
      <div class="nombres1" style="left:55%;">
        <div>Cesar Yesid Barahona</div>
        <div>Andres David Monroy</div>
        <div>John Fredy acosta</div>
        <div>Yeison David Ruiz</div>
      </div>
      <div class="nombres2" style="left:10%;">
        <center>
        <div>Ingeniería de sistemas</div>
        <div>Grupo de investigación GISTFA</div>
        <div>Facatativá</div>
        <div>2016</div>
        </center>
      </div>
    </center>
    </div>
    <!--/footer-->
  </div>
  <!--/principal-pagina-->
  </body>
</html>
<script type="text/javascript">
  $( document ).ready(function() {
      if (sessionStorage.getItem('id_rol') != null && sessionStorage.getItem('id_rol') != "null") {
        document.getElementById("log-in").innerHTML  = "";
        document.getElementById("nombre_user").innerHTML  = sessionStorage['nombre'];
        document.getElementById("apellido_user").innerHTML  = sessionStorage['apellido'];
        if (sessionStorage['urlImagen'] == "null" || sessionStorage['urlImagen'] == "") {
          document.getElementsByName("imagen")[0].src = "../imagenes/usuario.jpeg";
        }
        else{
          document.getElementsByName("imagen")[0].src = "imagenUsuario/" + sessionStorage['urlImagen'];
        }
        if(sessionStorage['id_rol'] == 1){
          document.getElementById("rol_user").innerHTML  = "Administrador";
        }
        else if(sessionStorage['id_rol'] == 2){
          document.getElementById("rol_user").innerHTML  = "Evaluador";
        }
        else if(sessionStorage['id_rol'] == 3){
          document.getElementById("rol_user").innerHTML  = "Estudiante";
        }
        nom_div("cerrar_sesion").style.visibility = "visible";
      }
      else{
        document.getElementById("nombre_user").innerHTML  = "";
        document.getElementById("apellido_user").innerHTML  = "";
        document.getElementById("rol_user").innerHTML  = "";
        nom_div("cerrar_sesion").style.visibility = "hidden";
        document.getElementsByName("imagen")[0].src = "../imagenes/usuario.jpeg";
      }
  });
  function menu_rol(){
    if (sessionStorage.getItem('id_rol') != null) {
      window.open('menuRol/'+sessionStorage.getItem('id_rol'),'_self');
    }
    else{
      alert("no ha iniciado sesion intentelo de nuevo");
      window.open('calidad/public/','_self');
    }
  }
    function nom_div(div)
    {
      return document.getElementById(div);
    }
</script>
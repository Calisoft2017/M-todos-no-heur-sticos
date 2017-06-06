@extends('layouts.principal')

@section('navegacion')
<div class="titulo">ADMINISTRADOR</div>
<div class="contenedor-tabla100">
  <table><tr>
    <form method="POST" action="datosAdministrador">
      <input type="hidden" name="id_evaluador" id="id_evaluador">
      <th><button name="actualizarDatosAdmi" class="" id="menu_boton" onclick="guardar2(this)" value="">ver datos</button></th>
    </form>
    <form method="POST" action="consultaUsuarios">
      <th><button name="Estdudiantes" class="" id="menu_boton" value="">Ver estudiantes</button></th>
    </form>
    <form method="POST" action="consultaEvaluadores">
      <th><button name="Evaluadores" class="" id="menu_boton" value="">Ver evaluadores</button></th>
    </form>
    <form method="POST" action="consultaPeticiones">
      <th><button name="peticiones" class="" id="menu_boton" value="">Ver peticiones</button></th>
    </form>
  </tr></table>
  <table><tr>
    <form method="POST" action="consultaProyectos">
      <th><button name="proyectos" class="" id="menu_boton" value="">Ver datos de los proyectos</button></th>
    </form>
    <form method="POST" action="categorizacion">
      <input type="hidden" name="id_evaluador" id="id_evaluador">
      <th><button name="categorizacion" class="" id="menu_boton" value="">categorización de los proyectos</button></th>
    </form>
    <form method="POST" action="configuracionPorcentajes">
      <th><button name="porcentajes" class="" id="menu_boton" value="">Ver configuración de porcentajes</button></th>
    </form>
  </tr></table>
</div> 
@stop

@section('content')
<link href="../css/registro.css"rel="stylesheet" type="text/css" >


<?php 
    if(count($porcentajes) > 0){ 
      
      $datos = array();
      $i = 0;
      foreach($porcentajes as $porc){
          $datos[$i] = $porc->valor;
          $i++;
      }

?>  
        <center>
          <div class="titulo">CONFIGURACIÓN DE PORCENTAJES</div>

          <form id="form" name="form" method="post" action="configuracionPorcentajes">
          <select name="test" id="test" style="    border-radius: 0;    height: 30px;    margin: 10px;">
              <?php 
            foreach($categoria as $cat){
              ?>
              <option value="{{$cat->id_categoria}}">{{$cat->name_categoria}}</option>
              <?php 
            }
              ?>
          </select>
          <input type="submit" name="btnAceptar" style="width: 30%;" id="btn_actualizar" value="Ver porcentajes" />
          </form>
          <?php  
            if (isset($_POST['btnAceptar'])) {
              echo "<script type=\"text/javascript\">document.getElementById('test').value = '". $_POST['test'] . "';</script>";
              $var = $_POST['test'];
              foreach($categoria as $cat){
                if ($cat->id_categoria == $var) {
                  ?>
                    <div class="section_datos" style="width: 65%;">
                    <form method="POST" action="actualizarPorcentaje" id="actualizar_porcentajes">
                      <div class="datos_usuario_titulo">Porcentajes de evaluacion</div>
                      <div style="text-align: left;">
                        <p>Los porcentajes de  evaluación se configuran de manera que  se le da un porcentaje a la  evaluacion
                        de la plataforma y a la evaluacion de modelado, de manera que si equivalen lo mismo cada uno tendra
                        un  porcentaje de 50% y 50%,  en caso de que la evaluacion de la plataforma sea más importante se le
                        agregara un porcentaje mayor y se les restará a la evaluacion del modelado respectivamente y viceversa.</p>
                      </div>
                      <hr>
                      <div class="datos_usuario_titulo">Porcentaje de evaluacion de la plataforma.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="porcPlataforma" id="porcPlataforma" value="{{$cat->porcPlataforma}}" placeholder="porcentaje" autofocus required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Porcentaje de evaluacion del modelado.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="porcModelado" id="porcModelado" value="{{$cat->porcModelado}}" placeholder="porcentaje" required min="0" max="99999999999"/></div>
                      <br>
                      <input type="hidden" name="id_categoria" id="id_categoria" value="{{$cat->id_categoria}}">
                      <button id="btn_actualizar"  type="submit">Actualizar datos</button>
                    </form>
                  </div>
                  <br>

                  <div class="section_datos" style="width: 65%;">
                    <form method="POST" action="actualizarPrioridad" id="actualizar_prioridad">
                      <div class="datos_usuario_titulo">Porcentajes de evaluacion de la plataforma</div>
                      <div style="text-align: left;">
                        <p>En esta sección se configura el valor de los casos de prueba segun su prioridad, se le asigna un rango 
                          de 1 a 5, siendo 5 el mas importante y 1 una menor importancia.</p>
                      </div>
                      <hr>
                      <div class="datos_usuario_titulo">Prioridad alta.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="prioridadAlta"  id="prioridadAlta" value="{{$cat->prioridadAlta}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Prioridad media.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="prioridadMedia" id="prioridadMedia" value="{{$cat->prioridadMedia}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Prioridad baja.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="prioridadBaja" id="prioridadBaja" value="{{$cat->prioridadBaja}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <input type="hidden" name="id_categoria" id="id_categoria" value="{{$cat->id_categoria}}">
                      <button id="btn_actualizar" type="submit">Actualizar datos</button>
                    </form>
                  </div>
                  <br>

                  <div class="section_datos" style="width: 65%;">
                    <form method="POST" action="actualizarModelo" id="actualizar_modelos">
                      <div class="datos_usuario_titulo">Porcentajes de evaluacion del modelado</div>
                      <div style="text-align: left;">
                        <p>En esta parte de la configuración de los porcentajes se busca dar un valor a cada uno de los diagramos, 
                          el total de los porcentajes deben sumarme el 100% y un diagrama no puede ser menor del 10%.</p>
                      </div>
                      <hr>
                      <div class="datos_usuario_titulo">Diagrama de clases.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dClases" id="dClases" value="{{$cat->dClases}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Diagrama de casos de uso.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dCasos" id="dCasos" value="{{$cat->dCasos}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Diagrama de despliegue.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dDespliegue" id="dDespliegue" value="{{$cat->dDespliegue}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Diagrama de secuencias.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dSecuencias" id="dSecuencias" value="{{$cat->dSecuencias}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Diagrama de actividades.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dActividades" id="dActividades" value="{{$cat->dActividades}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Modelo Entidad Relación.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="MER" id="MER" value="{{$cat->MER}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <input type="hidden" name="id_categoria" id="id_categoria" value="{{$cat->id_categoria}}">
                      <button id="btn_actualizar" type="submit">Actualizar datos</button>
                    </form>
                  </div>
                  <?php
                }
              }
            }
            else{
              foreach($categoria as $cat){
                if ($cat->id_categoria == 1) {
                  ?>
                    <div class="section_datos" style="width: 65%;">
                    <form method="POST" action="actualizarPorcentaje" id="actualizar_porcentajes">
                      <div class="datos_usuario_titulo">Porcentajes de evaluacion</div>
                      <div style="text-align: left;">
                        <p>Los porcentajes de  evaluación se configuran de manera que  se le da un porcentaje a la  evaluacion
                        de la plataforma y a la evaluacion de modelado, de manera que si equivalen lo mismo cada uno tendra
                        un  porcentaje de 50% y 50%,  en caso de que la evaluacion de la plataforma sea más importante se le
                        agregara un porcentaje mayor y se les restará a la evaluacion del modelado respectivamente y viceversa.</p>
                      </div>
                      <hr>
                      <div class="datos_usuario_titulo">Porcentaje de evaluacion de la plataforma.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="porcPlataforma" id="porcPlataforma" value="{{$cat->porcPlataforma}}" placeholder="porcentaje" autofocus required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Porcentaje de evaluacion del modelado.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="porcModelado" id="porcModelado" value="{{$cat->porcModelado}}" placeholder="porcentaje" required min="0" max="99999999999"/></div>
                      <br>
                      <input type="hidden" name="id_categoria" id="id_categoria" value="{{$cat->id_categoria}}">
                      <button id="btn_actualizar" type="submit">Actualizar datos</button>
                    </form>
                  </div>
                  <br>

                  <div class="section_datos" style="width: 65%;">
                    <form method="POST" action="actualizarPrioridad" id="actualizar_prioridad">
                      <div class="datos_usuario_titulo">Porcentajes de evaluacion de la plataforma</div>
                      <div style="text-align: left;">
                        <p>En esta sección se configura el valor de los casos de prueba segun su prioridad, se le asigna un rango 
                          de 1 a 5, siendo 5 el mas importante y 1 una menor importancia.</p>
                      </div>
                      <hr>
                      <div class="datos_usuario_titulo">Prioridad alta.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="prioridadAlta"  id="prioridadAlta" value="{{$cat->prioridadAlta}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Prioridad media.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="prioridadMedia" id="prioridadMedia" value="{{$cat->prioridadMedia}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Prioridad baja.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="prioridadBaja" id="prioridadBaja" value="{{$cat->prioridadBaja}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <input type="hidden" name="id_categoria" id="id_categoria" value="{{$cat->id_categoria}}">
                      <button id="btn_actualizar" type="submit">Actualizar datos</button>
                    </form>
                  </div>
                  <br>

                  <div class="section_datos" style="width: 65%;">
                    <form method="POST" action="actualizarModelo" id="actualizar_modelos">
                      <div class="datos_usuario_titulo">Porcentajes de evaluacion del modelado</div>
                      <div style="text-align: left;">
                        <p>En esta parte de la configuración de los porcentajes se busca dar un valor a cada uno de los diagramos, 
                          el total de los porcentajes deben sumarme el 100% y un diagrama no puede ser menor del 10%.</p>
                      </div>
                      <hr>
                      <div class="datos_usuario_titulo">Diagrama de clases.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dClases" id="dClases" value="{{$cat->dClases}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Diagrama de casos de uso.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dCasos" id="dCasos" value="{{$cat->dCasos}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Diagrama de despliegue.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dDespliegue" id="dDespliegue" value="{{$cat->dDespliegue}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Diagrama de secuencias.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dSecuencias" id="dSecuencias" value="{{$cat->dSecuencias}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Diagrama de actividades.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="dActividades" id="dActividades" value="{{$cat->dActividades}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <div class="datos_usuario_titulo">Modelo Entidad Relación.</div>
                      <div style="margin-top:0.5%;"><input type="number" name="MER" id="MER" value="{{$cat->MER}}" placeholder="porcentaje"  required min="0" max="99999999999"/></div>
                      <br>
                      <input type="hidden" name="id_categoria" id="id_categoria" value="{{$cat->id_categoria}}">
                      <button id="btn_actualizar" type="submit">Actualizar datos</button>
                    </form>
                  </div>
                  <?php
                }
              }
            }
              ?>
                  
        </center>
       
<?php 
    } 
    else{echo "";}
?>
        
  <script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != "1") {
        window.open('/','_self');
      }

      $("#actualizar_porcentajes").submit(function(event) {
                        
        var enviaForm = true;
        var campos = ["porcPlataforma", "porcModelado"];
        for(var i = 0; i < campos.length; i++)
        {
            if($("#" + campos[i]).val() < 0)
            {
                alert("Error, debe ser un porcentaje entre 0 y 100");
                enviaForm = false;
                break;
            }
            if($("#" + campos[i]).val() > 100)
            {
                alert("Error, debe ser un porcentaje entre 0 y 100");
                enviaForm = false;
                break;
            }
        }
        if(enviaForm)
        {
            var mensaje = "";
            var porc1 = parseInt($("#" + campos[0]).val());
            var porc2 = parseInt($("#" + campos[1]).val());
            if(( porc1 + porc2) != 100)
            {
                mensaje = "Error, la suma de los dos porcentajes debe dar 100%";
                enviaForm = false;
            }
            if(enviaForm)
            {
                if(!confirm("esta seguro de actualizar los porcentajes")){
                  enviaForm = false;
                }
            }
            else{
                alert(mensaje);
            }
        }

        return enviaForm;

      });

      $("#actualizar_prioridad").submit(function(event) {
                        
        var enviaForm = true;
        var campos = ["prioridadAlta", "prioridadMedia","prioridadBaja"];
        for(var i = 0; i < campos.length; i++)
        {
            if($("#" + campos[i]).val() <= 0)
            {
                alert("Error, la priridad debe ser mayor que 0");
                enviaForm = false;
                break;
            }
            if($("#" + campos[i]).val() > 5)
            {
                alert("Error, la prioridad debe ser menor que 5");
                enviaForm = false;
                break;
            }
        }
        if(enviaForm)
        {
            var mensaje = "";
            var prd3 = parseInt($("#" + campos[0]).val());
            var prd2 = parseInt($("#" + campos[1]).val());
            var prd1 = parseInt($("#" + campos[2]).val());
            if(prd3 <= prd2 )
            {
                mensaje = "Error, la prioridad alta debe ser mayor que la prioridad media";
                enviaForm = false;
            }
            else if(prd3 <= prd1){
              mensaje = "Error, la prioridad alta debe ser mayor que la prioridad baja";
              enviaForm = false;
            }
            else if(prd2 <= prd1){
              mensaje = "Error, la prioridad media debe ser mayor que la prioridad baja";
              enviaForm = false;
            }
            if(enviaForm)
            {
                if(!confirm("esta seguro de actualizar las priridades")){
                  enviaForm = false;
                }
            }
            else{
                alert(mensaje);
            }
        }

        return enviaForm;

      });

      $("#actualizar_modelos").submit(function(event) {
                        
        var enviaForm = true;
        var campos = ["dClases", "dCasos","dDespliegue","dSecuencias","dActividades","MER"];
        for(var i = 0; i < campos.length; i++)
        {
            if($("#" + campos[i]).val() < 0)
            {
                alert("Error, debe ser un porcentaje entre 0 y 100");
                enviaForm = false;
                break;
            }
            if($("#" + campos[i]).val() > 100)
            {
                alert("Error, debe ser un porcentaje entre 0 y 100");
                enviaForm = false;
                break;
            }
        }
        if(enviaForm)
        {
            var mensaje = "";
            var porc1 = parseInt($("#" + campos[0]).val());
            var porc2 = parseInt($("#" + campos[1]).val());
            var porc3 = parseInt($("#" + campos[2]).val());
            var porc4 = parseInt($("#" + campos[3]).val());
            var porc5 = parseInt($("#" + campos[4]).val());
            var porc6 = parseInt($("#" + campos[5]).val());
            var suma = porc1 + porc2 + porc3 + porc4 + porc5 + porc6;
            if(suma != 100)
            {
                mensaje = "Error, la suma de los dos porcentajes debe dar 100% " + porc1;
                enviaForm = false;
            }
            if(enviaForm)
            {
                if(!confirm("esta seguro de actualizar los porcentajes")){
                  enviaForm = false;
                }
            }
            else{
                alert(mensaje);
            }
        }

        return enviaForm;

      });
    };
  </script>
@stop
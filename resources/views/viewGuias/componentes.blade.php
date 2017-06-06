@extends('layouts.principal')


@section('navegacion')
	<ul>
        <li><a id="inicio-flotante"  class="icon-key2 sesion" href="#">Iniciar Sesion</a></li>
        <li><a class="icon-folder-open" name="b1" class="icon-pencil2" href="#">Configuracion</a></li>
        <li><a class="icon-home salir" href="#">Salir</a></li>
      </ul>
@stop

@section('content')
	<div class="titulo">COMPONENTES</div>
	<div>
		<fieldset>
			<div class="subtitulo">INPUTS</div>
			<div class="grupo-controles-formulario">
                <label for="nombre" class="texto-control-formulario">Nombre</label>
                <div class="controles-formulario">
                  <input kl_virtual_keyboard_secure_input="on" id="nombre" placeholder="Nombre" type="text">
                  <div class="texto-ayuda texto-izquierda">
                    <i class="icon-bubbles4"></i>
                    <p>Texto.</p>
                  </div>
                </div>
              </div>
			<div style="margin-top:0.5%;"><input type="text" name="n" placeholder="nombre" autofocus required maxlength="10"/></span></div>
			<div style="margin-top:0.5%;"><input type="email" name="name_control" placeholder="correo" autofocus required maxlength="10"/></span></div>
			<div style="margin-top:0.5%;"><input type="number" name="name_control" placeholder="numero" autofocus required  min="0" max="100" step="10"/></span></div>
			<div style="margin-top:0.5%;"><input type="password" name="name_control" placeholder="contraseña" autofocus required maxlength="10"/></span></div>
			<div style="margin-top:0.5%;"><input type="date" name="name_control" placeholder="fecha" autofocus required max="1979-12-31" min="2000-01-02"/></span></div>
			<div style="margin-top:0.5%;"><input type="color" name="name_control" placeholder="color" autofocus required/></span></div>
			<div style="margin-top:0.5%;"><input type="range" name="name_control" placeholder="rango" autofocus required min="0" max="10"/></span></div>
			<div style="margin-top:0.5%;"><input type="month" name="name_control" placeholder="mes" autofocus required /></span></div>
			<div style="margin-top:0.5%;"><input type="time" name="name_control" placeholder="hora" autofocus required /></span></div>
			<div style="margin-top:0.5%;"><input type="search" name="name_control" placeholder="busqueda" autofocus required maxlength="10"/></span></div>
			<div style="margin-top:0.5%;"><input type="url" name="name_control" placeholder="url" autofocus required maxlength="10"/></span></div>
			<div style="margin-top:0.5%;"><input type="tel" name="name_control" placeholder="telefono" autofocus required /></span></div>
			<textarea name="message" placeholder="textarea" rows="10" cols="30">
			
			</textarea>
		</fieldset>
		<div class="liena-separador"></div>
		<fieldset>
			
			<div class="subtitulo">SELECT</div> 
			   <div class="grupo-controles-formulario">
                <label for="" class="texto-control-formulario texto-grupo-radiobutton">RadioButton Lista</label>
                <div class="controles-formulario">
                  <div class="radiobutton-lista">
                    <div class="control-radiobutton"><input name="radio-button-lista" id="radio-uno-lista" value="1" disabled="" type="radio"><label for="radio-uno-lista" class="radiobutton-label"></label></div><span class="radiobutton-texto">Radio Uno - Deshabilitado</span>
                  </div>
                  <div class="radiobutton-lista">
                    <div class="control-radiobutton"><input name="radio-button-lista" id="radio-dos-lista" value="2" type="radio"><label for="radio-dos-lista" class="radiobutton-label"></label></div><span class="radiobutton-texto">Radio Dos</span>
                  </div>
                  <div class="radiobutton-lista">
                    <div class="control-radiobutton"><input name="radio-button-lista" id="radio-tres-lista" value="3" type="radio"><label for="radio-tres-lista" class="radiobutton-label"></label></div><span class="radiobutton-texto">Radio Tres</span>
                  </div>
                </div>
              </div>
	          
	          <div class="grupo-controles-formulario">
                <label for="" class="texto-control-formulario texto-grupo-checkbox">Checkbox bloque</label>
                <div class="controles-formulario" style="background-color:transparent;">
                  <div class="checkbox-bloque">
                    <div class="control-checkbox"><input id="uno" value="uno" type="checkbox"><label for="uno" class="checkbox-label"></label></div><span class="checkbox-texto">Uno</span>
                  </div>
                  <div class="checkbox-bloque">
                    <div class="control-checkbox"><input id="dos" value="dos" type="checkbox"><label for="dos" class="checkbox-label"></label></div><span class="checkbox-texto">Dos</span>
                  </div>
                  <div class="checkbox-bloque">
                    <div class="control-checkbox"><input id="tres" value="tes" type="checkbox"><label for="tres" class="checkbox-label"></label></div><span class="checkbox-texto">Tres</span>
                  </div>
                  <div class="checkbox-bloque">
                    <div class="control-checkbox"><input id="cuatro" value="tes" type="checkbox"><label for="cuatro" class="checkbox-label"></label></div><span class="checkbox-texto">Cuatro</span>
                  </div>
                  <div class="checkbox-bloque">
                    <div class="control-checkbox"><input id="cinco" value="tes" type="checkbox"><label for="cinco" class="checkbox-label"></label></div><span class="checkbox-texto">Cinco</span>
                  </div>
                  <div class="checkbox-bloque">
                    <div class="control-checkbox"><input id="seis" value="tes" type="checkbox"><label for="seis" class="checkbox-label"></label></div><span class="checkbox-texto">Seis</span>
                  </div>
                  <p class="texto-ayuda-bloque texto-justificado">Este texto es para ayudar, pero esta vez es en bloque inferior. texto extra para mirar la doble linea</p>
                </div>
              </div>
	          
	           <div class="grupo-controles-formulario">
                <label for="drop-down-1" class="texto-control-formulario texto-lista-desplegable">Lista desplegable</label>
                <div class="controles-formulario">
                  <select id="drop-down-1" name="drop">
                      <option value="1">Opcion 1</option>
                      <option value="2">Opcion 2</option>
                      <option value="3">Opcion 3</option>
                      <option value="4">Opcion 4</option>
                      <option value="5">Opcion 5</option>
                      <option value="6">Opcion 6</option>
                      <option value="7">Opcion 7</option>
                  </select>
                </div>  
              </div>
	    </fieldset>
	    <fieldset>
	    	<div class="subtitulo">BOTONES</div> 
	    	<a class="boton-icono" href="#"><i class="icono icon-download"></i><span class="texto-boton">Agregar</span></a>
		    <button class="boton-grande" id="registro_boton">Aceptar</button>
		</fieldset>
	</div>
@stop
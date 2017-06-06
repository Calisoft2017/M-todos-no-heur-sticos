@extends('layouts.principal')


@section('navegacion')
  <div>
        <div>
      <form method="POST" action="detallesCasoprueba">
      	@foreach($elementos as $fila)
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
    <div class="registro_titulo_div">ESCENARIO DE PRUEBA</div> 
    <input type="hidden" id="prueba" value='<?php echo $elementos[0]->txt ?>'>

	    <div class="registro_titulo_div">Elementos de la prueba</div> 
	    <div style="height:500px; overflow: auto;">
	    	<table>
	    		<tbody>
	    		<tr>
	    			<th class="th_txt">Identificador</th>
	    			<th>Valor</th>
	    			<th>Editar</th>
	    		</tr>
	    			
	    			
	    			<?php 
	    			//echo "<script type=\"text/javascript\">console.log('". $elementos[0]->txt . "');</script>"; 
	    			$entrega = $elementos[0]->entrega;
	    			$elementos = $elementos[0]->txt;
	    			$elementos = explode(':@$', $elementos); 
	    			//echo "<script type=\"text/javascript\">console.log('". $elementos[0] . "');</script>";
	    			$url=$elementos[0]; ?>

				<input type="hidden" id="url" value='<?php echo $url ?>'>
			            <?php 
	    			for ($i=2; $i < count($elementos) -1; $i+=2) { 
	    			    if($elementos[$i + 1] != "__iframe__"){?>
			            <tr>
			              <td class="th_txt"><?php echo $elementos[$i]; ?></td>
			              <td id="element1_<?php echo $i ?>"><div><input type="text" name="valor" id="valor_<?php echo $i ?>" value="<?php echo $elementos[$i +1]; ?>" placeholder="valor" autofocus required /></div></td>
			              <td id="element2_<?php echo $i ?>"><button name="aceptar" class="boton-small" id="registro_boton" onclick="cambiar_valor(this)" value="<?php echo $i; ?>">aceptar</button></td>
			              <td id="element21_<?php echo $i ?>"><?php echo $elementos[$i +1]; ?></td>
			              <td id="element22_<?php echo $i ?>"><button name="modificar" class="boton-small" onclick="modificar(this)" id="registro_boton" value="<?php echo $i; ?>">modificar</button></td>
			            </tr>
						<?php
			            	}
			            	else{
			            ?>
			            	<span style="display: none;"><?php echo $elementos[$i]; ?></span>
			              <span style="display: none;" id="element1_<?php echo $i ?>"><div><input type="text" name="valor" id="valor_<?php echo $i ?>" value="<?php echo $elementos[$i +1]; ?>" placeholder="valor" autofocus required /></div></span>
			              <span style="display: none;" id="element2_<?php echo $i ?>"><button name="aceptar" class="boton-small" id="registro_boton" onclick="cambiar_valor(this)" value="<?php echo $i; ?>">aceptar</button></span>
			              <span style="display: none;" id="element21_<?php echo $i ?>"><?php echo $elementos[$i +1]; ?></span>
			              <span style="display: none;" id="element22_<?php echo $i ?>"><button name="modificar" onclick="modificar(this)" id="registro_boton" value="<?php echo $i; ?>">modificar</button></span>

					    <?php
			            	}
			            ?>
			              <input id="element31_<?php echo $i ?>" type="hidden" value='<?php echo $elementos[$i]; ?>'>
			              <input id="element32_<?php echo $i ?>" type="hidden" value='<?php echo $elementos[$i +1]; ?>'>
		            <?php
		            	}
		            ?>
	    		
		    	</tbody>
		    </table>

	    </div>

	    <?php if(!isset($_POST['modificar'])) { ?>
			



	    <div id="abc">
		<!-- Popup Div Starts Here -->
		<div id="popupContact">
		<!-- Contact Us Form    -->
		<div id="funcionales" style="display:none;">
					<form class="form2" action="createPrueba" id="form" method="Post" name="form">
					<img id="close" src="img/cerrar.png" onclick ="div_hide()">
					<h2 style="margin-left:-500px;">PRUEBAS</h2>
					<select id="drop-down-1" name="drop" onchange="carga(this)" style="position:absolute; margin-top:-50px; margin-left:0px;">
			            <option value="1" selected>Pruebas funcionales</option>
			            <option value="2">Carga y estrés</option>
			        </select>
					<hr>
						<?php 
					  if(count($pruebas_funcionales) > 0){  
					  		$cont=0; 
					  ?>
							<div id="table">
							<table>
								<tr>
						    			<th>Nombre de la prueba</th>
						    			<th>Estado</th>
						    			<th>Eliminar</th>
					    		</tr>
								<?php 
								//if($pruebas[0]->name_Prueba != "__Carga_Estres"){  
								?>

							    	@foreach($pruebas_funcionales as $fila)
								    	<tr>
								    			<td>{{$fila->name_Prueba}}</td>
								    			<td><button type="button" class="boton-small" onclick="ver_prueba(this)" id="ver" name="<?php echo $fila->id_entregaPrueba; ?>">Ver</button></td>
								    			<td><button type="button" class="boton-small" onclick="eliminar_prueba(this, <?php echo $entrega; ?>)"  id="<?php echo $fila->id_entregaPrueba; ?>" name="<?php echo $fila->id_prueba; ?>">Eliminar</button></td>
							    		</tr>
							    		<?php  
										  $cont++; 
										?>
									@endforeach  
							<?php 
							//	}  
							?>   
							</table>
							</div>
					  <?php 
						}  
						else{
					  ?>
					  		No hay pruebas registradas.
					  		<br>
					  <?php 
						} 
					  ?>
								<input id="name" name="name" placeholder="nombre de la prueba" required maxlength="300" type="text">
								<input type="hidden" name="id_casoPrueba" id="id_casoPrueba">
								<input type="hidden" name="entrega" value="<?php echo $entrega ?>">	
						    	        <button id="agregar" name="name_Prueba" onclick="guardar(this)">agregar</button>
				     </form>

	    </div>
	    <div id="carga" style="display:none;">
	        	<form class="form2" action="createPruebaCarga" id="form" method="Post" name="form">
				<img id="close" src="img/cerrar.png" onclick ="div_hide()">
				<h2 style="margin-left:-500px;">PRUEBAS</h2>
				<select id="drop-down-2" name="drop" onchange="carga(this)" style="position:absolute; margin-top:-50px; margin-left:0px;">
			            <option value="1">Pruebas funcionales</option>
			            <option value="2" selected>Carga y estrés</option>
			        </select>
					<hr>
						<?php 
					  if(count($pruebas_carga) > 0){  
					  		$cont=0; 
					  ?>
							<div id="table">
							<table>
								<tr>
						    			<th>Número de usuarios</th>
						    			<th>Estado</th>
						    			<th>Eliminar</th>
					    		</tr>

					    	@foreach($pruebas_carga as $fila)
						    	<tr>
						    			<td>{{$fila->usuarios}}</td>
						    			<td><button type="button" class="boton-small" onclick="ver_prueba_carga(this, '<?php echo $url; ?>')" id="ver" name="<?php echo $fila->id_entregaPrueba_carga; ?>">Ver</button></td>
						    			<td><button type="button" class="boton-small" onclick="eliminar_prueba_carga(this, <?php echo $entrega; ?>)"  id="<?php echo $fila->id_entregaPrueba_carga; ?>" name="<?php echo $fila->id_prueba_carga; ?>">Eliminar</button></td>
					    		</tr>
					    		<?php  
								  $cont++; 
								?>
							@endforeach     
							</table>
							</div>
					  <?php 
						}  
						else{
					  ?>
					  		No hay pruebas registradas.
					  		<br>
					  <?php 
						} 
					  ?>
			    <input id="name" name="usuarios" placeholder="número de usuarios" type="number" required min="1" max="1000" style="width:150px;">
			    <input type="hidden" name="id_casoPruebaCarga" id="id_casoPruebaCarga">	
			    <input type="hidden" name="entrega" value="<?php echo $entrega ?>">
			    <button id="agregar" name="name_Prueba" onclick="guardarCarga(this)">agregar</button>
			    </form>
	    </div>	
		</div>
		<?php }?>
		<!-- Popup Div Ends Here -->
		</div>


	    	<th><button name="crearCasoPrueba" onclick="div_show()" class="" id="menu_boton">Realizar escenario de prueba</button></th>
	    <style>
	    	#name{
	    		margin-top: 2em;
	    	}
	    	#table {
				width:100%;
				height:55%;
				overflow: auto;
			}
	    	#abc {
				width:100%;
				height:100%;
				/*opacity:.95;*/
				top:0;
				left:0;
				/*display:none;*/
				position:fixed;
				background: rgba(0, 0, 0, 0.9);
				overflow:auto
			}
			img#close {
			position:absolute;
			right:-14px;
			top:-14px;
			cursor:pointer
			}
			div#popupContact {

			position:absolute;
			left:50%;
			top:17%;
			margin-left:-20em;
			}
			.form2 {
			width:40em;
			height: 22em;
			padding:10px 50px;
			border:2px solid gray;
			border-radius:10px;
			background: rgba(255, 255, 255, 0.99);
			}
	    </style>
	    <script>
		    $( document ).ready(function() {
		    	document.getElementById('funcionales').style.display = 'block';
		    	try {
		    		i=2;
				    while(true){
				    	$('#element1_'+i)[0].style.display = 'none';
			     		$('#element2_'+i)[0].style.display = 'none';
			     		i+=2;
				    }
				}
				catch(err) {
				   // console.log(err.message);
				}
			     
			});
			function guardar(element){
				if(document.getElementById('name').value != ""){
				    if (sessionStorage.getItem('id_casoPrueba') != null) {
				        document.getElementById("id_casoPrueba").value = sessionStorage['id_casoPrueba'];
				        alert("La prueba se ha agregado correctamente!!");
				    }
				    else{
				        alert("Error, repita el proceso");
				        window.open('evaluador','_self');
				    }
				}
	    		}
	    		function guardarCarga(element){
	    			var number= document.getElementsByName('usuarios')[0].value;
	    			if (number != "" && parseInt(number) > 0 && parseInt(number) <= 1000 ) {
				    if (sessionStorage.getItem('id_casoPrueba') != null) {
				        document.getElementById("id_casoPruebaCarga").value = sessionStorage['id_casoPrueba'];
				        alert("La prueba se ha agregado correctamente!!");
				    }
				    else{
				        alert("Error, repita el proceso");
				        window.open('evaluador','_self');
				    }
				}
	    		}

			function modificar(elemnt){
				var band2=0;
				try {
				var n=parseInt(""+elemnt.value);
				var p= (JSON.parse((($('#prueba')[0].value).split(":@$"))[n]));
				console.log(n,p.attributes.type);
	     			if (p.type == 'TEXTAREA' || p.type == 'SELECT') {
						band2 = 1;
					}

					if (p.type == 'INPUT') {
					    if (p.attributes.type == 'checkbox' || p.attributes.type == 'radio' || p.attributes.type == 'file' || 
					        p.attributes.type == 'button' || p.attributes.type == 'reset' || p.attributes.type == 'submit' || p.attributes.type == 'image') {
					        band2 = 1;
					    }
					}
		     		}
		     		catch(err) {
				}
				if(band2 == 1){
					alert("este elemento no se puede modificar");
				}
				else{
		        	$('#element1_'+elemnt.value)[0].style.display = 'table-cell';
				    $('#element2_'+elemnt.value)[0].style.display = 'table-cell';
				    $('#element21_'+elemnt.value)[0].style.display = 'none';
				    $('#element22_'+elemnt.value)[0].style.display = 'none';
				}
	        }
	        function cambiar_valor(elemnt){
	        	$('#element1_'+elemnt.value)[0].style.display = 'none';
			    $('#element2_'+elemnt.value)[0].style.display = 'none';
			    $('#element21_'+elemnt.value)[0].style.display = 'table-cell';
			    $('#element22_'+elemnt.value)[0].style.display = 'table-cell';
			    $('#element21_'+elemnt.value)[0].innerHTML = $('#valor_'+elemnt.value)[0].value;
			    $('#element32_'+elemnt.value)[0].value = $('#valor_'+elemnt.value)[0].value;
			    try {
		    		i=2;
		    		var string="";
		    		string += $('#url')[0].value;
		    		string += ":@$";
		    		string += "null:@$";

				    while(true){
				    	string+= $('#element31_'+i)[0].value;
				    	string+=':@$';
			     		string+= $('#element32_'+i)[0].value;
			     		string+=':@$';
			     		i+=2;
				    }
				}
				catch(err) {
					console.log(string);
					string = string.substring(0, string.length-3);
					$('#prueba')[0].value=string;
					console.log($('#prueba')[0].value);

				}
			    

	        }

	        function carga(elmnt){
	        	if(elmnt.value == "1"){
		        	document.getElementById('funcionales').style.display = 'block';
		        	document.getElementById('carga').style.display = 'none';
		        	document.getElementById("drop-down-1").selectedIndex = "0";
		        }
		        else{
		        	document.getElementById('funcionales').style.display = 'none';
		        	document.getElementById('carga').style.display = 'block';
		        	document.getElementById("drop-down-2").selectedIndex = "1";
		        }
	        }

		    function ver_prueba(elmnt){
		    	$.ajax({
				  type: "POST",
				  url: "ver",
				  data: {verPrueba:elmnt.name},
				  success: function(data, textStatus, jqXHR)
				    {
				    	var html = '<form class="form2" action="../escenarioCasoprueba?id_casoPrueba=' + sessionStorage['id_casoPrueba']+'&crearCasoPrueba=" id="form" method="Post" name="form">'+
							'	<img id="close" src="img/cerrar.png" onclick ="div_hide()">'+
							'	<h2>PRUEBAS</h2>'+
							'	<hr>'+
							'	<div>Nombre de la prueba:    '+data[0].name_Prueba+'</div>'+
							'	<div class="grupo-controles-formulario" style="margin-top:1em;">'+
							'    <div class="controles-formulario">'+
							'      <label for="" class="texto-control-formulario texto-grupo-radiobutton" style="margin-right:2em;">Estado:</label>'+
							'      <div class="radiobutton-bloque">'+
							'        <div class="control-radiobutton">';

						if(data[0].estado == 'Aprobado'){
							html += '<input type="radio" checked name="radio-button" id="radio-uno" value="1"/>';
						}
						else{
							html += '<input type="radio" name="radio-button" id="radio-uno" value="1"/>';
						}	


						html += '<label for="radio-uno" class="radiobutton-label"></label></div><span class="radiobutton-texto">Aprobado</span>'+
							'      </div>'+
							'      <div class="radiobutton-bloque">'+
							'        <div class="control-radiobutton">';

						if(data[0].estado == 'No aprobado'){
							html += '<input type="radio" checked name="radio-button" id="radio-dos" value="2"/>';
						}
						else{
							html += '<input type="radio" name="radio-button" id="radio-dos" value="2"/>';
						}

						html += '<label for="radio-dos" class="radiobutton-label"></label></div><span class="radiobutton-texto">No aprobado</span>'+
							'      </div>'+
							'    </div>'+
							'  </div>'+
							'  <div><textarea name="message" placeholder="Observaciones" rows="6" cols="70">';

						if(data[0].estado != 'sin calificar'){
							html += data[0].observacion;
						}

						html += '</textarea></div>'+
							'  <br>'+
							'<button name="crearCasoPrueba1" type="button" onclick="calificar_prueba('+ data[0].id_entregaPrueba+')" id="menu_boton1">Guardar</button>'+
							'<button name="crearCasoPrueba2" onclick="div_show()"  id="menu_boton2">Volver</button>'+
							'</form>';
				        document.getElementById('popupContact').innerHTML=html;

				    },
				    error: function (jqXHR, textStatus, errorThrown)
				    {
				 		console.log('error');
				    }
				});
		    	


	    	}
	    	function calificar_prueba(id){
	    		var estado="";
	    		var observaciones="";
	    		if(document.getElementById('radio-uno').checked == true){
	    			estado="Aprobado";
	    		}
	    		else{
	    			if(document.getElementById('radio-dos').checked == true){
		    			estado="No aprobado";
		    		}
		    		else{
		    			estado="sin calificar";
		    		}
	    		}
	    		if(document.getElementsByName('message')[0].value == ""){
	    			observaciones="Ninguna";
	    		} 
	    		else{
	    			observaciones=document.getElementsByName('message')[0].value;
	    		} 
	    		
	    		$.ajax({
					  type: "POST",
					  url: "calificarPrueba",
					  data: {id2:id, estado2:estado, observaciones2:observaciones},
					  success: function(data, textStatus, jqXHR)
					    {
					        alert("se ha guardado correctamente!!");
					        window.open('../escenarioCasoprueba?id_casoPrueba='+sessionStorage["id_casoPrueba"]+'&crearCasoPrueba=','_self');
					    },
					    error: function (jqXHR, textStatus, errorThrown)
					    {
					 		console.log('error');
					    }
					});
	    	}
	    	function eliminar_prueba(elmnt, entrega){
	    		var r = confirm("Esta segur@ que desea eliminar esta prueba");
			if (r == true) {
			    if (sessionStorage.getItem('id_casoPrueba') != null) {
			    	if (entrega == 1) {
				        $.ajax({
						  type: "POST",
						  url: "deletePrueba1",
						  data: {eliminar:elmnt.name, id_entregaPrueba:elmnt.id, id_casoPrueba: sessionStorage['id_casoPrueba']},
						  success: function(data, textStatus, jqXHR)
						    {
						        alert("La prueba se ha eliminado correctamente!!");
						        window.open('../escenarioCasoprueba?id_casoPrueba='+sessionStorage["id_casoPrueba"]+'&crearCasoPrueba=','_self');
						    },
						    error: function (jqXHR, textStatus, errorThrown)
						    {
						 		console.log('error');
						    }
						});
				    }
				    else{
				    	$.ajax({
						  type: "POST",
						  url: "deletePrueba2",
						  data: {eliminar:elmnt.name, id_entregaPrueba:elmnt.id, id_casoPrueba: sessionStorage['id_casoPrueba']},
						  success: function(data, textStatus, jqXHR)
						    {
						        alert("La prueba se ha eliminado correctamente!!");
						        window.open('../escenarioCasoprueba?id_casoPrueba='+sessionStorage["id_casoPrueba"]+'&crearCasoPrueba=','_self');
						    },
						    error: function (jqXHR, textStatus, errorThrown)
						    {
						 		console.log('error');
						    }
						});
				    }
			    }
			    else{
			        alert("Error, repita el proceso");
			        window.open('evaluador','_self');
			    }
			} 
	    	}

	    	function eliminar_prueba_carga(elmnt, entrega){
	    		var r = confirm("Esta segur@ que desea eliminar esta prueba");
			if (r == true) {
			    if (sessionStorage.getItem('id_casoPrueba') != null) {
			    	if (entrega == 1) {
				        $.ajax({
						  type: "POST",
						  url: "deletePruebaCarga1",
						  data: {eliminar:elmnt.name, id_entregaPrueba:elmnt.id, id_casoPrueba: sessionStorage['id_casoPrueba']},
						  success: function(data, textStatus, jqXHR)
						    {
						        alert("La prueba se ha eliminado correctamente!!");
						        window.open('../escenarioCasoprueba?id_casoPrueba='+sessionStorage["id_casoPrueba"]+'&crearCasoPrueba=','_self');
						    },
						    error: function (jqXHR, textStatus, errorThrown)
						    {
						 		console.log('error');
						    }
						});
				    }
				    else{
				    	$.ajax({
						  type: "POST",
						  url: "deletePruebaCarga2",
						  data: {eliminar:elmnt.name, id_entregaPrueba:elmnt.id, id_casoPrueba: sessionStorage['id_casoPrueba']},
						  success: function(data, textStatus, jqXHR)
						    {
						        alert("La prueba se ha eliminado correctamente!!");
						        window.open('../escenarioCasoprueba?id_casoPrueba='+sessionStorage["id_casoPrueba"]+'&crearCasoPrueba=','_self');
						    },
						    error: function (jqXHR, textStatus, errorThrown)
						    {
						 		console.log('error');
						    }
						});
				    }
			    }
			    else{
			        alert("Error, repita el proceso");
			        window.open('evaluador','_self');
			    }
			} 
	    	}

	    	function check_empty() {
				if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
					alert("Fill All Fields !");
				} else {
					document.getElementById('form').submit();
					alert("Form Submitted Successfully...");
				}
			}
	    	function div_show() {
				document.getElementById('abc').style.display = "block";
			}
			//Function to Hide Popup
			function div_hide(){
				document.getElementById('abc').style.display = "none";
			}

			///carga 
			function ver_prueba_carga(elmnt, url){
		    	$.ajax({
				  type: "POST",
				  url: "verCarga",
				  data: {verPrueba:elmnt.name},
				  success: function(data, textStatus, jqXHR)
				    {
				    	var html = '<form class="form2" action="../escenarioCasoprueba?id_casoPrueba=' + sessionStorage['id_casoPrueba']+'&crearCasoPrueba=" id="form" method="Post" name="form">'+
							'	<img id="close" src="img/cerrar.png" onclick ="div_hide()">'+
							'	<h2>PRUEBAS</h2>'+
							'	<hr>'+
							'	<div>Nombre de la prueba:    Carga Y estrés</div>'+
							'	<div>usuarios:    '+data[0].usuarios+'</div>'+
							'   <input type="hidden" id="usuarios" value="'+data[0].usuarios+'">'+
							'   <input type="hidden" id="url" value='+url+'>'+
							'	<div class="grupo-controles-formulario" style="margin-top:1em;">'+
							'    <div class="controles-formulario">'+
							'      <label for="" class="texto-control-formulario texto-grupo-radiobutton" style="margin-right:2em;">Estado:</label>'+
							'      <div class="radiobutton-bloque">'+
							'        <div class="control-radiobutton">';

						if(data[0].estado == 'Aprobado'){
							html += '<input type="radio" checked name="radio-button" id="radio-uno" value="1"/>';
						}
						else{
							html += '<input type="radio" name="radio-button" id="radio-uno" value="1"/>';
						}	


						html += '<label for="radio-uno" class="radiobutton-label"></label></div><span class="radiobutton-texto">Aprobado</span>'+
							'      </div>'+
							'      <div class="radiobutton-bloque">'+
							'        <div class="control-radiobutton">';

						if(data[0].estado == 'No aprobado'){
							html += '<input type="radio" checked name="radio-button" id="radio-dos" value="2"/>';
						}
						else{
							html += '<input type="radio" name="radio-button" id="radio-dos" value="2"/>';
						}

						html += '<label for="radio-dos" class="radiobutton-label"></label></div><span class="radiobutton-texto">No aprobado</span>'+
							'      </div>'+
							'    </div>'+
							'  </div>'+
							'  <div><textarea name="message" placeholder="Observaciones" rows="6" cols="70">';

						if(data[0].estado != 'sin calificar'){
							html += data[0].observacion;
						}

						html += '</textarea></div>'+
							'  <br>'+
							'<button name="crearCasoPrueba1" type="button" onclick="calificar_prueba_carga('+ data[0].id_entregaPrueba_carga +')" id="menu_boton1">Guardar</button>'+
							'<button name="crearCasoPrueba2" onclick="div_show()"  id="menu_boton2">Volver</button>'+
							'</form>';
				        document.getElementById('popupContact').innerHTML=html;

				    },
				    error: function (jqXHR, textStatus, errorThrown)
				    {
				 		console.log('error');
				    }
				});
		    	


	    	}
	    	function calificar_prueba_carga(id){
	    		var estado="";
	    		var observaciones="";
	    		if(document.getElementById('radio-uno').checked == true){
	    			estado="Aprobado";
	    		}
	    		else{
	    			if(document.getElementById('radio-dos').checked == true){
		    			estado="No aprobado";
		    		}
		    		else{
		    			estado="sin calificar";
		    		}
	    		}
	    		if(document.getElementsByName('message')[0].value == ""){
	    			observaciones="Ninguna";
	    		} 
	    		else{
	    			observaciones=document.getElementsByName('message')[0].value;
	    		} 
	    		tiempos=localStorage["tiempos"];
	    		usuarios_realizados=localStorage["veces_realizado"];
	    		$.ajax({
					  type: "POST",
					  url: "calificarPruebaCarga",
					  data: {id2:id, estado2:estado, observaciones2:observaciones,tiempos2:tiempos,usuarios_realizados2:usuarios_realizados},
					  success: function(data, textStatus, jqXHR)
					    {
					        alert("se ha guardado correctamente!!");
					        window.open('../escenarioCasoprueba?id_casoPrueba='+sessionStorage["id_casoPrueba"]+'&crearCasoPrueba=','_self');
					    },
					    error: function (jqXHR, textStatus, errorThrown)
					    {
					 		console.log('error');
					    }
					});
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
@extends('layouts.principal')


@section('navegacion')
	<ul>
        <li><a id="inicio-flotante"  class="icon-key2 sesion" href="#">Iniciar Sesion</a></li>
        <li><a class="icon-folder-open" name="b1" class="icon-pencil2" href="#">Configuracion</a></li>
        <li><a class="icon-home salir" href="#">Salir</a></li>
      </ul>
@stop

@section('content')
<!DOCTYPE html>
	<link href="../css/pruebas_funcionales.css"rel="stylesheet" type="text/css" >
	<script src="../js/pruebas_funcionales.js" type="text/javascript"></script> 
	pruebas funcionales
	<br><br>
	<input class="boton-icono" type="file" id="c_archivo" onchange="processFiles(this.files)"><br>
	<input id="run" type="button" value="correr prueba" style="margin-left:2em;" onclick="prueba()">
	<input type="hidden" id="prueba" value="si">
	<!--<input type="button" value="correr prueba" style="margin-left:2em;" onclick="run()">-->
	<br>
	<script>

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
</html>
@stop
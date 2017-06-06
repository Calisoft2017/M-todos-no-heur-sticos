<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<b>hola mundo desde laravel</b>
	<ul>
		<li><a href="paginauno">paginauno</a></li>
		<li><a href="paginados">paginados</a></li>
		<li><a href="paginatres">paginatres</a></li>
		<li><a href="paginacuatro">paginacuatro</a></li>
	</ul>
	<div id="variable"></div>
	<form method="POST" action="paginados">
		<label for="txtTexto">Ingrese un texto</label>
		<input type="text" id="txtTexto" name="txtTexto">
		<input type="submit" value="Guarde sesion" id="guarde">
	</form>
	<script>
		document.getElementById('guarde').addEventListener('click', grabar);
		window.onload = load;

		function load() {
			document.getElementById("variable").innerHTML = "my sesion: "+localStorage['prueba'];
			//alert('shdghgfhef');
		}
		function grabar() {
		    localStorage['prueba']=document.getElementById('txtTexto').value;
		}
	</script>
</body>
</html>

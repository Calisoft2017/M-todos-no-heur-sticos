<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<ul>
		<li><a href="paginauno">paginauno</a></li>
		<li><a href="paginados">paginados</a></li>
		<li><a href="paginatres">paginatres</a></li>
		<li><a href="paginacuatro">paginacuatro</a></li>
	</ul>
	<div id="variable"></div> 
	<br>
	pagina dos
</body>
<script>
	window.onload = load;
	function load() {
		document.getElementById("variable").innerHTML = "my sesion: "+localStorage['prueba'];
	}
</script>
</html>
<?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>

<script src="../js/graficas.js" type="text/javascript"></script>

<div  class="row" >
<div class="col-md-6">
                  <label>Año</label>
                  <select class="form-control" id="anio_sel"  onchange="cambiar_fecha_grafica();">

                  <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
                    <option value="2015" >2015</option>
                    <option value="2016" >2016</option>
                    <option value="2017" >2017</option>
                    <option value="2018">2018</option>
                    <option value="2019" >2019</option>
                  </select>

</div>


<div class="col-md-6">
                  <label>Mes</label>
                  <select class="form-control" id="mes_sel" onchange="cambiar_fecha_grafica();" >
                  <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>
                  
                  </select>

</div>
</div>

<div  class="row" >
<br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_barras">
		</div>

	    <div class="box-footer">
		</div>
	</div>



		<br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_lineas">
		</div>

	    <div class="box-footer">
		</div>
	</div>


	<br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_pie">
		</div>

	    <div class="box-footer">
		</div>
	</div>


</div>
<form method="POST" action="reporte_generalEva_graficos/1" target="_blank" >
    <input type="hidden" name="id_proyecto2" id="id_proyecto2">
    <input type="hidden" name="id_usuario2" id="id_usuario2">
    <input type="hidden" name="archivo_imagen1" id="archivo_imagen1">
    <input type="hidden" name="archivo_imagen2" id="archivo_imagen2">
    <input type="hidden" name="archivo_imagen3" id="archivo_imagen3">

    <input type="submit" value="generar pdf" onclick="pdf()"> 
</form>

<script type="text/javascript" src="../js/jquery2.min.js"></script>
    <script src="../js/html2canvas.js" type="text/javascript"></script>
    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../js/highcharts2.js"></script>
        <script src="../js/highcharts-3d.js"></script>
    <script src="../js/exporting.js"></script>
    <script src="../js/jspdf.debug.js"></script>
<script>
function save_chart(chart, element_save) {
  EXPORT_WIDTH = 1000;
    var render_width = EXPORT_WIDTH;
    var render_height = render_width * chart.chartHeight / chart.chartWidth

    var svg = chart.getSVG({
        exporting: {
            sourceWidth: chart.chartWidth,
            sourceHeight: chart.chartHeight
        }
    });

    var canvas = document.createElement('canvas');
    canvas.height = render_height;
    canvas.width = render_width;

    image = new Image;
    image.onload = function () {
        canvas.getContext('2d').drawImage(this, 0, 0, render_width, render_height);
        var data = canvas.toDataURL("image/png");
        (document.getElementById(element_save)).value=data;
    };
    image.src = 'data:image/svg+xml;base64,' + window.btoa(svg);
}

function pdf(){
     save_chart($('#div_grafica_barras').highcharts(), 'archivo_imagen1');
     save_chart($('#div_grafica_lineas').highcharts(), 'archivo_imagen2');
     save_chart($('#div_grafica_pie').highcharts(), 'archivo_imagen3');

     alert("generando reporte...");
 }
cargar_grafica_barras(<?= $anio; ?>,<?= intval($mes); ?>);
cargar_grafica_lineas(<?= $anio; ?>,<?= intval($mes); ?>);
cargar_grafica_pie();

</script>


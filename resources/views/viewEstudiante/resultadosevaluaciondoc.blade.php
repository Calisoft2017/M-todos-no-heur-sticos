@extends('layouts.principal')


@section('navegacion')
  <div>
    <div>
      <form method="POST" action="verEvaluacion">
        <input type="hidden" name="id_usuario" id="id_usuario2">
        <input style="height: 40px; width: 50px; cursor: auto; float: left; box-shadow: none;border: none;" type="image" name="valor" src="../img/btnAtras.png" onclick="atras(this)"/>
      </form>
    </div>
    <div class="titulo">VER EVALUACIÓN</div>
  </div>

@stop

@section('content')

<?php $id_eval=$id_evaluador;
if($id_evaluador==""){header('Location: ../estudiante');};
$total_componentes=0;$total_componentes_si=0;$total_componentes_no=0;
$observaciones="No se ha evaluado el documento!"; $band=0;
if(count($documentosproyecto) > 0){   
?>
<div class="contenedor-tabla100">
  <table>
  <tbody>
    <tr>
      <th>Tipo de Documento</th>
      <th>Operaciones</th>
    </tr>
    @foreach($documentosproyecto as $fila)
    <tr>
    <?php if(isset($_POST['Detalle'])){ 
           if($_POST['Detalle'] == $fila->id_documentos_proyecto){ ?>
           <td colspan="2">
              <div class="titulo">Resultados evaluaci&oacute;n  {{$fila->nom_tipo}}</div><br>
           <div class="subtitulo">Observaciones</div>
           <textarea name="Observaciones" placeholder="Observaciones" style="margin: 0px; width: 70%; height: 70%;" autofocus disabled="">@foreach($evaluacion as $evaluacion3) <?php for($i=0;$i<count($evaluacion3->observaciones);$i++){ if($fila->id_documentos_proyecto==$evaluacion3->id_documentos_proyecto){$observaciones = $evaluacion3->observaciones;$band=1;} }?>@endforeach<?php echo $observaciones; ?></textarea>
           </td>
           </tr>
           <?php if($band==1){  ?>
     <tr>
     <td colspan="2">
            
              <div class="contenedor-tabla100" id="tabla_com">
              <table>
              <tbody>
    <?php $cont=0; $comp="."; $total_componentes=0;$total_componentes_si=0;$total_componentes_no=0;?>         
               @foreach($componente as $componente)
    <?php $total_componentes=$total_componentes+1;?>
                @foreach($evaluacion as $evaluacion1)
                <?php $evalua = explode(".", $evaluacion1->check); 
                for($i=0;$i<count($evalua);$i++){
                if($componente->id_documento_componente==$evalua[$i]){ ?>
                  <tr>
                  <td>
                    <div class="contenedor-tabla100" id="tabla_com">
                        <table style="width: 758px; height: 146px;">
                        <tbody>
                        <tr style="height: 23px;">
                        <td style="width: 122px; height: 23px;"><div class="subtitulo">Componente</div></td>
                        <td style="width: 635px; height: 23px;" colspan="3">{{$componente->nom_componente}}</td>
                        </tr>
                        <tr style="height: 23px;">
                        <td style="width: 122px; height: 23px;"><div class="subtitulo">Descripci&oacute;n</div></td>
                        <td style="width: 635px; height: 23px;" colspan="3">{{$componente->descripcion}}</td>
                        </tr>
                        <tr style="height: 23px;">
                        <td style="width: 122px; height: 23px;"><div class="subtitulo">Opcional</div></td>
                        <td style="width: 635px; height: 23px;">{{$componente->opcional_componente}}</td>
                        <td style="width: 635px; height: 23px;"><div class="subtitulo">Aprueba</div></td>
                        <td style="width: 635px; height: 23px;">  <?php if($evalua[$i+1]=="SI"){echo  'SI';  $total_componentes_si=$total_componentes_si+1;}  if($evalua[$i+1]=="NO"){echo 'NO';  $total_componentes_no=$total_componentes_no+1;} ?></td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                   </td>  
                </tr>
                <?php }
                }?>
                @endforeach                    
                @endforeach 
              </tbody>
              </table>        
              </div>
                            </td>
              </tr>
              <?php 
              }
              else{
              if($band==1){echo "No hay componentes registrados";}
              }
              ?>

    <?php if($band>0) {
    echo "<tr> 
      <td colspan='2'>
      <script src='../js/highcharts.js'></script>
      <script src='../js/exporting.js'></script>
      
      <div id='container' style='width: 300px; height: 300px; margin: 0 auto'></div>
      <script type='text/javascript'>
      $(function () {
          $('#container').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'Evaluación Componentes'
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                          style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                          }
                      }
                  }
              },
              series: [{
                  name: 'Brands',
                  colorByPoint: true,
                  data: [{
                      name: 'Aprobados ".$total_componentes_si."',
                      y: ".$total_componentes_si."
                  }, {
                      name: 'No Aprobados ".$total_componentes_no."',
                      y: ".$total_componentes_no."
                  }]
              }]
          });
      });
      </script> 
      </td>
    </tr>"; }?>
                <tr> 
                  <td colspan="2">
                  <form method="POST" action="resultadosevaluaciondoc">
                     <input type="hidden" id="id_tipo_documento" name="id_tipo_documento" value="<?php echo $fila->id_tipo_documento; ?>">
                     <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value={{$fila->id_proyecto}}>
                     <input type="hidden" name="h_id_evaluador" id="h_id_evaluador" value=<?php echo $id_eval;?>>
                    <button name="Aceptar" onclick="guardar(this)" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Aceptar</button>
                  </form>
                </td>
                </tr>    
            <?php } else{  ?>
          <td>{{$fila->nom_tipo}}
          </td>        
          <td>
           <form method="POST" action="resultadosevaluaciondetalle">
            <input type="hidden" id="id_tipo_documento" name="id_tipo_documento" value="<?php echo $fila->id_tipo_documento; ?>">
            <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value={{$fila->id_proyecto}}>
            <input type="hidden" name="h_id_evaluador" id="h_id_evaluador" value=<?php echo $id_eval;?>>
            <button name="Detalle" onclick="guardar(this)" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Detalle</button></td>
          </form>
          <?php } ?>
                      <?php } else{  ?>
          <td>{{$fila->nom_tipo}}
          </td>
          <td>
            <form method="POST" action="resultadosevaluaciondetalle">
            <input type="hidden" id="id_tipo_documento" name="id_tipo_documento" value="<?php echo $fila->id_tipo_documento; ?>">   
            <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value={{$fila->id_proyecto}}>
            <input type="hidden" name="h_id_evaluador" id="h_id_evaluador" value=<?php echo $id_eval;?>>
            <button name="Detalle" onclick="guardar(this)" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Detalle</button></td>
          </form>
          <?php } ?>
    </tr>
    @endforeach 
  </tbody>
  </table>
  <style type="text/css">
    #tabla_com{
      text-align:left;
      height: 150px;
      overflow: auto;
    }
  </style>
</div>
<?php }else{
  echo "No hay documentos registrados";
}?>

<br>
<div class="registro_titulo_div">Reportes</div> 

<br>
  <div>
    <table><tbody>
      <tr>
        <td>
          <form method="POST" action="reporte_modeladoEst/1" target="_blank">
                  <input type="hidden" name="id_evaluador" id="id_evaluador">
                <input type="hidden" name="id_usuario" id="id_usuario">
            <button name="reporte_modeladoEst" id="verReporte_boton" onclick="reporte(this)">Ver reporte del modelado</button>
          </form></td>
        <td>
        <!--<a href="reporte_modeladoEst/2" target="_blank" ><button name="descargar_reporte" id="descargarReporte_boton">Descargar reporte del modelado</button></a>-->
        <form method="POST" action="reporte_modeladoEst/2" target="_blank">
                  <input type="hidden" name="id_evaluador1" id="id_evaluador1">
                <input type="hidden" name="id_usuario1" id="id_usuario1">
            <button name="descargar_reporte" id="descargarReporte_boton" onclick="reporte_1(this)">Descargar reporte del modelado</button>
          </form>
        </td>
      </tr></tbody>
    </table>
  </div>
  
<script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 3 || sessionStorage.getItem('id_evaluador') == "" || sessionStorage.getItem('id_usuario') =="") {
        window.open('calidad/public/','_self');
      }
    };
     function reporte(element){
     	if (sessionStorage.getItem('id_evaluador') != "" || sessionStorage.getItem('id_usuario') !="") {
        	document.getElementById("id_evaluador").value = sessionStorage['id_evaluador'];
		document.getElementById("id_usuario").value = sessionStorage['id_usuario'];   
		console.log("usu",sessionStorage['id_usuario']);console.log("eva",sessionStorage['id_evaluador']);
	}
      }
           function reporte_1(element){
     	if (sessionStorage.getItem('id_evaluador') != "" || sessionStorage.getItem('id_usuario') !="") {
        	document.getElementById("id_evaluador1").value = sessionStorage['id_evaluador'];
		document.getElementById("id_usuario1").value = sessionStorage['id_usuario'];   
	}
      }
</script>

@stop
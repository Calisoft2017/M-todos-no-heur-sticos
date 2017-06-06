@extends('layouts.principal')


@section('navegacion')
  <div>
        <div>
      <form method="POST" action="realizarEvaluacion">
            <input type="hidden" name="id_usuario" id="id_usuario">
              <input style="height: 40px; width: 50px; cursor: auto; float: left; box-shadow: none;border: none;" type="image" name="valor" src="../img/btnAtras.png" />
          </form>
        </div>
    <div class="titulo">Evaluar modelado</div>
  </div>
@stop

@section('content')
<script type="text/javascript" src = "js/script_documento.js"></script>
<script type="text/javascript">var id_usuario = sessionStorage['id_usuario'];</script>
<?php $id=$id_usuario; $id_proyecto_p=""; if($id_usuario=="" || $id_proyecto_p=""){header('Location: ../evaluador');}?>
<?php  $total_componentes=0;$total_componentes_si=0;$total_componentes_no=0;?>
<?php $mensaje="";
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
    <?php if(isset($_POST['Evaluar'])){ 
           if($_POST['Evaluar'] == $fila->id_documentos_proyecto){ ?>
           <td colspan="2">
            <div class="titulo">{{$fila->nom_tipo}}</div>
              <form method="POST" action="evaluardocumentocreate">
              <iframe id="iframe1" src='../Documentacion/{{$fila->url_documento}}' width='90%' height='400' frameborder="1" transparency="transparency" onload="autofitIframe(this);" autofocus></iframe>
              <?php if(count($componente) > 0){  ?>
              <div class="contenedor-tabla100" id="tabla_com">
              <table>
              <tbody>
                <tr></tr>
                <?php $cont=0; $comp="."; $total_componentes=0;$total_componentes_si=0;$total_componentes_no=0;?>
                @foreach($componente as $componente)
                <?php $total_componentes=$total_componentes+1;?>
                <tr>
                  <td>
                    <div class="contenedor-tabla100" id="tabla_com">

<table style="width: 760px; height: 70px;">
<tbody>
<tr style="height: 7px;">
<td style="width: 148px; height: 7px;"><div class="subtitulo">Componente</div></td>
<td style="width: 615px; height: 7px;" colspan="4">{{$componente->nom_componente}}</td>
</tr>
<tr style="height: 7px;">
<td style="width: 148px; height: 7px;"><div class="subtitulo">Descripci&oacute;n</div></td>
<td style="width: 615px; height: 7px;" colspan="4">{{$componente->descripcion}}</td>
</tr>
<tr style="height: 7px;">
<td style="width: 148px; height: 7px;"><div class="subtitulo">Uso opcional</div></td>
<td style="width: 611px; height: 7px;">{{$componente->opcional_componente}}</td>
<td style="width: 148px; height: 7px;"><div class="subtitulo">Aprueba</div></td>
<td style="width: 611px; height: 7px;">
  <div class="grupo-controles-formulario">
  <div class="controles-formulario">
  <div class="radiobutton-lista">
  <div class="control-radiobutton">
    <input name="{{$componente->id_documento_componente}}" id="{{$componente->id_documento_componente}},SI" value="SI"  type="radio" 
      @foreach($evaluacion as $evaluacion1)
      <?php $evalua = explode(".", $evaluacion1->check); 
      for($i=0;$i<count($evalua);$i++){
      if($componente->id_documento_componente==$evalua[$i]){
      if($evalua[$i+1]=='SI'){
      echo 'checked'; $total_componentes_si=$total_componentes_si+1;
      }
      }
      }?>
      @endforeach
     <?php //if($componente->opcional_componente=="NO"){ echo "required";}?>
    >
    <label for="{{$componente->id_documento_componente}},SI" class="radiobutton-label"></label>
  </div>
   <span class="radiobutton-texto">SI</span>
  </div>
  </div>
  </div>
</td>
<td style="width: 611px; height: 7px;">
  <div class="grupo-controles-formulario">
  <div class="controles-formulario">
  <div class="radiobutton-lista">
  <div class="control-radiobutton">
  <input name="{{$componente->id_documento_componente}}" id="{{$componente->id_documento_componente}},NO" value="NO" type="radio" 
  @foreach($evaluacion as $evaluacion2)
  <?php $evalua = explode(".", $evaluacion2->check); 
  for($i=0;$i<count($evalua);$i++){
  if($componente->id_documento_componente==$evalua[$i]){
  if($evalua[$i+1]=='NO'){
  echo 'checked'; $total_componentes_no=$total_componentes_no+1;
  }
  }
  }?>
  @endforeach
  <?php //if($componente->opcional_componente=="NO"){ echo "required";}?>>
  <label for="{{$componente->id_documento_componente}},NO" class="radiobutton-label">
  </label>
  </div>
  <span class="radiobutton-texto">NO</span>
  </div>
  </div>
  </div>
</td>
</tr>
</tbody>
</table>

                    </div>
                  </td>  
                </tr>
                <?php $cont=$cont+1; $comp=$comp.$componente->id_documento_componente.'.';?>
                @endforeach            
              </tbody>
              </table>
              </div>
               <input type='hidden' id='cont'name='cont' value=<?php echo $cont;?>>
               <input type='hidden' id='comp' name='comp' value=<?php echo $comp;?>>
              <?php 
              }
              else{
              echo "<br> No hay componentes registrados";
              }
              ?>
                <tr> 
                  <td colspan="2">
<?php if($total_componentes>0) { echo "
<script src='../js/highcharts.js'></script>
<script src='../js/exporting.js'></script>

<div id='container' style='min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto'></div>
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
            }, {
                name: 'Por Evaluar ".$total_componentes=$total_componentes-$total_componentes_si-$total_componentes_no."',
                y: ".$total_componentes=$total_componentes-$total_componentes_si-$total_componentes_no."
            }]
        }]
    });
});
</script>"; }?><br>
                    <textarea name="Observaciones" placeholder="Observaciones" style="margin: 0px; width: 85%; height: 100px;">@foreach($evaluacion as $evaluacion3)<?php for($i=0;$i<count($evaluacion3->observaciones);$i++){if($fila->id_documentos_proyecto==$evaluacion3->id_documentos_proyecto){echo $evaluacion3->observaciones;}}?>@endforeach</textarea>
                    <br>
                    <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$fila->id_proyecto}}">
                    <input type="hidden" name="h_id_usuario" id="h_id_usuario" value= <?php echo $id;?> >
                    <button name="Aceptar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Aceptar</button>
                  </form>
                  <form method="POST" action="evaluardocumento">
                      <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$fila->id_proyecto}}">
                      <input type="hidden" name="h_id_usuario" id="h_id_usuario" value= <?php echo $id;?> >
                      <button name="Cancelar" class="boton-grande" id="registro_boton"  value="<?php echo $fila->id_documentos_proyecto; ?>">Cancelar</button>
                  </form>
                </td>
                </tr>    
            <?php } else{  ?>
          <td><?php if($fila->nom_tipo=="Anexos"){ echo $fila->nom_tipo.": ".$fila->nombre_documento; }else{ echo $fila->nom_tipo; }?>
          </td>        
          <td>
          <?php $id_proyecto_p=$fila->id_proyecto;?>
          <form method="POST" action="evaluardocumento">
            <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$fila->id_proyecto}}">
            <input type="hidden" name="h_id_usuario" id="h_id_usuario" value= <?php echo $id;?> >
            <input type="hidden" id="id_tipo_documento" name="id_tipo_documento" value=<?php echo $fila->id_tipo_documento; ?>>
             <button name="Evaluar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Evaluar</button>
          </form>
          </td>
          <?php } ?>
                      <?php } else{  ?>
          <td><?php if($fila->nom_tipo=="Anexos"){ echo $fila->nom_tipo.": ".$fila->nombre_documento; }else{ echo $fila->nom_tipo; }?>
          </td>
          <td>
          <?php  $id_proyecto_p=$fila->id_proyecto;?>
            <form method="POST" action="evaluardocumento">
            <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value="{{$fila->id_proyecto}}">
            <input type="hidden" name="h_id_usuario" id="h_id_usuario" value= <?php echo $id;?> >
            <input type="hidden" id="id_tipo_documento" name="id_tipo_documento" value=<?php echo $fila->id_tipo_documento; ?>>
             <button name="Evaluar" class="boton-grande" id="registro_boton" value="<?php echo $fila->id_documentos_proyecto; ?>">Evaluar</button>
          </form>
          </td>
          <?php } ?>
    </tr>
    @endforeach 
  </tbody>
  </table>
</div>
<?php }
else{
  echo "No hay documentos registrados para ser evaluados";
}
?>
<br>

<div class="registro_titulo_div">Reportes</div> 

<br>
  <div>
    <table><tbody>
      <tr>
        <td>
          <form method="POST" action="reporte_modeladoEva/1" target="_blank">
            <input type="hidden" name="h_id_proyecto" id="h_id_proyecto" value=<?php echo $id_proyecto_p;?>>
            <input type="hidden" name="h_id_usuario" id="h_id_usuario" value=<?php echo $id;?>>
            <button name="reporte_modeladoEva" id="verReporte_boton" onclick="reporte(this)">Ver reporte de modelado</button>
          </form></td>
        <!--<td><a href="reporte_modeladoEva/2" target="_blank" ><button name="descargar_reporte" id="descargarReporte_boton">Descargar de reporte de modelado</button></a></td>-->
        <td>
           <form method="POST" action="reporte_modeladoEva/2" target="_blank">
            <input type="hidden" name="h_id_proyecto1" id="h_id_proyecto1" value=<?php echo $id_proyecto_p;?>>
            <input type="hidden" name="h_id_usuario1" id="h_id_usuario1" value=<?php echo $id;?>>
            <button name="descargar_reporte" id="descargarReporte_boton" onclick="reporte(this)" >Descargar de reporte de modelado</button>
          </form></td>
      </tr></tbody>
    </table>
  </div>

<style type="text/css">
      #tabla_com{
      text-align:left;
      height: 230px;
      width:100%;
      overflow: auto;
    }
    #grupo-controles-formulario{
    heigth:10px;
    }
  </style>
<script type="text/javascript">
    window.onload = function() {
      if (sessionStorage.getItem('id_rol') != 2  || sessionStorage.getItem('id_usuario') =="") {
        window.open('calidad/public/','_self');
      }
    };
</script>
@stop
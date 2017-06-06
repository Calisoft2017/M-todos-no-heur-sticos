<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">  <title>Reporte de modelado</title>
  <style>
    .col-md-12 {
      width: 100%;
    } 

    .box {
      position: relative;
      border-radius: 30px;
      background: #ffffff;
      border: 3px solid #d2d6de;
      margin-bottom: 20px;
      box-shadow: 0 1px 1px rgba(0,0,0,0.1);    
      padding: 30px;
    }

    .box-header {
      color: #444;
      display: block;
      padding: 10px;
      position: relative;
    }

    .box-header.with-border {
      border-bottom: 1px solid #f4f4f4;
    }

    .box-header .box-title {
      display: inline-block;
      font-size: 18px;
      margin: 0;
      line-height: 1;
    }

    .box-body {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-right-radius: 3px;
      border-bottom-left-radius: 3px;
      padding: 10px;
    }

    .box-footer {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-right-radius: 3px;
      border-bottom-left-radius: 3px;
      border-top: 1px solid #f4f4f4;
      padding: 10px;
      background-color: #fff;
    }

    table {
      background-color: transparent;
      border: 1px solid #000000;
      width: 100%;
      max-width: 100%;
      margin-bottom: 20px;
    }

    .badge {
      display: inline-block;
      min-width: 10px;
      padding: 3px 7px;
      font-size: 12px;
      font-weight: 700;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      background-color: #777;
      border-radius: 10px;
    }
    .div_titulos{
      font-weight: bold;
      text-align: center;
      width: 80%;
      margin-left: 10%;
      text-shadow: 1px 1px 1px black;
    }
    .div_titulo_primero{
      padding: 5px;
      font-size: 24px;
    }
    .div_titulo_segundo{
      padding: 5px;
      font-size: 18px;
    }
    .div_titulo_tercero{
      padding: 5px;
    }
    .div_titulo_cuarto{
      padding: 5px;
      font-weight: bold;
      text-align: center;
      text-shadow: 1px 1px 1px black;
    }

  </style>
    
</head>
<body>

<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Fecha de reporte - <?=  $date; ?></h3>
    </div>
  
    <div class="div_titulos">
      <div class="div_titulo_primero">UNIVERSIDAD DE CUNDINAMARCA</div>
      <div class="div_titulo_segundo">PLATAFORMA WEB PARA LA EVALUACIÓN DE PRODUCTOS SOFTWARE</div>
      <div class="div_titulo_segundo">Reporte de calidad de software</div>
      <div class="div_titulo_tercero">REPORTE GENERAL</div>
    </div>
    <br>
    <div class="div_informacion_principal">
      <?php
         foreach($evaluador as $eva){   
        ?>
      <div class="registro_titulo_div">Reporte realizado por el evaluador: <?= $eva->nombre ?> <?= $eva->apellido ?></div>
      <?php } ?>
      
      <?php
         foreach($proyecto as $proy){   
        ?>
          <br>
          <div class="registro_titulo_div">Nombre del proyecto: <?= $proy->name_proyecto ?></div>
          <div class="registro_titulo_div">Grupo de investigación: <?= $proy->name_investigacion ?></div>
          <div class="registro_titulo_div">Semillero de investigación: <?= $proy->name_semillero ?></div>
      <?php } ?>
    </div>
    <hr>
    <br>
        <div class="div_titulo_cuarto">EVALUACIÓN DEL MODELADO</div> 
        <br>
    <!--
      <div class="div_evaluacion_modelado">
        <div class="div_titulo_cuarto">EVALUACIÓN DEL MODELADO</div> 
        <div class="registro_titulo_div">Diagramas de casos de uso</div>
        <br>
        <div class="registro_titulo_div">modelo de entidad-relacion</div> 
        <br>
        <div class="registro_titulo_div">Diagramas de clases</div> 
        <br>
        <div class="registro_titulo_div">Diagramas de secuencia</div> 
        <br>
        <div class="registro_titulo_div">Diagramas de actividades</div> 
        <br>
        <div class="registro_titulo_div">Diagramas de despliegue</div> 
        <br>
      </div>
    -->
      <?php $band=0; $sii=0; $noo=0; $band1=0;
      if(count($evaluacion) > 0){   
      ?>
      <div"contenedor-tabla100">
          <table>
  <?php foreach($documentosproyecto as $fila){  ?>
<?php foreach($componente as $componente1){ ?>
  <?php foreach($evaluacion as $evaluacion1){?>
            <?php $evalua = explode(".", $evaluacion1->check); 
            for($i=0;$i<count($evalua);$i++){
	      if($fila->id_tipo_documento==$componente1->id_tipo_documento){
		if($componente1->id_documento_componente==$evalua[$i]){ ?>
			<tr>   
			<td colspan="2">
			<?php if($band==0){ ?><div class="div_titulos"><div class="div_titulo_tercero"><?echo $fila->nom_tipo;?></div></div><hr>
			<b>Observaciones: </b> <?php echo $evaluacion1->observaciones; $band=1; $band1=1;?><?php } ?></div>
			<?php if($evalua[$i+1]=="SI"){$sii=$sii+1;} if($evalua[$i+1]=="NO"){$noo=$noo+1;} ?> 
		<?php }?>
              <?php }?>
             <?php }?>
   <?php }?>
<?php }?>  
	<?php if($band1==1){ ?><b>Aprobo: </b><?php echo $sii;?><br><b>No Aprobo: </b><?php echo $noo;?><?php $band1=0; } ?>                   
  </td>
</tr> 
 <?php  $band=0; $band1=0; $sii=0; $noo=0;}?>
</table>
      </div>
      <?php }
      else{
        echo "No hay documentos registrados";
      }?>
    <hr>
    <br>
    <div class="div_evaluacion_plataforma">
      <div class="div_titulo_cuarto">EVALUACIÓN DE LA PLATAFORMA</div> 
      <br>
      <div class="registro_titulo_div" style="text-align: center;">CASOS DE PRUEBA</div> 

      <?php
         if(count($casoPrueba) > 0){   
        $sumaPorc = 0;  
        $sumaC = 0;
        $nCasoPruebas = 0;
        ?>
          <div class="contenedor-tabla100">

                <?php 
                  foreach($porcentaje as $porc){ 
                    if ($porc->name_campo == "prioridadAlta") {
                      $cAlta = $porc->valor;
                    }
                    elseif ($porc->name_campo == "prioridadMedia") {
                      $cMedia = $porc->valor;
                    }
                    elseif ($porc->name_campo == "prioridadBaja") {
                      $cBaja = $porc->valor;
                    }
                  }
		foreach($casoPrueba as $fila){ 
                    $nCasoPruebas ++;
		?>
              <table>
                <thead>
                  <tr>
                    <th class="th_proyectos">Nombre del caso de prueba</th>
                  </tr>
                  <tr>
                    <th class="th_proyectos"><?= $fila->name_casoPrueba ?></th>
                  </tr>
                </thead>
              </table>
              <table>
                <tbody>
                  <tr>
                    <th class="th_proyectos">Propósito</th>
                    <td><?= $fila->proposito ?></td>
                  </tr>
                  <tr>
                    <th class="th_proyectos">Objetivo</th>
                    <td><?= $fila->objetivo ?></td>
                  </tr>
                  <tr>
                    <th class="th_proyectos">Alcance</th>
                    <td><?= $fila->alcance ?></td>
                  </tr>
                  <tr>
                    <th class="th_proyectos">Resultado esperado</th>
                    <td><?= $fila->resultadoEsperado ?></td>
                  </tr>
                  <tr>
                    <th class="th_proyectos">Prioridad</th>
                    <td><?= $fila->prioridad ?></td>
                  </tr>
                  <tr>
                    <th class="th_proyectos">Fecha limite</th>
                    <td><?= $fila->fecha_limite ?></td>
                  </tr>
                  <?php
                  if($casoPrueba[0]->txt != "_"){
                  ?>
                  <tr>
                    <th class="th_proyectos">Observaciones de estudiante</th>
                    <td><?= $fila->observacionEstudiante ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>

              <?php  
                $aprobado = 0;
                $noAprobado = 0;
                $sinCalificar = 0;
                $totalPruebas = 0;
                $CP = 0;
                foreach($pruebas as $prueba){
                  if ($prueba->id_casoPrueba == $fila->id_casoPrueba) {
                    if ($prueba->estado == "Aprobado") {
                      $aprobado ++;
                    }
                    elseif ($prueba->estado == "No aprobado") {
                      $noAprobado ++;
                    }
                    elseif ($prueba->estado == "sin calificar") {
                      $sinCalificar ++;
                    }
                    $totalPruebas ++;
                  }
                }
                
                if ($totalPruebas != 0) {
                  $CP = ($aprobado*100)/$totalPruebas;
                }
              if ($fila->prioridad == "alta") {
                $C = $cAlta;
              }
              elseif ($fila->prioridad == "media") {
                $C = $cMedia;
              }
              elseif ($fila->prioridad == "media") {
                $C = $cBaja;
              }

                $sumaC += $C;
                $sumaPorc += $CP * $C;
                $result = $sumaPorc / $sumaC;
              ?>
              <table>
                <thead>
                  <tr>
                    <th class="th_proyectos">ESTADISTICA DE LAS PRUEBAS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Aprobados: <?= $aprobado ?></td>
                  </tr>
                  <tr>
                    <td>No aprobados: <?= $noAprobado ?></td>
                  </tr>
                  <tr>
                    <td>Sin calificar: <?= $sinCalificar ?></td>
                  </tr>
                  <br>
                  <tr>
                    <td>Total pruebas: <?= $totalPruebas ?></td>
                  </tr>
                </tbody>
              </table>
              <br>
              <?php  
              } ?>  
          </div>
          <table><tbody>
            <tr>
              <th>RESULTADOS</th>
            </tr>
            <tr>
              <td>Numero de casos de prueba: <?= $nCasoPruebas ?></td>
            </tr>
            <tr>
              <td>Porcentaje de aprobacion: <?= $result ?></td>
            </tr>
          </tbody></table>
        <?php 
        }
        else{
          echo "No hay casos de prueba creados";
        }
      ?>
      <div>
        
      </div>
    </div>

  </div><!-- /.box -->
</div>

</body>
</html>

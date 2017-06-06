<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">  <title>Reporte de gestion de pruebas </title>
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
      <div class="div_titulo_tercero">REPORTE DE GESTION DE PRUEBAS Y PRUEBAS FUNCIONALES</div>
    </div>
    <br>
    <div class="div_informacion_principal">
      <?php
         foreach($estudiante as $est){   
        ?>
      <div class="registro_titulo_div">Reporte realizado por el estudiante: <?= $est->nombre ?> <?= $est->apellido ?></div>
      <?php } ?>
      <?php
         foreach($proyecto as $proy){   
        ?>
          <br>
          <div class="registro_titulo_div">Nombre del proyecto: <?= $proy->name_proyecto ?></div>
          <div class="registro_titulo_div">Grupo de investigación: <?= $proy->name_investigacion ?></div>
          <div class="registro_titulo_div">Semillero de investigación: <?= $proy->name_semillero ?></div>
          <br>
      <?php } ?>
      <?php
         foreach($evaluador as $eva){   
        ?>
      <div class="registro_titulo_div">Evaluador asignado: <?= $eva->nombre ?> <?= $eva->apellido ?></div>
      <?php } ?>
    </div>
    <br>
    <hr><br>
    <div style="visibility: hidden;">
    <div class="div_titulo_cuarto">EVALUACIÓN DE LA PLATAFORMA</div> 
    
    <div>
      <table>
      </table>
    </div>
    <hr>
    </div>
    <div class="div_evaluacion_plataforma">
      <div class="div_titulo_cuarto">EVALUACIÓN DE LA PLATAFORMA </div> 
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
                    <th class="th_proyectos">NOMBRE DEL CASO DE PRUEBA</th>
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
                  if($fila->observacionEstudiante != "_"){
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
                  ?>
                  <?php
                  }
                }

                if ($totalPruebas != 0) {
                  $CP = ($aprobado*100)/$totalPruebas;
              ?>
                <table><tbody>
                  <tr><th>Pruebas</th></tr>
                </tbody></table> 
                <table><tbody>
                  <tr>
                    <th>Prueba</th>
                    <th>calificacion</th>
                    <th>observaciones</th>
                  </tr>
                <?php  
                  foreach($pruebas as $prueba){
                    if ($prueba->id_casoPrueba == $fila->id_casoPrueba) {
                    ?>
                    <tr>
                      <td><?= $prueba->name_Prueba ?></td>
                      <td><?= $prueba->estado ?></td>
                      <td><?= $prueba->observacion ?></td>
                    </tr>
                    <?php
                    }
                  }
                ?>
                </tbody></table>
              <?php } 
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

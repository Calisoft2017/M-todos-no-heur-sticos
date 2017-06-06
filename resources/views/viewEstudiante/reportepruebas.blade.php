@extends('layouts.principal')

@section('navegacion')

@stop

@section('content')
<?php /*$ban=0; $evalua=""; $observacion="No se ha encontrado evaluación para este documento";?>
@foreach($evaluacion as $evaluacion)
        <?php 
        $evalua = explode(".", $evaluacion->check);
        $observacion = $evaluacion->observaciones;
        $ban=1;
 @endforeach     */ ?>

<?php 
if(count($reporte) > 0){   
?>
<div class="contenedor-tabla100">
  <table>
  <tbody>
    <tr>
      <th>Tipo de Documento</th>
    </tr>
    <?php echo 'Total componentes:'.$cantidad_comp;?>
    @foreach($reporte as $fila)
    <tr>
       <td>
          <div class="titulo">{{$fila->nombre_documento}}</div>
          <br>  
             <?php echo 'Observaciones:'.$fila->observaciones;?>
            
             <?php  $sii=0; $noo=0;   
             $evalua = explode(".", $fila->check);
              for ($i=1; $i < sizeof($evalua)-1; $i++) { 
              if($evalua[$i]=='SI'){
                $sii=$sii+1;
              }
              if($evalua[$i]=='NO'){
                $noo=$noo+1;
              }
              //echo $evalua[$i].'<br>';
            }
              echo '<br>'.'Aprobados:'.$sii;
              echo  '<br>'.'No aprobados'.$noo;
              
            ?>
      </td>
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
    #id_tipo_documento{
      visibility: hidden;
    }
  </style>
</div>
<?php }else{
  echo "No hay documentos registrados";
}?>
@stop
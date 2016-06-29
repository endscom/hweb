<div class="caja">
  <div class="row cabecera">
    <div class="col s12 center-align">
    <label class="encabezado">REPORTE CONSOLIDADO Nº <?php echo $xd2 ?></label>

      
    </div>
  </div>  
</div>
<br>
<form id="ekisde" name="ekisde" action="" method="post" class="col s12 l12">
  <div class="row">
    <div class="col s12 l12">

      <div class="row">
       <div class="col s12 l2">
    <a  href="<?php echo base_url('index.php/vercomparativa')?>" class="btn btn-primary">REGRESAR</a>
      </div>
       <div class="col offset-l6 s12 l2">
        <a class="waves-effect waves-light btn" onclick="generarPdf()" ><i style="font-size:30px;" class="material-icons right">picture_as_pdf</i>VER PDF</a>
      </div>
      <div class="col s12 l2">
        <a class="waves-effect waves-light btn" onclick="generarExcel()" ><i style="font-size:30px;" class="material-icons right">file_download
</i>EXCEL</a>
      </div>
    </div>
     <div class="row" style="overflow-x: auto;">
    <table id="Tabla" name="mitabla" class=" striped responsive-table " cellspacing="1" cellpadding="2">
      <thead> 
        <tr>
          <th rowspan="2">NOMRE</th>
          <th rowspan="2">CARGO</th>   
          <th rowspan="2">Nº  REPORTE</th>                  
          <th rowspan="2">IDEM</th> 
          <th colspan="<?php echo $xd+1; ?>">PERIODO REPORTADO DEL: <?php echo $datos[0]['Finicio']; ?> al <?php echo $datos[0]['Ffinal']; ?> </th> 
           </tr>
           <tr>
          <?php           
          for($i = 0; $i < count($rangoDateES); ++$i) {?>
          <th class="sumvertical"><?php echo $rangoDateES[$i]?></th>
          <?php }?>
          <th class="sumvertical">TOTAL</th>         
        </tr>            
      </thead>
      <tfoot>
        <tr>
          <th colspan="4">TOTAL</th>                

          <?php       
          for($i = -1; $i < count($rangoDate); ++$i) {?>
          <th class="vertical"></th>
          <?php }?>
        </tr>
      </tfoot>
      <tbody>  

        <?php 
        if (!($detalle)) {                                                                
        } else {
          $contador=1;
          foreach ($detalle->result() as $Facts) { 

           ?>
           <tr class="">                               
             <td><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->NOMBRE; $contador++ ?>"><?php echo $Facts->NOMBRE;?></td>
             <td><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->CARGO; $contador++ ?>"><?php echo $Facts->CARGO;?></td>   
             <td><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->IdRHE; $contador++ ?>"><?php echo $Facts->IdRHE;?></td>  
             <td><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->IDEMP; $contador++ ?>"><?php echo $Facts->IDEMP;?></td>    
             <?php
             $Miarra = $xd;
             $Total=0;
             for ($i=1; $i <=$Miarra ; $i++) 
             { 
              $cadena="FECHA";
              $cadena.=$i;
              ?>
              <td class="sumar"><?php echo  $Facts->$cadena; $Total=$Total+ $Facts->$cadena;?></td> 
              <?php }?>
              <td class="sumar"><?php echo $Total; $Total=0;?></td>    
            </tr>                               
            <?php }}?>   

          </tbody>
        </table>
        </div>
      </div>
    </div>
    <input type="hidden" id="idc" name="idc">

    <input type="hidden" id="idreporte" name="idreporte" value="<?php echo $xd2?>">
  <div class="row">
  <div class="col  s12 l12">  
           <ul class="collapsible" data-collapsible="accordion">
            <li>
              <div class="collapsible-header active" style="font-size: 24px;"><i class="material-icons" style="font-size: 30px; color: #00658F">assignment</i>COMENTARIO</div>
              <div class="collapsible-body">
              <textarea readonly type="text" style="padding-top: 0%; background-color: #CDDFE9; border-bottom: none; font-size: 19px; margin: 0" name="comentario" id="textarea1" class="materialize-textarea center"><?php echo $datos[0]['comentario'];?></textarea>
            </div>
            </li>
          </ul>
  </div>    
 </div>

  </form>

  <form name="pdf" id="pdf" action="<?php echo base_url('index.php/consolidadopdf')?>" method="post" target="_blank">
       <input type="hidden" name="idreporte" id="idreporte" name="idreporte" value="<?php echo $xd2?>">
  </form>

  <form name="excel" id="excel" action="<?php echo base_url('index.php/consolidadoexcel')?>" method="post">
    
       <input type="hidden" name="idreporte" id="idreporte" name="idreporte" value="<?php echo $xd2?>">

  </form>

  <div class="row">
   <div class="col s12 l4 center-align">
     <input placeholder="Placeholder" readonly="true" class="center-align" id="elaborado" type="text" value="<?php foreach($empleados as $key): echo $key['elabora']; endforeach?>" >
       <i class="material-icons prefix">mode_edit</i>
     <label  for="elaborado">ELABORADO POR</label>
   </div>
   <div class="col s12 l4 center-align">
     <input placeholder="Placeholder" readonly="true" class="center-align" id="elaborado" type="text" value="<?php foreach($empleados as $key): echo $key['revisa']; endforeach?>">
      <i class="material-icons prefix" style="color: blue;">done</i>
     <label  for="elaborado">REVISADO POR</label>
   </div>
   <div class="col s12 l4 center-align">
     <input placeholder="Placeholder" readonly="true" class="center-align" id="elaborado" type="text" value="<?php foreach($empleados as $key): echo $key['autoriza']; endforeach?>">
        <i class="material-icons prefix" style="color: blue;">done_all</i>
     <label  for="elaborado">AUTORIZADO POR</label>
   </div>
 </div>
 <script>
   $(document).ready(function() {
    var table=  $('#Tabla').DataTable( {  
      
                    "searching":false,
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [3] }]
    } );
    /*-------*/
    table.columns( '.sumvertical' ).every( function () {
      var sum = this
      .data()
      .reduce( function (a,b) {
      //  console.log(a)
        return (parseFloat(a) + parseFloat(b)).toFixed(2);
      } );
      $( this.footer() ).html(sum);
    } ); 
    var nColumnas = $("#Tabla th").length;
    var columnas = nColumnas-4;
    document.getElementById('idc').value = columnas;   
  } );  
 </script>

<script>
 function generarPdf()
  {
     document.getElementById('pdf').submit();
        }

  function generarExcel()
  {
     document.getElementById('excel').submit();
        }
</script>

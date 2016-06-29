<!--INICIO DE LA TABLA***************************************-->
<form action="<?php echo base_url('index.php/guardar')?>" method="post" class="col s12">
  <div class="row">
    <div class="col s12 l12">
      <div class="row">
       <div class="col s12 l2">   
    <a  href="'.base_url('index.php/verautorizados').'" class="btn btn-primary">REGRESAR</a>     
      </div>
       <div class="col offset-l8 s12 l2">
        <a class="waves-effect waves-light btn" onclick="generarPdf()" ><i style="font-size:30px;" class="material-icons right">picture_as_pdf</i>VER</a>
      </div>
    </div>
    <div class="row" style="overflow-x: auto;">
    <table id="Tabla" name="mitabla" class=" striped responsive-table " cellspacing="1" cellpadding="2">
      <thead> 
        <tr>
          <th rowspan="2">NOMRE</th>
          <th rowspan="2">CARGO</th> 
          <th rowspan="2">IDEM</th> 
          <th rowspan="2">RHE</th>  
          <th colspan="<?php echo $xd ?>">PERIODO REPORTADO DEL <?php echo $datos[0]['Finicio']; ?> AL <?php echo $datos[0]['Ffinal'];?></th>
          </tr>
          <tr>
          <?php for($i = 0; $i < count($rangoDate); ++$i) {?>
          <th><?php echo $rangoDateES[$i]?></th>
          <?php }?>
        </tr>            
      </thead>
      <tbody>  

        <?php 
        if (!($detalle)) {                                                                
        } else {
          $contador=1;
          foreach ($detalle->result() as $Facts) { 

           ?>
           <tr>                               
             <td><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->NOMBRE; $contador++ ?>"><?php echo $Facts->NOMBRE;?></td>
             <td><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->CARGO; $contador++ ?>"><?php echo $Facts->CARGO;?></td> 
             <td><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->IDEMP; $contador++ ?>"><?php echo $Facts->IDEMP;?></td> 
             <td><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->IdRHE; $contador++ ?>"><?php echo $Facts->IdRHE;?></td>  
             <?php
             $Miarra = $xd;
             for ($i=1; $i <=$Miarra ; $i++) 
             { 
              $cadena="FECHA";
              $cadena.=$i;
              ?>
      <td><input style="border-bottom: 0px solid #00658F; text-align: center; margin: 0 0 0px 0;" type="number" readonly step="any" min="0" max="8" name="<?php echo $contador; ?>" value="<?php echo $Facts->$cadena; $contador++;?>"></td> 
              <?php }?>                                                     
            </tr>                               
            <?php }}?>   

          </tbody>
        </table>
        </div>
      </div>
    </div>
    <input type="hidden" id="idc" name="idc">

    <input type="hidden" id="idreporte" name="idreporte" value="<?php echo $xd2?>">
  </form>
<div class="row">
  <div class="col  s12 l12">    
                <div class="input-field col s12" style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);">
              <textarea readonly type="text" name="comentario" id="textarea1" class="materialize-textarea"><?php echo $datos[0]['comentario'];?></textarea>
                  <label for="textarea1" style="color: #F44336;">COMENTARIO INGRESADO EN EL REPORTE</label>
                </div>
  </div>    
 </div>
  
  <div class="row">
   <div class="col s12 l4 center-align">

     <input placeholder="Placeholder" readonly="true" class="center-align" id="elaborado" type="text" value="<?php foreach($empleados as $key): echo $key['elabora']; endforeach?>">
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
<form name="pdf" id="pdf" action="<?php echo base_url('index.php/ingresohepdf')?>" method="post" target="_blank">
       <input type="hidden" name="idreporte" id="idreporte" name="idreporte" value="<?php echo $xd2?>">
  </form>

<script>
 function generarPdf()
  {
     document.getElementById('pdf').submit();
        }
</script>

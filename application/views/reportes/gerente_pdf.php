<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SISTEMA DE GESTION HUMANA HWEB</title>
  <!--Import Google Icon Font localmente by Alder-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/fuente.css" >

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>  

  <!--Import materialize.css-->
  <script src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/media/js/extensions/dataTables.colVis.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/media/js/extensions/dataTables.tableTools.min.js"></script>

  <!--CARGO CSS-->  
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.min.css"  media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/index_home.css'); ?>">    
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.select.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.css" >
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/media/css/extensions/dataTables.tableTools.css" />
</head>
<br><br>
<div class="card" style="text-align: center;">
 <div class="card-image">
  <img src="<?php echo base_url('assets/img/guna_full_color.png');?>">
</div>
</div>
<br>
<div class="caja">
  <div class="row cabecera">
    <div class="col s12 center-align" style="text-align: center;">
      <label class="encabezado" >REPORTE DE HORAS EXTRAS Nº <?php echo $xd2 ?></label>      
    </div>
  </div>  
</div>
<br>
<!--INICIO DE LA TABLA***************************************-->
<form action="<?php echo base_url('index.php/guardar')?>" method="post" class="col s12">
  <div class="row">
    <div class="col s12 l12">

      <div class="row">
       <div class="col s12 l2">
         <?php  if($this->session->userdata['Tipo']=="Super Administrador"){
          echo '<a  href="'.base_url('index.php/vercomparativa').'" class="btn btn-primary">REGRESAR</a>';
        }
        elseif($this->session->userdata['Tipo']=="Administrador"){
          echo '<a  href="'.base_url('index.php/autorizar').'" class="btn btn-primary">REGRESAR</a>';
        }?>

      </div>
    </div>
    <div class="row" style="overflow-x: auto;">
      <table  id="Tabla" name="mitabla" class=" striped responsive-table " cellspacing="1" cellpadding="2">
        <thead> 
          <tr>
            <th rowspan="2">NOMRE</th>
            <th rowspan="2">CARGO</th> 
            <th rowspan="2">ID EMPLEADO</th> 
            <th rowspan="2">REPORTE Nº</th>                   
            <th colspan="<?php echo $xd ?>">PERIODO REPORTADO DEL: <?php echo $datos[0]['Finicio']; ?> al <?php echo $datos[0]['Ffinal']; ?> </th>   
          </tr>
          <tr>               
            <?php for($i = 0; $i < count($rangoDateES); ++$i) {?>
            <th rowspan="1"><?php echo $rangoDateES[$i]?></th>
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
                <td><?php echo $Facts->$cadena; $contador++;?></td> 
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

      <p>COMENTARIO:</p>

      <?php 
      if ($datos[0]['comentario']=="") {
       echo '<textarea rows="1" cols="100%">No hay comentarios.</textarea>';   
     }
     else{?>
     <textarea rows="15" cols="100%" style="width: 100%; font-size: 8px;"><?php echo $datos[0]['comentario'];?></textarea>
     <?php }
     ?>     
   </div>    
 </div>
 <br>
 <div class="row" style="text-align: left;">
   <div class="col s12 l12 ">
     <label  for="elaborado">ELABORADO POR: <?php foreach($empleados as $key): echo $key['elabora']; endforeach?></label>
   </div>
 </div>
 <div class="row" style="text-align: left;">
   <div class="col s12 l12 ">
     <label  for="elaborado">REVISADO POR: <?php foreach($empleados as $key): echo $key['revisa']; endforeach?> </label>     
   </div>
 </div>
 <div class="row" style="text-align: left;">
   <div class="col s12 l12 ">
     <label  for="elaborado">AUTORIZADO POR: <?php foreach($empleados as $key): echo $key['autoriza']; endforeach?></label>
   </div>
 </div>
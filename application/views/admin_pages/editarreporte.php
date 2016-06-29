
<div class="row cabezera">
  <div class="col l12">
    <div class="col l10  texto">
      <label class="cabezera right-align" for="">PERIODO REPORTADO:</label>
      <label class="cabezera right-align" for="last_name"><?php echo $idMax1[0]['Finicio']." al ".$idMax1[0]['Ffinal'];  ?></label>  
    </div>
    <div class="regresar  col l1">
     <a  href="<?php echo base_url('index.php/vertodos')?>"><input type="button"  class="btn btn-primary"  value="REGRESAR"></a>
   </div>
 </div>
</div>


<div class="card general">  
  <div class="row">
    <br>
    <form>
      <div class="row textos">
        <div class="label col offset-l5 s6 l6 text">
          <label class="letra" for="">FECHA DE ELABORACION:</label>        
          <label class="letra" for="last_name"><?php echo $idMax1[0]['FechaE']; ?></label>
        </div>  
      </div>

      <div class="row textos">                  
        <div class="col s12 l5 txtselect">
         <label class="letra" for="email">SELECCIONE LA GERENCIA:</label>
       </div>
       <div class="col s12 l6 txtselect">
        <label style="margin-left:0%" class="letra" for="email">SELECCIONE EL EMPLEADO(A):</label>
      </div>                   
    </div>

    <div class="row selectores">
      <div class="col s12 l5">
        <select id="sc_get" data-placeholder="..."  class="browser-default chosen-select"  name="nameR" style="width:400px;" >
         <option  value="" disabled selected></option>
         <?php foreach($gerencia as $key):  ?>
          <option value="<?php echo $key['IdGR']; ?>"> <?php echo $key['Gerencia'];  ?></option>
        <?php endforeach ?>
      </select>
    </div>    
    <div class="col s12 l6">
      <select id="empleado"  class="browser-default chosen-select"  name="subcat"  style=" margin-left:0%;width:500px;" >
      </select>
    </div>
  </div>

  <div class="row btnagregar">                   
    <div class="col  s12 ">
      <input  type="button" id="agregar" class="btn btn-primary"  value="AGREGAR">


    </div>    
  </div>
</form></div>
</div>
<!--FIND DEL FORMULARIOO***************************************-->
<!-- *****************Modal Structure *****************-->
<div id="modal1" class="modal col s12 l5">
  <div class="modal-content">
   <form  action="<?php echo base_url('index.php/updateReporte')?>" name="formarchivo"  method="post" enctype="multipart/form-data" id="form1">
     <?php foreach($idMax1 as $key): ?>
      <input type="hidden" name="idh" value="<?php echo $key['IdRHE'];?>">
    <?php endforeach ?>
    <h4>EDICION DE FECHA</h4>
    <p>POR FAVOR SELECCIONE LA FECHA DE INICIO:</p>
    <input name="fecha" id="fecha" type="date" class="datepicker">
    <p>POR FAVOR SELECCIONE LA FECHA FINAL:</p>
    <input name="fecha1" id="fecha1" type="date" class="datepicker">

  </div>
  <div class="modal-footer">
    <input type="button" class="waves-effect" onClick="validar()" value="Aceptar">              
  </form>
</div>
</div>

      <div class="row">
  <div class="col offset-l8 s12 l1">
   <input type="button"  id="eliminar" class="btn btn-primary"  value="ELIMINAR EMPLEADO">
 </div>

  <div class="col offset-l2 s12 l1" style="margin-left: 120px; width: auto;">
        <a class="waves-effect waves-light btn" onclick="generarPdf()" ><i style="font-size:30px;" class="material-icons right">picture_as_pdf</i>VER</a>
  </div>
</div>

<!--INICIO DE LA TABLA***************************************-->
<form action="<?php echo base_url('index.php/guardar')?>" method="post" class="col s12">
  <div class="row">
    <div class="col s12 l12">

      <div class="row" style="overflow-x: auto;">
       <table id="Tabla" name="mitabla" class="tableDatos  responsive-table " cellspacing="1" cellpadding="2">
        <thead> 
          <tr>
            <th rowspan="2">NOMRE</th>
            <th rowspan="2">CARGO</th>                  
            <th rowspan="2">RHE</th> 
            <th rowspan="2">IDEM</th>  
            <th colspan="<?php echo $xd ?>">PERIODO REPORTADO DEL: <?php echo $datos[0]['Finicio']; ?> al <?php echo $datos[0]['Ffinal']; ?> </th>   
          </tr>
          <tr>                     
            <?php for($i = 0; $i < count($rangoDateES); ++$i) {?>
            <th><?php echo $rangoDateES[$i];?></th>
            <?php }?>
          </tr>            
        </thead>
        <tbody>  

         <?php 
         if (!(@$detalle)) {  
         } else {
          $contador=1;
          foreach ($detalle->result() as $Facts) { 
           ?>
           <tr>                               
            <td style="width: 120px;"><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo $Facts->NOMBRE; $contador++ ?>"><?php echo $Facts->NOMBRE;?></td>
            <td style="width: 120px;"><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo  $Facts->CARGO; $contador++ ?>"><?php echo  $Facts->CARGO;?></td>   
            <td style="width: 120px;"><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo  $Facts->IdRHE; $contador++ ?>"><?php echo  $Facts->IdRHE;?></td>  
            <td style="width: 120px;"><input type="hidden" name="<?php echo $contador; ?>" value="<?php echo  $Facts->IDEMP; $contador++ ?>"><?php echo  $Facts->IDEMP;?></td>   
            <?php
            $Miarra = $xd; 
            for ($i=1; $i <=$Miarra ; $i++) 
            { 
              $cadena="FECHA";
              $cadena.=$i;
              ?>
              <td style="width: 120px;"><input style="border-bottom: 0px solid #00658F; text-align: center; width: 65px; margin: 0 0 0px 0;" type="number" step="any" min="0" max="8" name="<?php echo $contador; ?>" value="<?php echo $Facts->$cadena; $contador++;?>"></td> 
              <?php }?>                                                                              
            </tr>                               
            <?php }}?>   
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col  s12 l5">
        <ul class="collapsible" data-collapsible="accordion" style="margin: -0.5rem 0 1rem 0;">
          <li>
            <div class="collapsible-header active"><i class="material-icons" style="font-size: 32px;">note_add</i>AGREGAR COMENTARIO AL REPORTE (OPCIONAL)</div>
            <div class="collapsible-body">
                <div class="input-field col s12" style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);">
                   <textarea type="text" name="comentario" id="textarea1" class="materialize-textarea"><?php echo $idMax1[0]['comentario']; ?></textarea>
                  <label for="textarea1" style="color: #F44336;">INGRESE COMENTARIO SOLO EN CASOS ESPECIALES</label>
                </div>
            </div>
          </li>
        </ul> 
    </div>
    <div class="col offset-l5 s12 l2">
      <input type="submit"  id="guardar" class="btn btn-primary"  value="GUARDAR CAMBIOS">
    </div>
    
  </div>
<input type="hidden" id="idc" name="idc">
<input type="hidden" id="idreporte" name="idreporte" value="<?php echo $xd2;?>">
</form>
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
 <form name="pdf" id="pdf" action="<?php echo base_url('index.php/edicionhepdf')?>" method="post" target="_blank">
       <input type="hidden" name="idreporte" id="idreporte" name="idreporte" value="<?php echo $xd2?>">
  </form>
<script>
  $(document).ready(function()
  {
    $('.modal-trigger').leanModal();
  });
</script>
<script>
  function validar()
  {
    if(document.getElementById('fecha').value=='')
    {
      alert('ELIJA UNA FECHA DE INICIO')
    }  
    else if(document.getElementById('fecha1').value=='')   
    {
      alert('ELIJA UNA FECHA FINAL')
    } 
    else
    {
      document.formarchivo.submit();      
    }       
  }
</script>
<script>
 $(document).ready(function() {
   var nColumnas = $("#Tabla th").length;
   var columnas = nColumnas-5;
   document.getElementById('idc').value = columnas; 
 } );  
</script>
<script>
 function generarPdf()
  {
     document.getElementById('pdf').submit();
        }
</script>

<div id="contenedor" class="row">
    <!--**********INICIO DEL FORMULARIOO***************************************-->

    <div class="row cabecera">
        <div class="col s12 center-align">PREPARACION DE HORAS EXTRAS</div>
    </div>

    <form class="col s12">

      <div class="row">
       <div class="col s12 l3">
        <label for="email">Seleccione la Gerencia:</label>
    </div>
    <div class="col s12 l4">
        <select id="sc_get" data-placeholder="..."  class="browser-default chosen-select"  name="nameR" style="width:400px;" >
         <option  value="" disabled selected></option>
         <?php foreach($gerencia as $key):  ?>
          <option value="<?php echo $key['IdGR'] ?>"> <?php echo $key['Gerencia']  ?></option>
      <?php endforeach ?>
  </select>
</div>			
</div>

<div class="row">
   <div class="col s12 l3">
    <label for="email">Seleccione el empleado:</label>
</div>

<div class="col s12 l4">
    <select id="empleado"  class="browser-default chosen-select"  name="subcat"  style="width:400px;" >
    </select>
</div>
<div class="col s12 l2">
    <input type="button" id="agregar" class="btn btn-primary"  value="AGREGAR">
</div>
</div>
</form>
<!--FIND DEL FORMULARIOO***************************************-->

<!--INICIO DE LA TABLA***************************************-->

<form action="<?php echo base_url('index.php/guardar')?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12 l12">

            <div class="row">
               <div class="col s12 l2">
                <input type="button"  id="eliminar" class="btn btn-primary"  value="ELIMINAR ">
            </div>
        </div>
        <table id="Tabla" name="mitabla" class=" striped responsive-table " cellspacing="1" cellpadding="2">
            <thead> 
                <tr>
                  <th>NOMRE</th>
                    <th>RHE</th>                  
                    <th>IDEM</th> 
                    <th>CARGO</th>                       
                    <?php for($i = 0; $i < count($rangoDate); ++$i) {?>
                    <th><?php echo $rangoDate[$i]?></th>
                    <?php }?>
                </tr>            
            </thead>
        </table>
    </div>
</div>

<div class="row">
   <div class="col s12 l2">
    <input type="submit"  id="guardar" class="btn btn-primary"  value="GUARDAR">
</div>
</div>

<input type="hidden" id="idc" name="idc">

<input type="hidden" id="idreporte" name="idreporte" value="<?php echo $idRHE[0]?>">
</form>




<div class="row">
   <div class="col s12 l4 center-align">

     <input placeholder="Placeholder" readonly="true" class="center-align" id="elaborado" type="text" value="<?php echo $this->session->userdata('Nombre'); ?>">
      <i class="material-icons prefix">mode_edit</i>
          <label  for="elaborado">ELABORADO POR</label>
    </div>
    <div class="col s12 l4 center-align">

     <input placeholder="Placeholder" readonly="true" class="center-align" id="elaborado" type="text" value="<?php echo $this->session->userdata('Nombre'); ?>">      
     <i class="material-icons prefix" style="color: blue;">done</i>
          <label  for="elaborado">REVISADO POR</label>
    </div>
    <div class="col s12 l4 center-align">

     <input placeholder="Placeholder" readonly="true" class="center-align" id="elaborado" type="text" value="<?php echo $this->session->userdata('Nombre'); ?>">     
        <i class="material-icons prefix" style="color: blue;">done_all</i>
          <label  for="elaborado">AUTORIZADO POR</label>
    </div>
</div>

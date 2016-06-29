<div class="cajauser">
	<div class="row cabecera">
		<div class="col l12 center">
      <br>
      <label class="encabezado">EMPLEADOS</label>
    </div>
  </div>	
  <div class="row">
   <div class="col s12 l3"  style="margin-left: 80%;">
     <a href="#modalempleado" class="waves-effect waves-light btn modal-trigger2"><i class="material-icons left">add_circle_outline</i>AGREGAR EMPLEADO</a>
   </div>
   <br><br>
 </div>
</div>
<form method="post" action="<?php echo base_url('index.php/reporXgerencia')?>" name="formulario1" class="col s12">
  <input type="hidden" id="valor" name="idGR" >
  <div class="row">
    <div class="col s12 l12">
      <table id="Tabla_Comparativos" class="striped responsive-table" cellspacing="1" cellpadding="2">
        <thead> 
          <tr>
            <th>Nº Unico</th>
            <th>NOMBRE</th>                     
            <th>EMPRESA</th>
            <th>CARGO</th>
            <th>OPCIÓN</th> 
          </tr>
        </thead>
        <tbody>
         <?php 
         if (!($empleados)) {                                                                
         } 
         else 
         {
          foreach ($empleados as $rep) {    
           ?>
           <tr>                    
            <td><?php echo $rep['IdUnico']; ?></td>
            <td><?php echo $rep['Nombre']; ?></td>         
            <td><?php echo $rep['Empresa']; ?></td> 
            <td><?php echo $rep['Cargo']; ?></td> 
            <td class="tooltipped" data-position="top" data-delay="5" data-tooltip="PRESIONE PARA DAR DE BAJA AL EMPLEADO: <?php echo $rep['Nombre']; ?>"><i style="font-size: 30PX;color: #D50000;"  class="material-icons prefix">close</i></a></td>                              
          </tr>                              
          <?php }}?>   
        </tbody>
      </table>
    </div>
  </div>
</form>

<!-- Modal Structure -->
<div id="modal22" class="modal">
  <div class="modal-content">
    <form name="formulariouser" id="formulariouser" action="<?php echo base_url('index.php/deleteusuario')?>" method="post">   
      <h5 class="center">¿ESTA SEGURO DE QUE DESEA DAR DE BAJA A ESTE USUARIO?</h5>
      <p class="center" style="color:red;">Una vez dado de baja al usuario este solo podrá ser restituido poniéndose en contacto con el administrador del sistema.</p>
      <input id="name" name="name" type="text" value="Usuarios a eliminar:">
      <input id="idDelete" name="idDelete" type="hidden">
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">CANCELAR</a>
      <a href="#!" onclick="vamosaver3()" class=" modal-action waves-effect waves-green btn-flat">ACEPTAR</a>
    </div>
  </form>  
</div>  

<!-- Modal Structure -->
<div id="modalempleado" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 style="text-align: center;">FORMULARIO DE EMPLEADO</h4>

    <form method="post" action="<?php echo base_url('index.php/saveempleados')?>" name="formularioempleado" id="formularioempleado">
      <div class="row">
        <div class="input-field col s12 l6">
          <i class="material-icons prefix">account_circle</i>
          <input name="nombre" id="nombre" type="text" class="validate">
          <label style="color: black;" for="icon_prefix">NOMBRE COMPLETO</label>
        </div>
        <div class="input-field col s12 l1">
          <i class="material-icons prefix">work</i>
        </div>
        <div class="input-field col s12 l5">
          <select id="cargo" name="cargo">
            <option value="" disabled selected>ESCOJA EL CARGO</option>
            <?php foreach ($cargos as $key => $value) {?>
            <option value="<?php echo $value['IdCG'] ?>"><?php echo $value['Descripcion'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 l1">
          <i class="material-icons prefix">location_city</i>
        </div>
        <div class="input-field col s12 l5">
          <select id="empresa" name="empresa">
            <option value="" disabled selected>ESCOJA LA EMPRESA</option>
            <?php foreach ($empresas as $key => $value) {?>
            <option value="<?php echo $value['IdEP'] ?>"><?php echo $value['Empresa'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="input-field col s12 l1">
          <i class="material-icons prefix">people</i>
        </div>
        <div class="input-field col s12 l5">
          <select id="gerenciaa" name="gerenciaa">
            <option value="" disabled selected>ESCOJA LA GERENCIA</option>
            <?php foreach ($gerencia as $key => $value) {?>
            <option value="<?php echo $value['IdGR'] ?>"><?php echo $value['Gerencia'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 l2">
          <input type="checkbox" id="autoriza" onchange="check(txtautoriza)" />
          <label for="autoriza" style="color: black;">AUTORIZA</label>
          <input type="hidden" id="txtautoriza" name="txtautoriza" value="0">
        </div>
        <div class="input-field col s12 l2">
          <input type="checkbox" id="revisa" onchange="check(txtrevisa)"/>
          <label for="revisa" style="color: black;">REVISA</label>
          <input type="hidden" id="txtrevisa" name="txtrevisa" value="0">
        </div>
      </div>
      <br>
      <div style="text-align: center;" class="row">
        
        SELECCIONE LAS EMPRESAS EN LAS QUE MARCA
        
      </div>

      <!-- -**************************************
      **************REGION DE LOS CHECKBOX *****-->
      <div class="row">

       <div class="input-field col s12 l2">
        <input type="checkbox" id="checkunimark" onclick="document.formularioempleado.txtunimark.disabled=!document.formularioempleado.txtunimark.disabled"/>
        <label for="checkunimark" style="color: black;">UNIMARK</label>
      </div>  
      <div class="input-field col s12 l2">
        <input style="text-align: center;" placeholder="DIGITE ID" disabled type="number" min="1" name="txtunimark" id="txtunimark"/>
      </div> 


      <div class="input-field col s12 l2">
        <input type="checkbox" id="checkinnova" onclick="document.formularioempleado.txtinnova.disabled=!document.formularioempleado.txtinnova.disabled"/>
        <label for="checkinnova" style="color: black;">INNOVA</label>
      </div>  
      <div class="input-field col s12 l2">
        <input  style="text-align: center;" placeholder="DIGITE ID"  disabled type="number" min="1" name="txtinnova" id="txtinnova"/>
      </div> 


      <div class="input-field col s12 l2">
        <input type="checkbox" id="checkpandora" onclick="document.formularioempleado.txtpandora.disabled=!document.formularioempleado.txtpandora.disabled"/>
        <label for="checkpandora" style="color: black;">PANDORA</label>
      </div>  
      <div class="input-field col s12 l2">
        <input  style="text-align: center;" placeholder="DIGITE ID" disabled type="number" min="1" name="txtpandora" id="txtpandora"/>
      </div> 


    </div>
    
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCELAR</a>
    <a onclick="guardarEmpleado()" class="modal-action waves-effect waves-green btn-flat ">ACEPTAR</a>
  </div>
</div>
</form>
<script>
  $(document).ready(function(){
    $('.modal-trigger2').leanModal();
    //$('#modalempleado').openModal();
  });
  function check(inputtext)
  {
    var inputt=document.getElementById(inputtext);
    if (inputtext.value==1)
      {inputtext.value=0;}
    else{ inputtext.value=1; }      
  }


  function guardarEmpleado()
  {
    var nombre= document.getElementById('nombre');
    var cargoid= document.getElementById('cargo');
    var cargo= $("#cargo option:selected").text();
    var gerenciaid= document.getElementById('gerenciaa');
    var empresaid= document.getElementById('empresa');
    var gerencia= $("#gerencia option:selected").text();
    var checkunimark= document.getElementById('checkunimark');
    var checkunimark= document.getElementById('checkinnova');
    var checkunimark= document.getElementById('checkpandora');
    var txtunimark= document.getElementById('txtunimark');
    var txtinnova= document.getElementById('txtinnova');
    var txtpandora= document.getElementById('txtpandora');
    //alert(cargoid.value);
    if (nombre.value=="") {
      alert("Digite el nombre del empleado"); 
      return false;
    }

    if (cargoid.value=="") {
      alert("Por favor seleccione un cargo");
      return false;
    }
    if (gerenciaid.value=="") {
      alert("Por favor seleccione una gerencia");
      return false;
    }
    if (empresaid.value=="") {
      alert("Por favor seleccione una empresa");
      return false;
    }

    if (($('#checkunimark').is(':checked')==false) && ($('#checkinnova').is(':checked')==false) && ($('#checkpandora').is(':checked')==false)) {
      alert("Selecciones al menos 1 empresa, y digite el id del biometrico");
      return false;
    }

    if (($('#checkunimark').is(':checked')==true) && (txtunimark.value=="")) {
      alert("Digite el ID del empleado correspondiente a UNIMARK");
      return false;
    }
    if (($('#checkinnova').is(':checked')==true) && (txtinnova.value=="")) {
      alert("Digite el ID del empleado correspondiente a INNOVA");
      return false;
    }
    if (($('#checkpandora').is(':checked')==true) && (txtpandora.value=="")) {
      alert("Digite el ID del empleado correspondiente a PANDORA");
      return false;
    }    
    if ((empresaid.value==1) && (txtunimark.value=="")) {alert("Usted indico que el empleado fue contratado en UNIMARK, porfavor digite su id.");return false;}
    if ((empresaid.value==2) && (txtinnova.value=="")) {alert("Usted indico que el empleado fue contratado en INNOVA, porfavor digite su id.");}
    if ((empresaid.value==3) && (txtpandora.value=="")) {alert("Usted indico que el empleado fue contratado en PANDORA, porfavor digite su id.");return false;}

    else{ 
      document.formularioempleado.txtunimark.disabled=false;
      document.formularioempleado.txtinnova.disabled=false;
      document.formularioempleado.txtpandora.disabled=false;
      document.getElementById("formularioempleado").submit(); 
    }         

  }
</script>
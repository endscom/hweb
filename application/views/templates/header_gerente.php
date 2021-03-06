<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Sistema de Gestión Humana</title>
 	  	 
	      <!--Import Google Icon Font localmente by Alder-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/fuente.css" >

     <!--Import jQuery before materialize.js-->
  
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>  

      <!--Import materialize.css-->

  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.min.css"  media="screen,projection"/>
<script src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/media/js/extensions/dataTables.colVis.min.js"></script>-->
 <!--Import librerias para datatable editable-->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>  

  
       <!--CARGO CSS-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/index_home.css'); ?>">    
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.select.min.js"></script>  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.css" >
      <script src="<?php echo base_url(); ?>assets/media/js/extensions/dataTables.tableTools.min.js"></script>
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/media/css/extensions/dataTables.tableTools.css" />

</head>
<body>
<nav>
    <div class="nav-wrapper barra col s12 l12">
    <div class="logo">
      <a href="#" class="brand-logo"><img src="<?php echo base_url(); ?>assets/img/guma12_1_0.png" class="responsive brand-logo"></a>
      <!--<img src="assets/img/guma12_1_0.png">-->
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><i class="material-icons left dropdown-button" data-activates="dropdown2">person_pin</i>
        <i class="left dropdown-button" data-activates="dropdown2" style="font-size: 18px; font-weight: bold;">(<?php echo $this->session->userdata('username'); ?>)</i></li> 

          <ul id="dropdown2" class="dropdown-content">
           <li><a href="#modal1" class="modal-trigger" style="font-size: 11px; background-color: #00658F; ; color: white;">CONTRASEÑA</a></li>
           <li><a href="#modalayuda" class="modal-trigger" style="font-size: 11px; background-color: #00658F;color: white;">AYUDA</a></li>
          </ul>

      <li><a href="<?php echo base_url()?>index.php/salir" class="out center" style="padding-right: 30px;"><i class="material-icons right">power_settings_new</i></a></li>
      </ul>
    </div>
  </nav>  

<!-- Modal Structure DE AYUDA -->
  <div id="modalayuda" class="modal">
    <div class="modal-content">
    <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header"><i class="material-icons">help</i>PROXIMAMENTE</div>
          <div class="collapsible-body"><p>Proximamente, contenido de ayuda.</p></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">help</i>PROXIMAMENTE</div>
          <div class="collapsible-body"><p>Proximamente, contenido de ayuda.</p></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">help</i>PROXIMAMENTE</div>
          <div class="collapsible-body"><p>Proximamente, contenido de ayuda.</p></div>
        </li>
  </ul>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">CERRAR</a>
    </div>
  </div>

      <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>CAMBIO DE CONTRASEÑA</h4>

    <form name="formulario12" action="<?php echo base_url('index.php/updatePass')?>" method="post">   
      <div style="border: 1px solid rgba(0,0,0,0.1);">   
            <div class="row texto">
              <div class="input-field col s9 l12 ">   
                <input placeholder="Escriba su nueva Contraseña" name="pass1" id="pass1" type="password">               
                <span class="form-help" style="color:red;"><span class="ast"></span>Contraseña para acceder al sistema (8 caracteres min).</span> 
              </div>               
            </div>      

            <div class="row texto">
              <div class="input-field col s12 ">
                <input placeholder="Vuelva a escribir la Contraseña" name="pass2" id="pass2" type="password"> 
                 <span class="form-help" style="color:red;"><span class="ast"></span>Repita la contraseña (8 caracteres min).</span>    
              </div>        
            </div>
       </div> 
           
         <p style=" text-align: center; color: black; padding-right:0%;">Una vez cambiada la contraseña se le sacara del sistema para que usted se logue con su nueva contraseña.</p>
         <p style="text-align: center; color: black; padding-right:0%;">Cualquier error de cambio de contraseña puede reportarlo a recursos humanos.</p>
        
    </div>
    <div class="modal-footer">
     <button  type="button" onclick="vamosaver22()" class="modal-action waves-effect waves-green btn-flat ">ACEPTAR</button>
     <button type="button" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCELAR</button>
    </div>
       </form>  
  </div>  
  <!--************Menu de navegacion****************
  *************************************************-->
<br><br>
 <div class="row" style="text-align: center;">
     <div class="collection">        
             <div class="col l3"> <br></div>          
                            <?php     
                   
                        echo '                         

                              <div class=" col l3 s12"><a href="'.base_url('index.php/autorizar').'" id="reportes" class="collection-item activo boton">AUTORIZAR REPORTES</a></div>

                              <div class=" col l3 s12"><a href="'.base_url('index.php/verautorizados').'" id="reportes" class="collection-item activo boton">REPORTES AUTORIZADOS</a></div>            
                        ';          
             ?>  
             </div>  
        
    </div>
</div>
<script>
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

  });
function vamosaver22(){
var texto = document.getElementById("pass1").value;
var texto2 = document.getElementById("pass2").value;
if (/^\s*$/.test(texto))
  { alert("Por favor Ingrese una contraseña");
    return false;  }
  if (/^\s*$/.test(texto2))
  {  alert("Por favor repita la contraseña");
  return false; }

  if (texto!=texto2) 
  { alert("Las contraseñas no coinciden");
        return false; }
  if (texto.length<8) 
      {alert("La contraseña debe tener al menos 8 caracteres");
        return false;}
  else{ document.formulario12.submit() 
      }
}

</script>
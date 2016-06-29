<div class="cajauser">
	<div class="row cabecera">
		<div class="col l12 center">
          <br>
          <label class="encabezado">USUARIOS</label>
      </div>
  </div>	
  <div class="row">
   <div class="col s12 l3"  style="margin-left: 80%;">
       <a  href="<?php echo base_url('index.php/nuevousuario')?>">
           <input type="button" class="btn btn-primary"  value="AGREGAR USUARIO"></a>				
       </div>
       <br><br>
   </div>
</div>
<form method="post" action="<?php echo base_url('index.php/reporXgerencia')?>" name="formulario1" class="col s12">
    <input type="hidden" id="valor" name="idGR" >
    <div class="row">
        <div class="col s12 l12">
            <table id="Tabla_Comparativos" class="striped responsive-table " cellspacing="1" cellpadding="2">
                <thead> 
                    <tr>
                        <th>Nº</th>
                        <th>USUARIO</th>                     
                        <th>ROL</th>
                        <th>FECHA DE CREACIÓN</th>
                        <th>OPCIÓN</th> 
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    if (!($usuarios)) {                                                                
                    } 
                    else 
                    {
                      foreach ($usuarios as $rep) {    
                       ?>
                       <tr>                    
                           <td><?php echo $rep['IdUser']; ?></td>
                           <td><?php echo $rep['Nombre']; ?></td>					
                           <td><?php  
                               if($rep['Rol']=="Administrador")
                                {echo "Digitador";} 
                            if($rep['Rol']=="Super Administrador")
                                {echo "Administrador";} 
                            if($rep['Rol']=="Gerente")
                                {echo "Gerente";}?>
                        </td>                     
                        <td><?php echo $rep['Fecha']; ?></td> 
                        <td class="tooltipped" data-position="top" data-delay="5" data-tooltip="PRESIONE PARA ELIMINAR AL USUARIO: <?php echo $rep['Nombre']; ?>"><a class="modal-trigger" href="#modal22" onclick="vamosaver2('<?php echo $rep['IdUser'];?>','<?php echo $rep['Nombre'];?>')"><i style="font-size: 30PX;color: #D50000;"  class="material-icons prefix">close</i></a></td>                              
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


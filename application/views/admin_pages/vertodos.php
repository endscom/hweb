 <div class="brown lighten-5 caja">


 	<div class="caja">
 		<div class="row cabecera">
 			<div class="col s12 center-align">
 				<label class="encabezado">REPORTES GENERADOS POR EL USUARIO: <?php echo $this->session->userdata('username'); ?></label>			
 			</div>
 		</div>	
 	</div>

 	<div class="row">
 		<div id="col s12 l12">
 			<table id="Tabla" name="mitabla" class=" striped responsive-table " cellspacing="1" cellpadding="2">
 				<thead> 
 					<tr>
 						<th>IDREPORTE</th>
 						<th>FECHA ELABORACION</th>                  
 						<th>PERIODO</th>   
 						<th>ELIMINAR</th>                
 					</tr>            
 				</thead>
 				<tbody>
 					<?php 
 					if (!(@$dato)) {  
 					} else
 					{ foreach ($dato-> result() as $Cls) { ?>
 					<tr>
 						<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="PRESIONE PARA EDITAR"><a href="<?php echo base_url();?>index.php/editar/<?php echo$Cls->IdRHE?>"><i style="font-size: 30PX;color: #252525;"  class="material-icons prefix">description mode_edit</i></a></td><td><?php echo $Cls->FechaE ?></td>                                     
 						<td><?php echo $Cls->RANGO ?></td>   
 						<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="PRESIONE PARA ELIMINAR EL REPORTE"><a class="modal-trigger" href="#modal" onclick="vamosaver2('<?php echo$Cls->IdRHE?>')"><i style="font-size: 30PX;color: #D50000;"  class="material-icons prefix">close</i></a></td>      
 						<?php }}?>
 					</tr> 
 				</tbody>
 			</table>
 		</div>
 	</div>
 </div>
 <!-- Modal Structure -->
 <div id="modal" class="modal">
 	<div class="modal-content">
 		<form name="formularioReporte" id="formularioReporte" action="<?php echo base_url('index.php/borrar')?>" method="post">   
 			<h5 class="center">¿ESTA SEGURO DE QUE DESEA ELIMINAR ESTE REPORTE?</h5>
 			<p class="center" style="color:red;">Una vez eliminado el reporte no se podrá recuperar.</p>
			<input id="idDelete" name="idDelete" type="hidden">
 		</div>
 		<div class="modal-footer">
 			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">CANCELAR</a>
 			<a href="#!" onclick="vamosaver3()" class=" modal-action waves-effect waves-green btn-flat">ACEPTAR</a>
 		</div>
 	</form>  
 </div>


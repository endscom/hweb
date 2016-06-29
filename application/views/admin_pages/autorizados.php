<div class="caja">
	<div class="row cabecera">
		<div class="col s12 center-align">
		<?php  if($this->session->userdata('Tipo')=="Administrador") {?>
		<label class="encabezado">REPORTES REVISADOS</label>		
		<?php } ?>	
		<?php  if($this->session->userdata('Tipo')=="Gerente") {?>
		<label class="encabezado">REPORTES AUTORIZADOS</label>		
		<?php } ?>	
		</div>
	</div>	
</div>
<div class="brown lighten-5 caja">
	<div class="row">
		<div id="col s12 l12">
			<table id="TablaAutorizar" name="mitabla" class=" striped responsive-table " cellspacing="1" cellpadding="0">
				<thead> 
					<tr>
						<th>Nº REPORTE</th> 
						<th>VER REPORTE</th>
						<th>FECHA ELABORACION</th>                  
						<th>ACCION REALIZADA</th> 						
					</tr>            
				</thead>
				<tbody>
					<?php 
					 if (!($dato)) 
					 	{  } 
					 else {
					foreach ($dato-> result() as $Cls) { ?>
					<tr>					 

						<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="NUMERO DE REPORTE"><?php echo $Cls->IdRHE ?></td>
						 <td class="tooltipped" data-position="top" data-delay="5" data-tooltip="PRESIONE PARA VISUALIZAR"><a href="<?php echo base_url();?>index.php/visualizarAutorizados/<?php echo$Cls->IdRHE?>"><i style="font-size: 30PX; color: #252525;"  class="material-icons prefix">visibility</i></a>
						<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="FECHA EN QUE SE ELABORO EL REPORTE"><?php echo $Cls->FechaE ?></td>
						<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="ACCION QUE USTED REALIZO EN EL REPORTE"><?php echo $Cls->Revisa ?></td>    						
							</tr>  
						<?php }?>                                                       
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<br>




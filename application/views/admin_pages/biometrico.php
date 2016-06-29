<div class="row archivo card">
	<div class="col s12 l12">
		<ul class="collapsible" data-collapsible="expandable">
			<li>
				<div class="collapsible-header"><i class="material-icons" style="font-size: 38px; color: green">backup</i>SUBIR ARCHIVO</div>
				<div class="collapsible-body">
					<form action="<?php echo base_url('index.php/archivo')?>" method="post" enctype="multipart/form-data" name="formarchivo" id="form1">
						<div class="row">
							<div class="col s12 l12">
								<h4>Agregar archivo biometrico</h4>
							</div>				
							<div class="col s12 l12">
								<div class="file-field input-field">
									<div class="btn">
										<span>ARCHIVO</span>
										<input name="archivoupload" id="csv" type="file">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text" style="background-color:#F5F2F0 !important" placeholder="INGRESE EL ARCHIVO CSV">
									</div>
								</div>
							</div> 
						</div>			
						<div class="row botonesbio">
							<div class="col s12 l5">
								<input type="button" class="btn btn-primary" onClick="validar(this.form, this.form.archivoupload.value)" value="Aceptar">
							</div>
							<div class="col s12 l5">
								<button type="reset" class="btn">Cancelar</button>  
							</div>
						</div>
					</form>      	
				</div>
			</li>
			<li>
				<div class="collapsible-header active"><i class="material-icons" style="font-size: 38px;">subject</i>INFORMACION DE FECHAS EN BIOMETRICO</div>
				<div class="collapsible-body">
					<table id="Tabla" class="striped responsive-table " cellspacing="1" cellpadding="2">
						<thead> 
							<tr>
								<th>EMPRESA</th>
								<th>FECHA MINIMA</th>
								<th>FECHA MAXIMA</th> 
							</tr>            
						</thead>
						<tbody>
							<?php 
							if (!($tabla)) {                                                                
							} 
							else 
							{
								foreach ($tabla as $rep) {    
									?>
									<tr>                    
										<td><?php echo $rep['Empresa']; ?></td>
										<td><?php echo $rep['min']; ?></td>    
										<td><?php echo $rep['max']; ?></td>                  
									</tr>                              
									<?php }}?>                            
								</tbody>
							</table>      	
						</div>
					</li>
				</ul>
			</div>	
		</div>
	</body>
	</html>
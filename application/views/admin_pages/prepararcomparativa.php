
<div class="caja">
	<div class="row cabecera">
		<div class="col s12 center-align">
			<label class="encabezado">REPORTE DE HE POR GERENCIA</label>			
		</div>
	</div>	
</div>
<form method="post" action="<?php echo base_url('index.php/reporXgerencia')?>" name="formulario1" class="col s12">
	
	<br>
	<div class="row">					
		<div class="col s12 l3  " >
			<label class="filtrado">FILTRADO POR GERENCIA:</label>
		</div>
		<div class="col s12 l4">
			<select id="SelectRevisa" data-placeholder="..." class="browser-default chosen-select"  name="nameR" style="width:450px;" >
				<option  value="" disabled selected></option>
				<?php foreach($gerencia as $key): ?>
				<option value="<?php echo $key['IdGR'] ?>"> <?php echo $key['Gerencia'] ?></option>
			<?php endforeach ?>	
		</select>					
	</div>
	
	<div class="col s12 l3"  style="margin-left: 25px;">
		<input type="submit" class="btn btn-primary"  value="Aceptar">					
	</div>
</div>

<input type="hidden" id="valor" name="idGR" >
<div class="row">
	<div class="col s12 l12">
		<table id="Tabla_Comparativos" class="striped responsive-table " cellspacing="1" cellpadding="2">
			<thead> 
				<tr>
					<th>Nº REPORTE</th>
					<th>FECHA</th>                     
					<th>GERENCIA</th>
					<th>VER REPORTE</th>
					<th>COMPARATIVA</th> 
				</tr>
			</thead>
			<tbody>

				<?php 
				if (!($reportes)) {                                                                
				} 
				else 
				{
					foreach ($reportes as $rep) {    
						?>
						<tr>                    
							<td><?php echo $rep['IdRHE']; ?></td>
							<td><?php echo $rep['FechaE']; ?></td>					
							<td><?php echo $rep['Gerencia']; ?></td>                     
							<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="PRESIONE PARA VER"><a href="<?php echo base_url();?>index.php/visualizar/<?php echo$rep['IdRHE'];?>"><i style="font-size: 40px;"  class="material-icons prefix">visibility</i></a></td>

							<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="VER REPORTE COMPARATIVO"><a href="<?php echo base_url();?>index.php/consolidado/<?php echo$rep['IdRHE'];?>"><i style="font-size: 40px;"  class="material-icons prefix">library_books</i></a></td>                        
						</tr>                              
						<?php }}?>   
					</tbody>
				</table>
			</div>
		</div>
	</form>

	<script type="text/javascript">

	$('#SelectRevisa').change(function() {  
		$("#valor").val(this.value);
		
	});
	$(document).ready(function() {
		$('#Tabla_Comparativos').DataTable( {
			"language": {
				"lengthMenu": "MOSTRAR _MENU_ REGISTROS",
				"zeroRecords": "NO SE ENCONTRO NADA",
				"info": "MOSTRANDO PAGINA _PAGE_ DE _PAGES_",
				"infoEmpty": "NINGUN REGISTRO DISPONIBLE",
				"paginate": {
					"first":      "PRIMERO",
					"last":       "ULTIMO",
					"next":       "SIGUIENTE",
					"previous":   "ANTERIOR"},
					"search":         "BUSCAR:",
					"infoFiltered": "(BUSCANDO EN LOS _MAX_ REGISTROS)" },
					"searching": false,
					order: [[ 0, "desc" ]]
				} );
	} );

	</script>
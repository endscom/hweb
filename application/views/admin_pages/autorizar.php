 <div class="caja">
	<div class="row cabecera">
		<div class="col s12 center-align">

		<?php if ($this->session->userdata['Tipo']=="Gerente") 
		{?>
		<label class="encabezado">REPORTES A AUTORIZAR</label>
		<?php }
		else if ($this->session->userdata['Tipo']=="Administrador") 

		{?>
		<label class="encabezado">REPORTES A REVISAR</label>
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
						<th >AUTORIZAR</th>
						<th>Nº REPORTE</th> 
						<th>VER REPORTE</th>
						<th>FECHA ELABORACION</th>                  
						<th>ESTADO A REALIZAR</th> 						
					</tr>            
				</thead>
				<tbody>
					<?php 
					 if (!($dato)) 
					 	{  } 
					 else {
					foreach ($dato-> result() as $Cls) { ?>
					<tr>						
						 <td class="tooltipped" data-position="top" data-delay="5" data-tooltip="SELECCIONE Y PRESIONE EL BOTON GUARDAR"><i style="font-size: 30PX;"  class="material-icons prefix">done_all</i></td>

						<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="NUMERO DE REPORTE"><?php echo $Cls->IdRHE ?></td>

						 <td class="tooltipped" data-position="top" data-delay="5" data-tooltip="<?php if ($this->session->userdata['Tipo']=="Gerente")
						 {echo "PRESIONE PARA VER";} else{echo "PRESIONE PARA EDITAR";} ?>"><a href="<?php echo base_url();?>index.php/visualizar/<?php echo$Cls->IdRHE?>"><i style="font-size: 30PX; color: #252525;"  class="material-icons prefix">visibility</i></a>

						<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="FECHA EN QUE SE ELABORO EL REPORTE"><?php echo $Cls->FechaE ?></td>

						<td class="tooltipped" data-position="top" data-delay="5" data-tooltip="ACCION QUE USTED PUEDE REALIZAR EN EL REPORTE"><?php echo $Cls->Revisa ?></td>    						
					</tr>  
						<?php }?>                                                       
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<br>
<div class="row">
	<form name="formularioDatos" id="formularioDatos" action="<?php echo base_url('index.php/check')?>" method="post" class="col s12 l12">
		<input type="hidden" id="idrhe" name="idrhe" value="">
		<input type="hidden" id="accion" name="estado" value="">
		<input type="button" name="btnGuardar" id="guardar" class="btn btn-primary" onclick="vamosaver2()"  value="GUARDAR">
	</form>
</div>
<script>	
	$(document).ready(function() {
		var table = $('#TablaAutorizar').DataTable({			
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
            "infoFiltered": "(BUSCANDO EN LOS _MAX_ REGISTROS)" }
             // "searching": false
    });		
		$('#TablaAutorizar tbody ').on( 'click', 'tr', function () {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
				document.getElementById("idrhe").value = "";  
				document.getElementById("accion").value = "";           
			}
			else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');

				$("#TablaAutorizar tbody tr ").each(function (index) 
				{

					if ( $(this).hasClass('selected') ) {
						var campo1, campo2, campo3, campo4, campo5;
						$(this).children("td").each(function (index2) 
						{
							switch (index2) 
							{
								case 0: campo1 = $(this).text();
								break;
								case 1: campo2 = $(this).text();
								break;
								case 2: campo3 = $(this).text();
								break;
								case 3: campo4 = $(this).text();
								break;
								case 4: campo5 = $(this).text();
								break;
							}                
						})          
						document.getElementById("idrhe").value = campo2;  
						document.getElementById("accion").value = campo5;                      
					}
				});
			}
		} ); 
		$('#btnGuardar').click( function () {
			table.row('.selected').remove().draw( false );
		} );	
	} );
</script>
<script>
	function vamosaver2()
	{
		var texto = document.getElementById("idrhe").value;
		if (/^\s*$/.test(texto))
		{
			alert("Por favor seleccione un reporte");
		}
		else  
		{			//document.formularioDatos.submit(); 
		   document.getElementById("formularioDatos").submit();				
		}
	}
</script>
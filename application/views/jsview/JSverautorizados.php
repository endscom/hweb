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
            "infoFiltered": "(BUSCANDO EN LOS _MAX_ REGISTROS)" },
              "searching": false
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
		{
		document.getElementById("formularioDatos").submit(); //document.formularioDatos.submit() 
		}
	}
</script>
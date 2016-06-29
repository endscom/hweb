
<script>
//Script for getting the dynamic values from database using jQuery and AJAX
$(document).ready(function() {
	$('#sc_get').change(function() {
		var form_data = {
			name: $('#sc_get').val()
		};
		$.ajax({
			url: "<?php echo base_url('index.php/getEmpleados');?>",
			type: 'POST',
			dataType: 'json',
			data: form_data,
			success: function(msg)
            {
                var sc='';
                $.each(msg, function(key, val) 
                {
					//POSTEAR EN EL FORO ESTA SOLUCION
					sc+='<option value="'+val.IdEM+'">'+val.Nombre+'/'+val.Descripcion+'</option>';
				});
                $("#empleado option").remove();
                $("#empleado").append(sc);				       
            }
        });  
	});

});
</script>
<script>    
   $(document).ready(function() {
    var t = $('#Tabla').DataTable({      
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
        "infoFiltered": "(BUSCANDO EN LOS _MAX_ REGISTROS)"},
        //"searching": false,
        // "dom": 'T<"clear">lfrtip'
    });
    var nFilas1 = $('#Tabla >tbody >tr').length;
    var nColumnas1 = $("#Tabla th").length;

    var txtc=nFilas1*nColumnas1;
    txtc++;    

    var nFilas;
    var matriz=0;

    $('#agregar').on( 'click', function () {
        var nColumnas = $("#Tabla th").length;
          matriz=nFilas*nColumnas;                 
        var columnas = nColumnas-4;
        var idEmp = document.getElementById('empleado');
        var RHE = document.getElementById('idreporte');



        var texto = $("#empleado option:selected").html();
        var idemp = idEmp.value || '';  
         var idRreporte = RHE.value || '';  
        var bandera=0;
        if (!idemp || !idemp.trim().length) {
            alert('Debe seleccionar un Empleado');
            return;  
        }
/**********aqui valido si el empleado ya esta agregado en la tabla, 
*********comparando su ID en la tabla con el ID del select
******************************************************************/
    else 
    {
      $("#Tabla td").each(function (index) 
      {           
        var textCelda=$(this).text();           
        if (textCelda==idemp) 
        {                
            alert("Este empleado ya esta agregado");
            bandera=1;
            return false;
        }          
    })            
          if (bandera == 0) 
          {        
           var res = texto.split("/");
           var nombre = res[0] || '';
           var cargo = res[1] || '';

           var arreglo = [];
          arreglo[0]  ='<input  readonly type="hidden" value="'+nombre+'" id="1" name="'+txtc+'">'+nombre+'';
           txtc++;
           arreglo[1]  ='<input  readonly type="hidden" value="'+cargo+'" id="2" name="'+txtc+'">'+cargo+'';
           txtc++;    
           arreglo[2]  ='<input  readonly type="hidden" style="display:none;" value="'+idRreporte+'" id="0" name="'+txtc+'">'+idRreporte+'';
           txtc++;
            arreglo[3]  ='<input  readonly type="hidden" value="'+idemp+'" id="0" name="'+txtc+'">'+idemp+'';
           txtc++;
                  
           for (var i = 4; i <(columnas+4); i++) {
            arreglo[i]='<input type="number" step="any" min="0" max="8" id="'+i+'" name="'+txtc+'" value="0">';
            txtc++;
            }  
        document.getElementById('idc').value = columnas;          
        t.row.add(arreglo).draw(false);
        nFilas = $('#Tabla >tbody >tr').length;
         matriz=nFilas*nColumnas;        
        idEmp.value = '';           
        }
    }
    } );  
} );
</script>

<script>
/*Metodo del datatable que habilita la seleccion multiple en la tabla
******************************************************/
$(document).ready(function() {
    var table = $('#Tabla').DataTable();

    $('#Tabla tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } ); 

 /*Recorro toda la tabla y busco elementos que tengan la clase .selected y los borro
 ****************************************************************************/
 $('#eliminar').click( function () {
  $("#Tabla .selected").each(function (index) 
  {   
    table.row('.selected').remove().draw( false );
})
} );
} );
</script>   
 <script>

   $(document).ready(function() {
     var nColumnas = $("#Tabla th").length;
     var columnas = nColumnas-4;
     document.getElementById('idc').value = columnas;  
   } );  
 </script>
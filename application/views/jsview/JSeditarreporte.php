
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
         sc+='<option value="'+val.IdUnico+'">'+val.Nombre+'/'+val.Descripcion+'</option>';
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
   // "dom": 'T<"clear">lfrtip',
    //"tableTools": {
      /*CODIGO PARA PONER TEXTO PERSONAL A LOS BOTONES  
             "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy to clipboard"
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Save to CSV"
                },
                {
                    "sExtends": "xls",
                    "oSelectorOpts": {
                        page: 'current'
                    }
                }
                ],*/
               // "sSwfPath": "http://localhost:8448/hweb/assets/data/swf/copy_csv_xls_pdf.swf"},
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
        "searching": false,
        buttons: [
        {
          extend: 'pdf',
          text: 'Save current page',
          exportOptions: {
            modifier: {
              page: 'current'
            }
          }
        }
        ] 


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
    var columnas = nColumnas-5;
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
   for (var i = 4; i <(columnas+4); i++) 
   {
   
   if (i==columnas+3) {
   arreglo[i]='<input style="text-align: center;" class="suma" type="number" step="any" min="0" max="8" id="'+i+'" name="'+txtc+'" value="0">';
   txtc++;  
   }

   else{
   arreglo[i]='<input style="text-align: center; " class="suma" onKeyUp="doAdd(this)" type="number" step="any" min="0" max="8" id="'+i+'" name="'+txtc+'" value="0">';
   txtc++;
    }
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

 function vamosaver2(id)
 {
  document.getElementById("idDelete").value=id;
}

function vamosaver3(id)
{
  var id=document.getElementById("idDelete").value;
  if (id=="") {
    alert("Error al seleccionar el reporte, vuelva a intentarlo");
  }
  else{
    document.getElementById("formularioReporte").submit(); 
  }

}
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
    table.row('.selected').remove().draw(false);
  })
} );
} );
</script>   
<script type="text/javascript">
    // function getColumnCount()
    // {
    //     return document.getElementById('Tabla').getElementsByTagName('tr')[0].getElementsByTagName('td').length;         
    // }
 
    // function getRowCount()
    // {
    //     return document.getElementById('Tabla').rows.length;
    // }
 
    // function doAdd(ths)
    // {
    //     //alert(ths.parentNode.cellIndex);
    //     //alert(getColumnCount());
    //     var lastCol = getColumnCount()-1;
    //     var lastRow = getRowCount()-1;

    //     //for Column Sum
    //     var table = document.getElementById("Tabla");
    //   var row = table.rows[ths.parentNode.parentNode.rowIndex];
    //    var colSum=0;
    //    for(var i=0;i<lastCol;i++)
    //         colSum=eval(colSum) + eval(row.cells[i].childNodes[0].value);
    //     row.cells[lastCol].innerHTML = colSum;
 
    //     //for Row Sum
    //     var cIndex = ths.parentNode.cellIndex;
    //     //alert(cIndex);
    //     var rowSum = 0;
    //     for(var i=0;i<lastRow;i++)
    //         rowSum = eval(rowSum) + parseInt(table.rows[i].cells[cIndex].childNodes[0].value);
    //     table.rows[lastRow].cells[cIndex].innerHTML = rowSum;
 
 
    //     //for the final Value in the last row last column
    //     var finSum = 0;
    //     for(var i=0;i<lastRow;i++)
    //         finSum = eval(finSum) + parseInt(table.rows[i].cells[lastCol].innerHTML);
    //     for(var i=0;i<lastCol;i++)
    //         finSum=eval(finSum) + eval(table.rows[lastRow].cells[i].innerHTML);
    //     table.rows[lastRow].cells[lastCol].innerHTML = finSum;
    // }
</script>
/**
 * Created by Keyling on 24/11/2015.
 */

var posicion = 0;
var imagenes = new Array();

$(document).ready(function(){
    /******************  CARGA CONTENIDO PRINCIPAL EN HOME **************************/
    // $('#ContenidoCentral').load('home/principal');
    /*************************END IMG HOME****************************/

    /*************************CARGA PARA EL CARRUSEL**********************/
     var numeroImatges = 7;
     if(numeroImatges<=6){
          $('.derecha_flecha').css('display','none');
          $('.izquierda_flecha').css('display','none');
     }
     $('.izquierda_flecha').on('click',function(){
          if(posicion>0){
               posicion = posicion-1;
          }else{
               posicion = numeroImatges-3;
          }
      //   alert($('#product_'+posicion).position());
         $(".carrusel").animate({"left": -($('#product_'+posicion).position().left)}, 600);
          return false;
     });
     $('.izquierda_flecha').hover(function(){
          $(this).css('opacity','1');
     },function(){
          $(this).css('opacity','0.5');
     });
     $('.derecha_flecha').hover(function(){
          $(this).css('opacity','1');
     },function(){
          $(this).css('opacity','0.5');
     });
     $('.derecha_flecha').on('click',function(){
          if(numeroImatges>posicion+3){
               posicion = posicion+1;
          }else{
               posicion = 0;
          }
       //  alert($('#product_'+posicion).position());
          $(".carrusel").animate({"left": -($('#product_'+posicion).position().left)}, 600);
          return false;
     });
    /***********************END CARGA DE CARRUSEL*************************/

    /******* ACTIVAR LINK DE NAVEGACIÓN MENU IZQUIERDA ********/
            var pathname = window.location.pathname;
        var url= pathname.split('index.php/');
        $('.collection-item').each(function(){
            var id= this.id;
            if(url[1]== id){
                console.log(id);
                $(this).addClass('active');
            }
        });
     /******* END CODIGO LINK DE NAVEGACIÓN MENU IZQUIERDA ********/

     $('#lastPagos').DataTable( {
         "dom": 'T<"clear">lfrtip',
         "tableTools": {
             "sSwfPath": "http://165.98.75.219:8081/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },
         ajax:{
             "url":"menu/ultimospagos",
             "type": "post",
             "data":{
                 "D1":$("#date1UI").val(),
                 "D2":$("#date2UI").val(),
             },

         },
         footerCallback: function(row, data, start, end, display){
            var api = this.api(), data;                     
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\C$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                    };                  
            TotalLinea = api.column( 3, { page: 'current'} ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );                         
            $('#SaldoPendiente').html(TotalLinea);
                    },
         "language": {
             "emptyTable": "No hay datos disponibles en la tabla",
             "lengthMenu": '_MENU_ ',
             "search": '<i class="tiny material-icons">search</i>',
             "loadingRecords": "",
             "paginate": {
                 "first":      "Primera",
                 "last":       "Última ",
                 "next":       "Siguiente",
                 "previous":   "Anterior"
             }
         },
         "lengthMenu": [[10,-1], [10,"Todo"]],
         "ordering": false,
         "info":     true,
         "filter": true,
         "pagingType": "full_numbers",
         columns: [
             { "data": "DOCUMENTO" },
             { "data": "APLICACION" },
             { "data": "FECHA_DOCUMENTO" },
             { "data": "MONTO" }
         ]
     } );
    
      /************** PAGINA CUENTA EN PANTALLA PRINCIPAL***************/
     $('#TableCuenta').DataTable( {
        "dom": 'T<"clear">lfrtip',

        "tableTools": {
             "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
        },
         "ordering": false,
         "lengthMenu": [[10,-1], [10,"Todo"]],
         "pagingType": "full_numbers",
         "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
            "search": '<i class="tiny material-icons">search</i>',
            "loadingRecords": "",

            "paginate": {
                "first":      "Primera",
                "last":       "Última ",
                "next":       "Siguiente",
                "previous":   "Anterior"
             }
         },
    });
     $("#TableCuenta_length,#TableCuenta_info").hide();
    /************END PAGINA CUENTA EN PANTALLA PRINCIPAL**************/


});

/************PETICION DE ESTADOS DE FACTURAS**************/
$("#idClickSearch").click(function(){
    var DT1 = $("#date1UI").val();
    var DT2 = $("#date2UI").val();

    if (($.trim(DT1)=="") || ($.trim(DT2)=="")) {
        alert("ERROR");
    } else{
        Objtable = $('#TableCuenta').DataTable();
        Objtable.destroy();
        Objtable.clear();
        Objtable.draw();

        var table = $('#TableCuenta').DataTable( {
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
            },
            ajax:{
                "url":"menu/estadocuenta",
                "type": "post",
                "data":{
                    "D1":$("#date1UI").val(),
                    "D2":$("#date2UI").val(),
                }
            },
            "language": {
                "emptyTable": "No hay datos disponibles en la tabla",
                "lengthMenu": '_MENU_ ',
                "search": '<i class="tiny material-icons">search</i>',
                "loadingRecords": "",
                "paginate": {
                    "first":      "Primera",
                    "last":       "Última ",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                }
            },
            "lengthMenu": [[10,-1], [10,"Todo"]],
            "ordering": false,
            "info":     false,
            "filter": true,
            "pagingType": "full_numbers",
            columns: [
                { "data": "itmFact" },
                { "data": "itmDate" },
                { "data": "itmPts" },
                { "data": "ItmStus" }
            ]
        } );
    };
});


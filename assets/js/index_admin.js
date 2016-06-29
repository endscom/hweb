/**
 * Created by Keyling on 28/11/2015.
 */
/*************** SOLO NUMERO EN EL CAMPO DE PUNTOS CATALOGO ************************/
$("#idtxtPts").numeric();
$("#cant").numeric();
/*************** END SOLO NUMERO EN EL CAMPO DE PUNTOS CATALOGO ************************/

$(document).ready(function(){
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
    /**************MENU DETALLE MASTER FACTURA*****************/

    /**************END MENU DETALLE MASTER FACTURA*****************/
    if(url[1]=="detalles/"+url[2]){
        alert(url[1]);
        $('#detalleFactura').show();
    }
    /************** BEGIN TABLA MASTER DE CLIENTE ***************/
    $('#TableCls').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ordering": false,
        "info":     false,

        "pagingType": "full_numbers",
        "lengthMenu": [[10,-1], [10,"Todo"]] ,
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
    });
    /************ENDTABLA MASTER DE CLIENTE**************/

    /************** BEGIN TABLA CANJE DE PUNTOS ***************/
    $('#TableCanje').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ordering": false,
        "info":     false,

        "pagingType": "full_numbers",
        "lengthMenu": [[10,-1], [10,"Todo"]] ,
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
    });
    /************ENDTABLA CANJE DE PUNTOS*************/

    /************** BEGIN TABLA CANJE DE PUNTOS ***************/
        $('#tableCanjePremio').DataTable({
            /* "dom": 'T<"clear">lfrtip',
             "tableTools": {
             "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
             },*/
            "ordering": false,
            "info":     false,
            "filter": false,
            "pagingType": "full_numbers",
            "lengthMenu": [6] ,
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

        });
   /************CARGAR LINEA DE TABLA ARTICULOS*********************/

                 var codigoProd;
                $('#articulosSelect').change(function(e){
                    codigoProd = this.value;
                    console.log(codigoProd);
                    var frp=$('#frp').val();
                    verificarfrp(frp);
                    $('#justlabel').find('label').addClass('active');
                    $('#cant').val('1');
                });
                //  var counter = 1;
             var pts = 0;
            $('#addRow').on('click',function () {
                $('#clienteSelect').html('');
                if($('#frp').val() && $('#cant').val()) {
                    var t = $('#tableCanjePremio').DataTable();
                    var cod = codigoProd;
                    var cant = $('#cant').val();
                    $.getJSON('cargarArt/' + cod, function (data) {
                        console.log(data);
                        $.each(data, function (i, item) {
                            t.row.add([
                                item.articulo,
                                item.codigo,
                                item.puntos,
                                cant,
                                item.puntos * cant,
                                "<a href='#!' id='" + item.codigo + "' class='opc red accent-4'>CANCELAR</a>"
                            ]).draw(false);
                        });
                        pts = pts + (data[0].puntos * cant);
                        $('#lineaPuntos').find('#requeridos').html(pts);
                        $('#lineaPuntos').find('#faltantes').html(pts);
                        cargarClientPts(pts);
                    });
                }
                else{
                    alert('Completar campos vacíos');
                }
               // var selects= $('#clienteSelect').load('cargarCls/'+pts);
            });
            // Automatically add a first row of data
         //   $('#addRow').click();
    /************ END CARGAR LINEA DE TABLA ARTICULOS*********************/

    /************ Eliminar Línea tabla artculos*********************/
    $('#tableCanjePremio').on('click', 'a', function(){
        var id= this.id;
        var t= $('#tableCanjePremio').DataTable();
        var col= t.row( $(this).parents('tr') ).data();
         pts = pts- col[4];
        $('#lineaPuntos').find('#requeridos').html(pts);
        $('#lineaPuntos').find('#faltantes').html(pts);
        t.row( $(this).parents('tr') ).remove().draw( false );
        cargarClientPts(pts);
        //  var parent= $(this).parent();
       // var fila= parent.parent();
      //  t.row(fila).remove().draw( false );

    });
    /************ END Eliminar Línea tabla artculos*********************/

    /************ENDTABLA CANJE DE PUNTOS*************/

    $('#tableBoucher').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ordering": false,
        "info":     false,
        "filter": false,
        "pagingType": "full_numbers",
        "lengthMenu": [6] ,
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
    });
    /************ENDTABLA CANJE DE PUNTOS*************/

    /************CARGAR LINEA DE TABLA BOUCHERS*********************/
                var cliente;
                $('#clienteSelect').on('change',function(){
                    cliente = this.value;
                    cargarBouchers(cliente);
                });
            var ptsAplic=0;
            var faltanReal=0;
           /* $('#tableBoucher').on('click','.green', function(){
                var id= this.id;
                var t= $('#tableBoucher').DataTable();
                var faltan= $('#faltantes').html();
                var aplicados= $('#aplicados').html();
                var requeridos= $('#requeridos').html();
                var disp = $('#disponibles').html();
                var col= t.row(  $(this).parents('tr') ).data();
                var pntos = col['Puntos'];
                if($(this).parents('tr').is('.selected')) {
                    return;
                }else{
                    if(faltan <= 0){
                        alert("Puntos Completados Para esta Cambio...");
                    }
                    else{
                        ptsAplic = ptsAplic + parseInt(pntos);
                        if( parseInt(pntos) > parseInt(requeridos) && parseInt(aplicados) == 0){
                            $('td', $(this).parents('tr')).eq(3).text(requeridos);
                        }
                        if( parseInt(pntos) > parseInt(requeridos) && parseInt(aplicados) > 0){
                            $('td', $(this).parents('tr')).eq(3).text(faltan);
                        }
                        if( parseInt(pntos) < parseInt(requeridos)){

                            if(parseInt(aplicados) == 0){
                                $('td', $(this).parents('tr')).eq(3).text(pntos);
                            }
                            if(parseInt(aplicados) > 0){
                                falt = parseInt(requeridos) - parseInt(aplicados);
                                if(falt >= pntos ){
                                    $('td', $(this).parents('tr')).eq(3).text(pntos);
                                }
                                else {
                                    //var test= falt - pntos;
                                    $('td', $(this).parents('tr')).eq(3).text(falt);
                                }
                            }
                        }


                        $('#lineaPuntos').find('#aplicados').html(ptsAplic);
                        $('#lineaPuntos').find('#faltantes').html(pts - ptsAplic);
                        faltanReal= $('#aplicados').html();
                        $(this).parents('tr').addClass('selected');
                       // console.log(faltan);
                        var apl = $('td', $(this).parents('tr')).eq(3).text();
                        $('#disponibles').html(parseInt(disp) - parseInt(apl));
                    }
                }
                ordenarPts($('#faltantes').html(), $('#aplicados').html(), $('#requeridos').html());
            });*/

         /*   $('#tableBoucher').on('click','.red', function(){
                var id= this.id;
                var t= $('#tableBoucher').DataTable();
                var col= t.row(  $(this).parents('tr') ).data();
                var pntos = col['Puntos'];
                var apl = $('td', $(this).parents('tr')).eq(3).text();
                var disp = $('#disponibles').html();
                //alert('Disponible: '+disp +','+ 'Aplicado: '+ apl);
                $('#disponibles').html(parseInt(disp) + parseInt(apl));
                $('td', $(this).parents('tr')).eq(3).text(0);
                ptsAplic = ptsAplic - parseInt(pntos);
                $('#lineaPuntos').find('#aplicados').html(ptsAplic);
                $('#lineaPuntos').find('#faltantes').html(parseInt($('#lineaPuntos').find('#faltantes').html()) + parseInt(apl));
                $(this).parents('tr').removeClass('selected');
            });*/

            $('#tableBoucher tbody').on('click', 'tr', function(e){
                if($(this).is('.selected')) {
                    var id= this.id;
                    var t= $('#tableBoucher').DataTable();
                    var col= t.row($(this)).data();
                    var pntos = $('td', $(this)).eq(2).text();
                    var apl = $('td', $(this)).eq(3).text();
                    var disp = $('#disponibles').html();
                    $('#disponibles').html(parseInt(disp) + parseInt(apl));
                    $('td', $(this)).eq(3).text(0);
                    ptsAplic = ptsAplic - parseInt(pntos);
                    $('#lineaPuntos').find('#aplicados').html(ptsAplic);
                    $('#lineaPuntos').find('#faltantes').html(parseInt($('#lineaPuntos').find('#faltantes').html()) + parseInt(apl));
                    $(this).removeClass('selected');
                }
                else{
                    var id= this.id;
                    var t= $('#tableBoucher').DataTable();
                    var faltan= $('#faltantes').html();
                    var aplicados= $('#aplicados').html();
                    var requeridos= $('#requeridos').html();
                    var disp = $('#disponibles').html();
                    var col= t.row($(this)).data();
                    var pntos = $('td', $(this)).eq(2).text();
                    if($(this).is('.selected')) {
                        return;
                    }else{
                        if(faltan <= 0){
                            alert("Puntos Completados Para esta Cambio...");
                        }
                        else{
                            ptsAplic = ptsAplic + parseInt(pntos);
                            if( parseInt(pntos) > parseInt(requeridos) && parseInt(aplicados) == 0){
                                $('td', $(this)).eq(3).text(requeridos);
                            }
                            if( parseInt(pntos) > parseInt(requeridos) && parseInt(aplicados) > 0){
                                $('td', $(this)).eq(3).text(faltan);
                            }
                            if( parseInt(pntos) < parseInt(requeridos)){

                                if(parseInt(aplicados) == 0){
                                    $('td', $(this)).eq(3).text(pntos);
                                }
                                if(parseInt(aplicados) > 0){
                                    falt = parseInt(requeridos) - parseInt(aplicados);
                                    if(falt >= pntos ){
                                        $('td', $(this)).eq(3).text(pntos);
                                    }
                                    else {
                                        $('td', $(this)).eq(3).text(falt);
                                    }
                                }
                            }


                            $('#lineaPuntos').find('#aplicados').html(ptsAplic);
                            $('#lineaPuntos').find('#faltantes').html(pts - ptsAplic);
                            faltanReal= $('#aplicados').html();
                            $(this).addClass('selected');
                            // console.log(faltan);
                            var apl = $('td', $(this)).eq(3).text();
                            $('#disponibles').html(parseInt(disp) - parseInt(apl));
                        }
                    }
                    ordenarPts($('#faltantes').html(), $('#aplicados').html(), $('#requeridos').html());
                }
            });

            /*********GUARDAR FRP CABECERA**********/
            $('#savefrp').click(function(){
                var frp=$('#frp').val();
                var cli=cliente;
                var ruta= $('#vendedor').val();
                if(frp == "" ||  cli == "" ||  codigoProd == ""){
                    alert('DEBE COMPLETAR LOS DATOS...');
                }
                else{
                    $.post('savefrp/'+frp+'/'+cli+'/'+ruta, function(data){
                      //  console.log('Frp: '+data);
                        if(data == 1){
                            $('#tableCanjePremio tbody tr').each(function(e){
                                var codPremio= $(this).find("td").eq(1).html();
                                var cant = $(this).find("td").eq(3).html();
                                var pts= $(this).find("td").eq(2).html();
                              //  console.log(codPremio+','+frp+','+cant+','+pts);
                                $.post('lineprod/'+codPremio+'/'+frp+'/'+cant+'/'+pts, function(data){
                                   // console.log('Productos: '+data);
                                    $('#tableBoucher tr').each(function(e){
                                        if($(this).is('.selected')) {
                                            var bouch = $(this).find("td").eq(1).html();
                                            var cantApl = $(this).find("td").eq(3).html();
                                            $.post('linebouchC/' + frp + '/' + bouch + '/' + cantApl, function(data){
                                             //   console.log('d: '+ data);
                                                self.location='canje';
                                              //  self.location='http://165.98.75.219:8448/UMA/index.php/canje';
                                            });
                                        }
                                    });
                                });
                            });

                        }
                    });
                }
            });

            $('#calcelfrp').click(function(){
                self.location='canje';
              //location.reload();
            });
    /********* END GUARDAR FRP CABECERA**********/
   /*********** END CARGAR LINEA DE TABLA BOUCHERS*********************/


    /************ TABLA MASTER DE USUARIOS*************/
    $('#tableUsuarios').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ordering": false,
        "info":     false,
        "pagingType": "full_numbers",
        "lengthMenu":  [[10,-1], [10,"Todo"]] ,
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
    });

    $('#btnUsuerCancel').click(function(){
        $('.validate').val('');
        $('#privilegio').prop('selected',0);
        $('#activo:checked').removeAttr('checked');
    });
    /************END TABLA MASTER DE USUARIOS************/

    /*******************INICIALIZACIÓN SELECT CLIENTES*****************************/
    $('select').material_select();
    /*******************END INICIALIZACIÓN SELECT CLIENTES*****************************/

    /************ TABLA FACTURAS*************/

    $('#tableFact').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ordering": false,
        "info":     false,
        "filter": false,
        "pagingType": "full_numbers",
        "lengthMenu":  [[10,-1], [10,"Todo"]] ,
        "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
            "lengthMenu": '_MENU_ ',
           // "search": '<i class=" material-icons">search</i>',
            "loadingRecords": "",
            "paginate": {
                "first":      "Primera",
                "last":       "Última ",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
    });
    /************END TABLA FACTURAS***********/

    /************ TABLA DETALLE DE FACTURA*************/

    $('#factDetalle').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ordering": false,
        "info":     false,
        "filter": false,
        "pagingType": "full_numbers",
        "lengthMenu":  [[10,-1], [10,"Todo"]] ,
        "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
            "lengthMenu": '_MENU_ ',
            // "search": '<i class=" material-icons">search</i>',
            "loadingRecords": "",
            "paginate": {
                "first":      "Primera",
                "last":       "Última ",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
    });
    /************END TABLA DETALLE DE FACTURA***********/
    /***************CATALOGO************************/
    var myReader = new FileReader();
    $("#fileUpload").on('change', function () {

     if (typeof (FileReader) != "undefined") {

     var image_holder = $("#image-holder");
     image_holder.empty();

     var reader = new FileReader();
     reader.onload = function (e) {
     $("<img />", {
     "src": e.target.result,
     "width": 320,
     "height": 320,
     "id": "image"
     }).appendTo(image_holder);

     };

     image_holder.show();
     reader.readAsDataURL($(this)[0].files[0]);
     } else {
     alert("This browser does not support FileReader.");
     }
     });


    $('#tableCatalogo').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ordering": false,
        "info":     false,
        "pagingType": "full_numbers",
        "lengthMenu":  [[1,-1], [1,"Todo"]] ,
        "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
            "lengthMenu": '_MENU_ ',
            "search": '<i class=" material-icons">search</i>',
            "loadingRecords": "",
            "paginate": {
                "first":      "Primera",
                "last":       "Última ",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
    });
    /*************** END CATALOGO************************/

    /************ TABLA REPORTES*************/

    $('#tableReporteClientes').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ordering": false,
        "info":     false,
        "pagingType": "full_numbers",
        "lengthMenu":  [[10,-1], [10,"Todo"]] ,
        "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
            "lengthMenu": '_MENU_ ',
            "search": '<i class=" material-icons">search</i>',
            "loadingRecords": "",
            "paginate": {
                "first":      "Primera",
                "last":       "Última ",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
    });
    $('#clientesReport').removeClass('green').addClass('active');
    var menuLink = "clientesReport";
    $('#menuReport').find('a').click(function(){
       console.log(this.id);
        var link = this.id;
        menuLink= link;
            $('#menuReport').find('a').removeClass('active').addClass('green');
            $(this).removeClass('green').addClass('active');
        switch (link){
            case 'clientesReport':
                hideShow('reporteClientes');
                break;
            case 'pxcReport':
                hideShow('reportePxC');
                $('#tableReportePxC').DataTable();
                break;
            case 'frpReport':
                hideShow('reporteFrp');
                $('#tableReporteFrp').DataTable();
                break;
            case 'mdpReport':
                hideShow('reporteMdP');
                $('#tableReporteMdP').DataTable();
                break;
        }
    });
    $('#genReport').click(function(){
        $("#CmptxtD1,#CmptxtD2,#LoadDiv").hide("slow");
        var f1= $('#date1').val();
        var f2= $('#date2').val();
        if (f1=="") {
            $("#CmptxtD1").show("slow");
        } else{
            if (f2=="") {
                $("#CmptxtD2").show("slow");
            } else{
                $("#LoadDiv").show("slow");
                generarReporte(menuLink, f1, f2);
            };
        };

    });
    /************END TABLA REPORTES***********/

});

$(document).ready(function(){$('.modal-trigger').leanModal();});

function AnularFull(id){
    $("#IdNFac").html(id);
}
function AnularParcial(id){
    $("#IdNFac").html(id);
}
function AnularTotal(id){
    $("#factTotal").html(id);
    $('#modal2').openModal();
}
$("#BtnAnularFact").click(function(){
    var URL = window.location.href;
    var whay = $("#IdWhy").val();
    var NFact = $("#IdNFac").html();
    var vals = { why: whay, NFact: NFact};
    $.ajax({
        url: "../AnularFactura",
        type: "post",
        data: vals,
        async:true,
        success: function(json){

            self.location='../'+URL.substr(URL.lastIndexOf('facturas'));;
        }
    });
});
$("#BtnAnularParcial").click(function(){
    var URL = window.location.href;
    var whay = $("#IdWhy").val();
    var id = $("#IdNFac").html();
    var vals = { why: whay, id: id};
    $.ajax({
        url: "../AnularParcial",
        type: "post",
        data: vals,
        async:true,
        success: function(json){
            self.location='../'+URL.substr(URL.lastIndexOf('detalle'));;
        }
    });
});
$('#BtnAnularTotal').click(function(){
    var id=  $("#factTotal").html();
    var razon = $('#totalWhy').val();
    $.post('anular_total/'+razon+'/'+id, function(data){
        if(data == true){
            self.location='master';
        }
    });
    $('#modal2').closeModal();
});
function  verificarfrp(frp){

    $.getJSON('verificarfrp/'+frp, function(data){
        if(data == 1){
            alert("FRP INVÁLIDO...");
            $('#frp').val('');
            $('#articulosSelect').prop('selectedIndex', -1);
            $("#articulosSelect").trigger("chosen:updated");
        }
    });
}
function cargarClientPts(pts){
    $.getJSON('cargarCls/'+pts, function(data){
        $('#clienteSelect').append("<option value='' disabled selected></option>");
        if(data == 0){
            $('#clienteSelect').append("<option value='' disabled selected>No hay Clientes</option>");
            $("#clienteSelect").trigger("chosen:updated");
        }
        else{
            $.each(data, function(i, item) {
                $('#clienteSelect').append("<option value="+item.itmCls+"> " +item.itmCls +'  |  '+ item.itmClsName + "</option>");
                $("#clienteSelect").trigger("chosen:updated");
            });
        }
    });
}
function cargarBouchers(cliente){

    var table = $('#tableBoucher').DataTable();
    table.destroy();
    table.clear();
    table.draw();
    $('#disponibles').html('');
    $('#tableBoucher').DataTable( {
        /* "dom": 'T<"clear">lfrtip',

         "tableTools": {
         "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
         },*/
        "ajax": "cargarBouch/"+cliente,
        "deferRender": true,
        "ordering": false,
        "info":     false,
        "filter": false,
        "pagingType": "full_numbers",
        "lengthMenu": [6] ,
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
        "columns": [
            { "data": "Fecha" },
            { "data": "Factura" },
            { "data": "Puntos" },
            { "data": "PtsAplicados" }
        ]
    });
    $.getJSON("totalPtsCls/"+cliente, function(data){
        $('#disponibles').html(data[0]['Total']);
    });
}
function savefrp(){
    var frp=$('#frp').val();
    var cliente=1;
    var ruta= 'F2';
    $.getJSON('savefrp/'+frp+'/'+cliente+'/'+ruta, function(data){
        console.log(data);
    });
}
function ordenarPts(falt, apl, req){
    if(falt < 0){
        $('#lineaPuntos').find('#aplicados').html(req);
        $('#lineaPuntos').find('#faltantes').html(0);
        var disponibles= apl - req;
        console.log('Disponibles: '+disponibles);
    }
}
function  generarReporte(menuLink, fecha1, fecha2){


    switch (menuLink) {
        case 'clientesReport':
            $("#T1D1").html(fecha1);
            $("#T1D2").html(fecha2);
            Objtable = $('#tableReporteClientes').DataTable();
            Objtable.destroy();
            Objtable.clear();
            Objtable.draw();
            $('#tableReporteClientes').DataTable({
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
                },
                ajax: "clientesReport/"+ fecha1 +'/'+ fecha2,
                "ordering": false,
                "info": false,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, -1], [10, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                },

                footerCallback: function(){
                    $("#LoadDiv").hide("slow");
                },
                columns: [
                    { "data": "Num" },
                    { "data": "NumCliente" },
                    { "data": "Cliente" },
                    { "data": "Puntos" },
                    { "data": "Vendedor" }
                ]
            });

            break;
        case 'pxcReport':
            $("#T2D1").html(fecha1);
            $("#T2D2").html(fecha2);
            Objtable = $('#tableReportePxC').DataTable();
            Objtable.destroy();
            Objtable.clear();
            Objtable.draw();

            $('#tableReportePxC').DataTable({
                "dom": 'T<"clear">lfrtip',

                "tableTools": {
                    "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
                },
                ajax: "pxcReport/"+fecha1+'/'+fecha2,
                "ordering": false,
                "info": false,
                "pagingType": "full_numbers",
                "lengthMenu": [[5, -1], [5, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                },
                footerCallback: function(){
                    $("#LoadDiv").hide("slow");
                },
                columns: [
                    { "data": "itmCls" },
                    { "data": "itmClsName" },
                    { "data": "Ene" },
                    { "data": "Feb" },
                    { "data": "Mar" },
                    { "data": "Abr" },
                    { "data": "May" },
                    { "data": "Jun" },
                    { "data": "Jul" },
                    { "data": "Ago" },
                    { "data": "Sep" },
                    { "data": "Oct" },
                    { "data": "Nov" },
                    { "data": "Dic" },
                    { "data": "itmSlpCode" },
                    { "data": "ItmSlpName" }
                ]
            });

            break;
        case 'frpReport':
            $("#T3D1").html(fecha1);
            $("#T3D2").html(fecha2);
            Objtable = $('#tableReporteFrp').DataTable();
            Objtable.destroy();
            Objtable.clear();
            Objtable.draw();

            $('#tableReporteFrp').DataTable({
                "dom": 'T<"clear">lfrtip',

                "tableTools": {
                    "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
                },
                ajax: "frpReport/"+f1+'/'+f2,
                "ordering": false,
                "info": false,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, -1], [10, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next": "Siguiente",
                        "previous":   "Anterior"
                    }
                },
                footerCallback: function(){
                    $("#LoadDiv").hide("slow");
                },
                columns: [
                    { "data": "Num" },
                    { "data": "NumCliente" },
                    { "data": "Cliente" },
                    { "data": "Puntos" },
                    { "data": "Vendedor" }
                ]
            });

            break;
        case 'mdpReport':
            $("#T4D1").html(fecha1);
            $("#T4D2").html(fecha2);
            Objtable = $('#tableReporteMdP').DataTable();
            Objtable.destroy();
            Objtable.clear();
            Objtable.draw();
            $('#tableReporteMdP').DataTable({
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "http://165.98.75.219:8448/UMA/assets/data/swf/copy_csv_xls_pdf.swf"
                },
                ajax: "mdpReport/"+ fecha1 +'/'+ fecha2,
                "ordering": false,
                "info": false,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, -1], [10, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                footerCallback: function(){
                    $("#LoadDiv").hide("slow");
                },
                columns: [
                    { "data": "Articulo" },
                    { "data": "Descripcion" },
                    { "data": "Cant" },
                    { "data": "Puntos" }
                ]
            });
            break;
    }
}
function hideShow(id){
    $('#reporteMdP').hide();
    $('#reporteFrp').hide();
    $('#reporteClientes').hide();
    $('#reportePxC').hide();
    $('#'+id).show();
    console.log( $('#'+id));
}
function Imprimir(){
    window.print();
}
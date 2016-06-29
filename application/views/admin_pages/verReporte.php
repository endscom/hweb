<?php
$contador=count($rangoDate); 
$contador=$contador+3;


?>
<div class="row cabecera">
<label class="encabezado">VISUALIZACION DE REPORTE</label>
   
</div>

<div class="row">
    <div class="label col s6 l12">
      <label for="">PERIODO REPORTADO:</label>

      <label for="last_name"><?php echo $idMax[0]['Finicio']." al ".$idMax[0]['Ffinal'];  ?></label>
  </div>
</div>

<div class="row">
  <div class="label col s6 l4">
  <label for="">FECHA DE ELABORACION:</label>        
  <label for="last_name"><?php echo $idMax[0]['FechaE'];  ?></label>
  <!-- Modal Trigger -->
  </div>
  <div class="row s12 l16">
  <button data-target="modal1" class="btn modal-trigger">EDITAR FECHA</button>
  </div>
</div>
<br>

<div class="row">
    <div class="col s12 l12">
        <table id="Tabla" class="striped responsive-table " cellspacing="1" cellpadding="2">
            <thead> 


                <tr>
                    <th>ID</th>
                    <th>NOMRE</th>
                    <th>CARGO</th>                       
                    <?php for($i = 0; $i < count($rangoDate); ++$i) {?>
                    <th><?php echo $rangoDate[$i]?></th>
                    <?php }?>


                </tr>            
            </thead>
            <tbody>
                <?php foreach($idMax as $key): ?>

                   <tr>                    
                     <td>VACIO</td>
                     <td>VACIO</td>
                     <td>VACIO</td>                                                          
                     <?php for($i = 0; $i < count($rangoDate); ++$i) {?>                                   
                     <td>VACIO</td>                                                                  
                     <?php }?>                               
                 </tr>                              
             <?php endforeach ?>
         </tbody>
     </table>
 </div>
</div>


<!-- Modal Structure -->
<div id="modal1" class="modal col s12 l5">
    <div class="modal-content">
     <form action="<?php echo base_url('index.php/updateReporte')?>" method="post" enctype="multipart/form-data" name="formarchivo" id="form1">
     <?php foreach($idMax as $key): ?>
        <input type="hidden" name="idh" value="<?php echo $key['IdRHE'];?>">
         <?php endforeach ?>
      <h4>EDICION DE FECHA</h4>
      <p>POR FAVOR SELECCIONE LA FECHA DE INICIO:</p>
      <input name="fecha" id="fecha" type="date" class="datepicker">
      <p>POR FAVOR SELECCIONE LA FECHA FINAL:</p>
      <input name="fecha1" id="fecha1" type="date" class="datepicker">

  </div>
  <div class="modal-footer">
    <input type="button" class="waves-effect waves-green btn-flat" onClick="validar()" value="Aceptar">              
</form>
</div>
</div>
<script>
    function validar()
    {
        if(document.getElementById('fecha').value=='')
        {
            alert('ELIJA UNA FECHA DE INICIO')
        }  
        else if(document.getElementById('fecha1').value=='')   
        {
          alert('ELIJA UNA FECHA FINAL')
      } 
      else
      {
        document.formarchivo.submit();      
    }       
}
</script>
<script>
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});
</script>
<script>
   $('.datepicker').pickadate({    
     monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
     weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado' ],
     weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
        // Today and clear
        today: 'HOY',
        clear: 'Limpar',
        close: 'CERRAR',
        monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
        selectMonths: true,// Creates a dropdown to control month

        // The format to show on the `input` element
        format: 'yyyy-mm-dd'

    });
</script>
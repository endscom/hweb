
<div class="container">

	<div class="row formulario">


		<div class="row">
			<div class="col s12 center-align">GENERAR REPORTE DE HORAS EXTRAS</div>
		</div>
	<!--***********************Region del formulario central****
	*************************************************************-->

	<div class="row label">
		<form method="post" action="<?php echo base_url('index.php/ingresar')?>" name="formulario1" id="formulario1" class="col s12">
			<div class="row label">
				<div class="col s12">        
					<label>PERIODO:</label>
					<div class="row">
						<div class="col s6 l12 left-align">INICIO:</div>
						      <input name="periodo1" id="fecha1" type="text" class="datepicker">	
					</div>					
					<div class="row">
						<div class="col s6 l12 left-align">FINAL:</div>
						      <input name="periodo2" id="fecha2" type="text" class="datepicker">
					</div>
				</div>
			</div>
			<div class="row label">
				<div class="col s12">         
					<label>FECHA:</label> 
					<input type="text" name="fecha" id="fechaactual" readonly value=<?php echo date("Y-m-d");?>>   
				</div> 
			</div>			
			<div class="row label">
				<div class="col s12">         
					<label>EMPLEADO QUE REVISA:</label>
					<br>  
					<div class="input-field col m6 "  style="margin-top: 25px;">
					<select id="SelectRevisa" class="zelect"  name="nameR" style="width:450px;" >
					<option  value="" disabled selected></option>
					<?php foreach($articulos as $key): ?>
					<option value="<?php echo $key['IdUnico'] ?>"> <?php echo $key['Nombre'] ?>  |  <?php echo $key['Gerencia'] ?></option>
					<?php endforeach ?>
					</select>
					</div>
				</div>
			</div>

			<div class="row label">
				<div class="col s12">        
					<label>EMPLEADO QUE AUTORIZA:</label>
					<br>  
					<div class="input-field col m6"  style="margin-top: 22px;">
						<select id="SelectAutoriza" data-placeholder="..." class="zearch-container"  name="nameA" style="width:450px;" >
							<option value="" disabled selected></option>
							<?php foreach($gerentes as $key): ?>
								<option value="<?php echo $key['IdUnico'] ?>"> <?php echo $key['Nombre'] ?>  |  <?php echo $key['Descripcion'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row label">
				<div class="col s12 l6">     
					<input type="button" class="btn btn-primary" onClick="vamosaver2()" value="Aceptar">
				</div>		
				<div class="col s12 l6">  
					<button type="reset" class="btn">Cancelar</button>  
				</div>
			</div>	
		</form>
	</div>
</div>
</div>

<footer>
	<script type="text/javascript">
		function vamosaver2()
		{
				var texto = document.getElementById("SelectRevisa").value;
				var texto2=document.getElementById("SelectAutoriza").value;
				var fechaI= $('#fecha1').datepicker().val().toString();
				var fechaF= $('#fecha2').datepicker().val().toString();
				var fecha1= fechaI.toString();				
				var dia1= fecha1.substr(8,2);
				var mes1= fecha1.substr(5,2);
				var anyo1=fecha1.substr(0,4);
				var fecha2= fechaF.toString();
				var dia2= fecha2.substr(8,2);
				var mes2= fecha2.substr(5,2);
				var anyo2= fecha2.substr(0,4);	
							var nuevafecha1= new Date(anyo1+"-"+mes1+"-"+dia1);
				var nuevafecha2= new Date(anyo2+"-"+mes2+"-"+dia2);

				var Dif= nuevafecha2.getTime() - nuevafecha1.getTime();
				var dias= Math.floor(Dif/(1000*24*60*60));
						
			 if(fechaI=="")
				{

				 alert("Fecha inicial vacia");
				 return false;
				}

			if(fechaF=="")
			{
				 alert("Fecha final vacia");
				 return false;
			}
			
			if (fechaI>fechaF)
			{
				alert ("La fecha inicial debe ser menor a la final");    
				return false;  
			}
			if(dias>21)
			{
				alert("Solo puede ingresar un rango maximo de 21 dias en el reporte");
				return false;
			}
			if (/^\s*$/.test(texto))
			{
				alert("Seleccione la persona que revisa");
				texto.focus();return false;
			}
			if (/^\s*$/.test(texto2))
			{
				alert("Seleccione la persona que autoriza");
			    return false;
			}			
			else  
			{		
			document.getElementById("formulario1").submit();				
			}
		}

</script>
	<!--PLUGINS PARA EL DATEPICKER RANGE-->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepick/jquery.plugin.js"></script>  
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>  
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepick/jquery.datepick.js"></script>  
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/zelect/zelect.js"></script>  

<!--CARGO CSS-->  
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/datepick/jquery.datepick.css'); ?>"> 
	<script type="text/javascript">		
	$('.datepicker').pickadate({ 
    	 selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year
        format: 'yyyy-mm-dd',// Formats
        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        showMonthsShort: undefined,
        showWeekdaysFull: undefined,
        today: 'Hoy',
        clear: 'Borrar',
        close: 'Cerrar'  
  		});
	</script>	
</footer>
<style>
	.container{
		width: 100%;
	}
</style>
<script>
function sel(c){

	formu=document.forms['formulario1'];
	caracteres=c.length;
	if(caracteres!=0)
	{
	for (x=0;x<formu['nameA'].options.length;x++){
	if(formu['nameA'].options[x].value.slice(0,caracteres)==c){
	formu['nameA'].selectedIndex=x;
//	formu['nameA'].style.visibility="visible";
	break;
	}else{
	//formu['nameA'].style.visibility="hidden";
	}
	}
	}else{
	//formu['nameA'].style.visibility="hidden";

	}
}
</script>
</body>
</html>
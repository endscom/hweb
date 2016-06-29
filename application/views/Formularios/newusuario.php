
<div class="container">

	<div class="row formularioUser">

	<!--***********************Region del formulario central****
	*************************************************************-->
	<div class="row label">
		<form name="formularioUSER" id="formularioUSER" method="post" action="<?php echo base_url('index.php/saveusuario')?>" class="col s12">
 			<div class="row">                  
                        <div class="col s12 l7 tituloC">
                            <b>AGREGAR USUARIO</b><br>
                        </div>
                        <div class="col l5 tituloC" style=" text-align: center;">
                            <a href="<?php echo base_url();?>index.php/verusuarios" class="waves-effect waves-light btn" style=" color: #FFFFFF; border-radius: 5px;">REGRESAR</a>
                        </div>
                </div>
			<div class="row label">
				<div class="col s12 l6">         
					<label>USUARIO:</label> 
					<input type="text" id="usuario"  name="usuario"  class="validate">  
					<span class="form-help"><span class="ast">*</span> Usuario que se identificará al accesar al sistema.</span> 
				</div> 
				<div class="col s12 l6">         
					<label>ID:</label> 
					<input type="number" min="0"  id="id"  name="id"  class="validate">  
					<span class="form-help"><span class="ast">*</span> ID que se identificará en el sistema (ID del biometrico).</span> 
				</div> 
			</div>		
			<div class="row label">
				
				<div class="col s6">   
				 <label>EMPRESA:</label>   
				<select id="empresa" name="empresa" class="validate">
                                        <option value="" disabled selected></option>
                                        <option value="1">UNIMARK</option>
                                        <option value="2">INNOVA</option>
                                        <option value="3">PANDORA</option>
                                    </select>  
                   <span class="form-help"><span class="ast">*</span>Seleccione la empresa del empleado (segun contrato).</span>
  
				</div>

				<div class="col s6">         
					<label>CONTRASEÑA:</label> 
					<input type="password" id="pass" name="pass"  class="validate">  
					<span class="form-help"><span class="ast">*</span> Contraseña para acceder al sistema (8 caracteres min).</span> 
				</div> 
			</div>
			      <div class="row">   
			      <div class="col l12">
			                  <label>ROL:</label> 
			                </div>
			                <div class="col l12">
                                    <select id="privilegio" name="privilegio" class="validate">
                                        <option value="" disabled selected></option>
                                        <option value="0">Administrador</option>
                                        <option value="1">Gerente</option>
                                        <option value="2">Digitador</option>
                                    </select>
                                <span class="form-help"><span class="ast">*</span>Seleccione el privelegio del usuario.</span>
                            </div>	
			</div>
			<div class="row label">		
				<div class="col s12 l6 center">     
					<input type="button" class="btn btn-primary" onClick="vamosaver4()" value="Aceptar">
				</div>		
				<div class="col s12 l6 center">  
					<button type="reset" class="btn">Cancelar</button>  
				</div>
			</div>	

		</form>
	</div>
</div>
</div>

<style>
	.container{
		width: 100%;
	}
</style>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>HUMANET</title>

	<!--**********Haciendo que el navegador reconozca que el sitio esta optimizado para moviles************-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximun-scale=1.0, user-scalable=no" />
	<meta charset="UTF-8">
</head>
<body>
	<div class="fondo">
	<div class="row logologin">		
	      <a href="#" class="brand-logo"><img src="<?php echo base_url(); ?>assets/img/humanet.png" class="responsive brand-logo"></a>
	 </div>
		<div class="container">
			<div class="card login">
				<br>
				<div class="row">
					<form action="<?php echo base_url('index.php/entrar')?>" method="post">				
						<div class="row texto">
							<div class="input-field col s10 l10 ">		
								<input placeholder="Escriba su Usuario" name="usuario" id="usuario" type="text" class="validate">
							</div>         			 
						</div>			

						<div class="row texto">
							<div class="input-field col s10 ">
								<input placeholder="Escriba su Contraseña" name="pass" id="contraseña" type="password" class="validate">    
							</div>     		
						</div>

						<div class="row boton">
							<div class="col s12 l12 ">
								<button class="btn waves-effect waves-light " type="submit" name="action">ACEPTAR<i class="material-icons right"></i>  </button>
							</div>   
						</div>
					</form>   
				</div>
				<br>
			</div>
		</div>
	</div>
</body>

<!--**********importando materialize css**************-->
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>/assets/css/materialize.min.css" media="screen,projection" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css'); ?>">    
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
</html>
<script type="text/javascript">
function vamosaver2(id,id2)
{
	document.getElementById("idDelete").value=id;
	var texto="Usuario a eliminar: "
 	document.getElementById("name").value=texto.concat(id2);
}
function vamosaver3(id)
{
	var id=document.getElementById("idDelete").value;
	if (id=="") {
	  alert("Error al eliminar al usuario, vuelva a intentarlo");
	}
	else{
	  document.getElementById("formulariouser").submit(); 
	}

}
		function vamosaver4()
		{

			//alert("ekisde entro al footer");
				var texto = document.getElementById("usuario").value;
				var texto2=document.getElementById("pass").value;				
				var texto3=document.getElementById("privilegio").value;	
				var texto4=document.getElementById("id").value;		
				var texto5=document.getElementById("empresa").value;	

	

			if (/^\s*$/.test(texto))
			{

				alert("Ingrese un usuario");
				texto.focus();
				return false;
			}
			if (/^\s*$/.test(texto4))
			{

				alert("Ingrese un ID, este debe coincidir con el biometrico");
				texto4.focus();
				return false;
			}
			if (/^\s*$/.test(texto5))
			{
				alert("Ingrese una Empresa");
				return false;
			}
			if (/^\s*$/.test(texto2))
			{
				alert("Ingrese una contraseña");
				return false;
			}
			if (/^\s*$/.test(texto3))
			{
				alert("Ingrese un Rol");
				return false;
			}
			if (texto2.length<8) 
			{
				alert("La contraseña debe tener al menos 8 caracteres");
				return false;
			}
			else  
			{
				//document.formulario1.submit(); 
				document.getElementById("formularioUSER").submit();				

			}
		}

</script>	
<script type="text/javascript">
$(document).ready(function() {
    $('#Tabla_Comparativos').DataTable( {
    	    } );
		} );

</script>
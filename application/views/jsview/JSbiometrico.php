<script>
 $('#Tabla').DataTable( {
   "searching":false,
   "paging":   false,
  // "ordering": false,
   "info":     false        
          } );

	function validar(formulario, archivo)
	{
  extensiones_permitidas = new Array(".csv"); 
   mierror = ""; 
   if (!archivo) { 
      //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario 
      	mierror = "No ha seleccionado ningún archivo CSV"; 
   }else{ 
      //recupero la extensión de este nombre de archivo 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
      //alert (extension); 
      //compruebo si la extensión está entre las permitidas 
      permitida = false; 
      for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      } 
      if (!permitida) { 
         mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
      	}else{ 
         	//submiteo!          
		   document.getElementById("form1").submit();				
         return 1; 
      	} 
   } 
   //si estoy aqui es que no se ha podido submitir 
   alert (mierror); 
   return 0;	
	}
</script>
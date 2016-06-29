<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*

*´¨) 
¸.•´¸.•*´¨) ¸.•*¨) 
(¸.•´ (¸.•` ¤ Alder Hernandez 2016

*/
class Bio extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
			$user = $this->session->userdata('logged');

		   if (!isset($user)) { 
		       redirect(base_url().'index.php','refresh');
		   } 
	}

	public function biometrico()
	{
		$data['tabla']=$this->bio_model->get_fechas();
		$this->load->view('templates/header');			
		$this->load->view('admin_pages/biometrico',$data);
		$this->load->view('jsview/JSbiometrico');
	}

	public function sumaRestaHoras($horasalida, $incremento)
	{		
		$dif=date("H.i", strtotime("00:00:00") + strtotime($horasalida) - strtotime($incremento) );
		return $dif;

	} 

	public function succes()
	{
		$this->load->view('templates/header');			
		$this->load->view('admin_pages/exito');	
	}
	public function error($error)
	{
		$titulo="Error al subir el biométrico, Ocurrio el siguiente error: ";
		$arrayName = array('error' => $error,'titulo'=>$titulo);
		$data['error']=$arrayName;
		$this->load->view('templates/header');			
		$this->load->view('admin_pages/error',$data);	
	}

	public function archivo()
	{		
		error_reporting(0);		
		if ($_FILES['archivoupload']['size'] < 20)
		{
			$error="El archivo es demasiado pequeño como para contener informacion completa";
			$this->error($error);
			return false;
		} 
		if ($_FILES['archivoupload']['size'] > 20) 
		{
			/**********************OBTENGO EL csv*******************************/
				$file = $_FILES['archivoupload']['tmp_name'];
				$handle = fopen($file,"r");
				if ($_FILES['archivo']['error'] == UPLOAD_ERR_NO_FILE) {
					$error="No se encontró ningún archivo";
					$this->error($error);
					return false;
				}
				do {
					if ($data[0])
						{
				/**obtengo todos los campos*/
				$IdEM=addslashes($data[0]);
				$User=utf8_encode(addslashes($data[1]));
				$Format= explode(" ", addslashes($data[7])); 
				$IdEmpresa;
				$Empresa=addslashes($data[10]);			
				
				switch ($Empresa) {
							case 'INNOVA':
								$IdEmpresa=2;
								break;
							case 'UNIMARK':
								$IdEmpresa=1;
								break;
							default:
								$IdEmpresa=3;
								break;
				}

				$fecha=date("Y-m-d", strtotime($Format[0]));
				$fecha = preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$1-$2-$3",$fecha);

				$data['unico']=$this->bio_model->Idunico($IdEM,$IdEmpresa);	
				$hora=date("H:i:s",strtotime($data[7]));
				$IdEM=$data['unico'][0]['IdUnico'];
				//echo "idempresa: ".$IdEmpresa." Empresa: ".$Empresa." IDEMPLEADO: ".$IdEM." Nombre: ".$User." Fecha: ".$fecha." Hora: ".$hora;
				//echo "<br>";
				$this->bio_model->insertTemp($IdEmpresa,$Empresa,$IdEM,$User,$fecha,$hora);
				}
			} while ($data = fgetcsv($handle,10000,",","'"));
		}

			/*obtengo los datos temporales*/
		$data['HE']=$this->bio_model->TraerTemp();
			//print_r($data['HE']);
		//	echo "------------------------------";
				for ($i=0; $i <count($data['HE']) ; $i++) 
				{ 
					$maximo=0;
					$minimo=0;
					$bandera=0;
					$maximoT=0;
					$minimoT=0;	
					//echo $data['HE'][$i]['IdEmpresa']." ".$data['HE'][$i]['IdEM']." ".$data['HE'][$i]['Fecha'];
					//echo "<br>";
				$data['empleado']=$this->bio_model->ObtenerHora($data['HE'][$i]['IdEmpresa'],$data['HE'][$i]['IdEM'],$data['HE'][$i]['Fecha']);		

				//print_r($data['empleado']);
				//echo "------------------------------";
				
				/****Recorro todos los biometricos y extraigo la hora de entrada minima y hora de salida maxima del empleado****/
				/************************PINCHE CODIGO MAS MONGOLO*********************************/
			    /*****************************CODIGO NECESITA OPTIMIZACION**************************/
			foreach ($data['empleado'] as $key => $value) {
					//echo "HORA DE ENTRADA: ".$value[0]['HoraE']." HORA DE SALIDA: ".$value[0]['HoraS']." ";echo "<br>";
		
					/*Valido, si no se encuentran datos no calculo nada*/
				if ($value[0]['HoraE']=="" and $value[0]['HoraS']=="") {/*echo "no trajo";echo "<br>";*/}	
					/*Valido si se encuentran datos y calculo*/			
				else			
					{
						if($bandera==0){
							if ($value[0]['HoraE']>$value[0]['HoraS']) {
								$maximo=$value[0]['HoraE'];
								if($value[0]['HoraS']!="00:00:00")
								{
									$minimo=$value[0]['HoraS'];
								}

							}

							if($value[0]['HoraE']<$value[0]['HoraS']){
								$minimo=$value[0]['HoraE'];
								if($value[0]['HoraS']!="00:00:00")
									{$maximo=$value[0]['HoraS'];}
								}
								$bandera=1;
							}	


						if ($bandera==1){
							if ($value[0]['HoraE']>$value[0]['HoraS']) {

								if($value[0]['HoraE']>$maximo)
								{$minimoT=$maximo;  $maximo=$value[0]['HoraE'];}
								if ($value[0]['HoraE']<$maximo and $minimo==0) {
									$minimoT=$value[0]['HoraE'];
								}
								if($minimo==0)
								{
									if ($value[0]['HoraS']=="00:00:00") 
										{$minimo=$minimoT;}
									else
										{
											if($value[0]['HoraS']<$minimoT)
										{$minimo=$value[0]['HoraS'];}
										else{$minimo=$minimoT;}
									}
								}
								if ($minimo==0 and $value[0]['HoraS']!="00:00:00") {
									if($minimoT<$value[0]['HoraS'])
										{$minimo=$minimoT;}
									else{$minimo=$value[0]['HoraS'];}
								}
								if ($minimo!=0 and $value[0]['HoraS']!="00:00:00") {
									if($value[0]['HoraS']<$minimo)
										{$minimo=$value[0]['HoraS'];}
								}
								if ($minimo!=0) {
									if ($value[0]['HoraE']<$minimo) {
										$minimo=$value[0]['HoraE'];
									}
								}

							}
							if ($value[0]['HoraE']<$value[0]['HoraS']) {
								if($value[0]['HoraS']>$maximo)
									{$minimoT=$maximo; $maximo=$value[0]['HoraS'];}
								if($minimo==0 and $value[0]['HoraS']<$maximo)
								{$minimo=$value[0]['HoraS'];}
								if ($minimo==0 and $value[0]['HoraE']!="00:00:00") {
									if($minimoT<$value[0]['HoraE'])
										{$minimo=$minimoT;}
									else{$minimo=$value[0]['HoraE'];}
								}
								if ($minimo!=0) {
									if($value[0]['HoraE']<$minimo)
										{$minimo=$value[0]['HoraE'];}
								}
							}
						}
					}
				}


					//echo "El maximo es: ".$maximo." y el minimo es ".$minimo; echo "<br>";echo "<br>";
					//	echo "-------------------------------------------------------"; echo "<br>";

						$bandera=0;		
						$minimoT2=0;
						$maximoT2=0;

						if(($data['HE'][$i]['HoraE']!="") and ($data['HE'][$i]['HoraE']>=$maximo))
							{$minimoT2=$maximo; $maximo=$data['HE'][$i]['HoraE'];}
						if ($minimo==0 and $minimoT2!=0) 
							{
								$minimo=$minimoT2;
							}

						if (($data['HE'][$i]['HoraE']!="") and ($data['HE'][$i]['HoraE']<=$minimo))
							{$minimo=$data['HE'][$i]['HoraE'];}

						if(($data['HE'][$i]['HoraS']!="") and ($data['HE'][$i]['HoraS']>=$maximo))
							{$maximo=$data['HE'][$i]['HoraS'];}
						if (($data['HE'][$i]['HoraS']!="") and ($data['HE'][$i]['HoraS']<=$minimo))
							{$minimo=$data['HE'][$i]['HoraS'];}

						if(($data['HE'][$i]['HoraE']!="") and ($minimo==0) and ($data['HE'][$i]['HoraE']>=$minimo))
							{$minimo=$data['HE'][$i]['HoraE'];}

						if ($minimo==$maximo) 
							{$maximo="00:00:00";}
				//}					
						/*********Obtengo el dia de la semana, si es dimingo o sabado la hora de salida cambia*************/
						$dia= date("l", strtotime($data['HE'][$i]['Fecha']));
						if (($dia=="Saturday") or ($dia=="Sunday")) 
							{$horaExtra='12:30:00';$HoraSOficial ='12:00:00';}
						else{$horaExtra='17:30:00';$HoraSOficial ='17:00:00';}
						/**************************************************************************************************/
						$formato=$data['HE'][$i]['Fecha'];

						//$fecha=date("Y-m-d", strtotime($data['HE'][$i]['Fecha']));
						//$formato = preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$1-$3-$2",$fecha);



						$HoraEoficial='08:00:00';
						$HoraInsertar='00:00:00';	           
						$HoraInsertar2='00.00';

						
								if ($minimo==0)
						{			
							if ($data['HE'][$i]['HoraS']=="")
							{
								$x="";
										//echo "primer if primer if";
										//echo "<br>";

								//echo $data['HE'][$i]['IdEM'];
								//echo "<br>";
							$this->bio_model->Insert($data['HE'][$i]['IdEmpresa'],$data['HE'][$i]['Empresa'],$data['HE'][$i]['IdEM'],$data['HE'][$i]['User'],
								$formato,$maximo,$x, $HoraInsertar2);	  
							}
							else
							{
										//echo "primer if segundo if";
										//echo "<br>";
								//echo $data['HE'][$i]['IdEM'];
								//echo "<br>";
							$this->bio_model->Insert($data['HE'][$i]['IdEmpresa'],$data['HE'][$i]['Empresa'],$data['HE'][$i]['IdEM'],$data['HE'][$i]['User'],
								$formato,$maximo,$minimo, $HoraInsertar2);	  
							}
						}
						if($minimo!=0)
						{     
							if($minimo<$HoraEoficial)
							{
								$HoraInsertar2= $this->sumaRestaHoras($HoraEoficial, $minimo);	         
							}
							if ($maximo>$horaExtra) 	
							{       	
								$HoraInsertar= $this->sumaRestaHoras($maximo, $HoraSOficial);					
							}
							else
							{
								$HoraInsertar='00.00';
							}
							$HoraInsertar=$HoraInsertar+$HoraInsertar2;
							if ($data['HE'][$i]['HoraS']=="")
							{
								$x="";
								if ($maximo==$minimo)							
								{	
								//	echo "segundo if primer if";echo "<br>";
								//echo $data['HE'][$i]['IdEM'];
								//echo "<br>";
									$HoraInsertar="00.00";
							$this->bio_model->Insert($data['HE'][$i]['IdEmpresa'],$data['HE'][$i]['Empresa'],$data['HE'][$i]['IdEM'],$data['HE'][$i]['User'],
								$formato,$data['HE'][$i]['HoraE'],$x,$HoraInsertar);	
								}

								else {
								//echo $data['HE'][$i]['IdEM'];
								//echo "<br>";
						$this->bio_model->Insert($data['HE'][$i]['IdEmpresa'],$data['HE'][$i]['Empresa'],$data['HE'][$i]['IdEM'],$data['HE'][$i]['User'],
							$formato,$data['HE'][$i]['HoraE'],$x, $HoraInsertar);	
								}
						/*echo "skisde";
						echo "<br>";
						echo "<br>";*/
					}

					else if($data['HE'][$i]['HoraS']!="")
					{
							//echo "segundo if ultimo if";
							//echo "<br>";
							//echo $data['HE'][$i]['IdEM'];
							//echo "<br>";
					$this->bio_model->Insert($data['HE'][$i]['IdEmpresa'],$data['HE'][$i]['Empresa'],$data['HE'][$i]['IdEM'],$data['HE'][$i]['User'],
						$formato,$data['HE'][$i]['HoraE'],$data['HE'][$i]['HoraS'], $HoraInsertar); 
					}

				}

			}
$this->succes();
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horasextras extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('he_model');
		$user = $this->session->userdata('logged');

		   if (!isset($user)) { 
		       redirect(base_url().'index.php','refresh');
		   } 
	}
	public function index()
	{

		if($this->session->userdata['Tipo']=="Super Administrador")
		{	
		$data['articulos']= $this->he_model->articulos();
		$data['gerentes']= $this->he_model->gerentes();
		$this->load->view('templates/header');						
		$this->load->view('admin_pages/horasextras', $data);
		}
		if($this->session->userdata['Tipo']=="Administrador")
		{

		$data['articulos']= $this->he_model->articulos();
		$data['gerentes']= $this->he_model->gerentes();
		$this->load->view('templates/header_home');						
		$this->load->view('admin_pages/horasextras', $data);
		}
	}

	public function inicio()
	{

		$this->load->view('templates/header');						
		$this->load->view('admin_pages/master');
	}

	public function vertodos()
	{

			$data['dato']=$this->he_model->traerreportes();
			$this->load->view('templates/header_home');
			$this->load->view('admin_pages/vertodos',$data);
			$this->load->view('templates/footer_admin');	
	}

	public function autorizar()
	{

		  if($this->session->userdata('Tipo')=="Administrador")
  			{
			$data['dato']=$this->he_model->reportesnoautorizados();
			$this->load->view('templates/header_home');
			$this->load->view('admin_pages/autorizar',$data);
		}
		 if($this->session->userdata('Tipo')=="Gerente")
  			{

			$data['dato']=$this->he_model->reportesnoautorizados();
			$this->load->view('templates/header_gerente');
			$this->load->view('admin_pages/autorizar',$data);
		}

	}
	public function eliminar()
	{
		$id=$_POST['idDelete'];
		//echo $id;
		$this->he_model->eliminarReport($id);
		redirect(base_url().'index.php/vertodos','refresh');	

	}
	public function verautorizados()
	{
 			if($this->session->userdata('Tipo')=="Administrador")
  			{
			$data['dato']=$this->he_model->reportesautorizados();
			$this->load->view('templates/header_home');
			$this->load->view('admin_pages/autorizados',$data);
			$this->load->view('jsview/JSverautorizados');
		}

		if($this->session->userdata('Tipo')=="Gerente")
  			{
			$data['dato']=$this->he_model->reportesautorizados();
			$this->load->view('templates/header_gerente');
			$this->load->view('admin_pages/autorizados',$data);
			$this->load->view('jsview/JSverautorizados');
		}
	}

	public function checkreporte()
	{	
		
		$id=$_POST['idrhe'];
		$accion=$_POST['estado'];
		$this->he_model->checkreporte($id,$accion);
	}

	public function editarreporte($id)
	{
		$data['datos'] = $this->he_model->VerDetalleparametro($id);
		$fechainicio=$data['datos'][0]['Finicio'];
		$fechafinal=$data['datos'][0]['Ffinal'];
		$idMax=$data['datos'][0]['IdRHE'];

		$data['empleados']=$this->he_model->empleados($id); 	

		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		$fechas['rangoDateES'] = $this->he_model->generarDatesES($fechainicio,$fechafinal);	
		$data['gerencia']= $this->he_model->gerencia();	

		$data['detalle']=$this->he_model->traerdetalle2($id,$fechainicio,$fechafinal); 	

		$data2['xd'] = $this->he_model->obtenernumero($id);		     
		$data2['xd2'] = $idMax=$data['datos'][0]['IdRHE'];
			
			
		$data['idMax1']=$this->he_model->obtenerdetalle($id);




		if($this->session->userdata['Tipo']=="Super Administrador")
		{	
		$this->load->view('templates/header');						
		$this->load->view('admin_pages/editarreporte',array_merge($data,$fechas,$data2));
		$this->load->view('templates/footer_admin');	
		}
		if($this->session->userdata['Tipo']=="Administrador")
		{	
		$this->load->view('templates/header_home');						
		$this->load->view('admin_pages/editarreporte',array_merge($data,$fechas,$data2));
		$this->load->view('jsview/JSeditarreporte');	
		}
	}
	public function verdetalle()
	{
		$data['idMax'] = $this->he_model->VerDetalle();		
		$fechainicio=$data['idMax'][0]['Finicio'];
		$fechafinal=$data['idMax'][0]['Ffinal'];

		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		//print_r($fechas);
		$this->load->view('templates/header_home');						
		$this->load->view('admin_pages/verReporte',array_merge($data, $fechas));
	}

	public function verReporte($id)
	{

		$data['datos'] = $this->he_model->VerDetalleparametro($id);
		$fechainicio=$data['datos'][0]['Finicio'];
		$fechafinal=$data['datos'][0]['Ffinal'];
		//$idMax=$data['datos'][0]['IdRHE'];

		$data['empleados']=$this->he_model->empleados($id);

		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		$fechas['rangoDateES'] = $this->he_model->generarDatesES($fechainicio,$fechafinal);	
		$data['gerencia']= $this->he_model->gerencia();
		$data2['detalle'] = $this->he_model->traerdetalle2($id,$fechainicio,$fechafinal);
		//$data2['detalle'] = $this->he_model->traerdetalle($id);
		$data2['xd'] = $this->he_model->obtenernumero($id);

		$data2['xd2'] = $idMax=$data['datos'][0]['IdRHE'];
		//$numero=$data['xd'][0]['Numero'];

		//print_r($data['datos']);	
if($this->session->userdata['Tipo']=="Super Administrador")
		{			
		$this->load->view('templates/header');						
		$this->load->view('admin_pages/visualizarreporte',array_merge($data,$fechas,$data2));
		$this->load->view('templates/footer_admin');
		}
if($this->session->userdata['Tipo']=="Administrador")
		{

		$this->load->view('templates/header_home');						
		$this->load->view('admin_pages/visualizarreporte',array_merge($data,$fechas,$data2));
		$this->load->view('jsview/JSvisualizarreporte');

	//	$this->load->view('templates/footer_admin');
	}	
	if($this->session->userdata['Tipo']=="Gerente")
		{

		$this->load->view('templates/header_gerente');						
		$this->load->view('admin_pages/visualizarreporte',array_merge($data,$fechas,$data2));
		$this->load->view('jsview/JSvisualizarreporte');

	//	$this->load->view('templates/footer_admin');
	}	
	}


	public function verReporteAutorizado($id)
	{

		$data['datos'] = $this->he_model->VerDetalleparametro($id);
		$fechainicio=$data['datos'][0]['Finicio'];
		$fechafinal=$data['datos'][0]['Ffinal'];
		//$idMax=$data['datos'][0]['IdRHE'];

		$data['empleados']=$this->he_model->empleados($id);

		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		$fechas['rangoDateES'] = $this->he_model->generarDatesES($fechainicio,$fechafinal);	
		$data['gerencia']= $this->he_model->gerencia();
		$data2['detalle'] = $this->he_model->traerdetalle2($id,$fechainicio,$fechafinal);
		$data2['xd'] = $this->he_model->obtenernumero($id);
		$data2['xd2'] = $idMax=$data['datos'][0]['IdRHE'];
		
	if($this->session->userdata['Tipo']=="Super Administrador")
		{	
		$this->load->view('templates/header');						
		$this->load->view('admin_pages/visualizarAutorizados',array_merge($data,$fechas,$data2));
		$this->load->view('templates/footer_admin');
		}
	if($this->session->userdata['Tipo']=="Administrador")
		{
		$this->load->view('templates/header_home');						
		$this->load->view('admin_pages/visualizarAutorizados',array_merge($data,$fechas,$data2));
		$this->load->view('jsview/JSvisualizarreporte');

	}	

	if($this->session->userdata['Tipo']=="Gerente")
		{	
		$this->load->view('templates/header_gerente');						
		$this->load->view('admin_pages/visualizarAutorizados',array_merge($data,$fechas,$data2));
		$this->load->view('templates/footer_admin');
		}
	}

	public function get_subcat()
	{
	       $cat=$this->input->post('name');
	   //     $table='view_empleadocargo';
	       // $where=array('IdGR' => $cat);
	        $data['sc_get']=$this->he_model->get_where_data($cat);
	        $sc=json_encode($data['sc_get']);
	        echo $sc;
	}

	public function get_subcargos()
	{
	        $empleado=$this->input->post('idemp'); 
	         $data['empleado']=$this->he_model->obtenerCargo($empleado);
	        $sc=json_encode($data['empleado']);
	        echo $sc;
	}
     
	public function generarHE()
	{
		$data['idMax'] = $this->he_model->VerDetalle();		
		$fechainicio=$data['idMax'][0]['Finicio'];
		$fechafinal=$data['idMax'][0]['Ffinal'];
		//$idMax=$data['idMax'][0]['IdRHE'];

		$id['idRHE'] = $this->he_model->obtenerIDreporte();	


		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		$data['gerencia']= $this->he_model->gerencia();
		$this->load->view('templates/header');						
		$this->load->view('admin_pages/llenarreporte',array_merge($data,$fechas,$id));
		$this->load->view('templates/footer_admin');						

	}
	public function llenarHE()
	{

		$NoPeriodo = "";
		$Periodo1 = $this->input->get_post('periodo1');
		$Periodo2 = $this->input->get_post('periodo2');
		$FechaE = $this->input->get_post('fecha');
		$IdEM =  $this->session->userdata['IdUnico'];
		$IdEMR = $this->input->get_post('nameR');
		$IdEMA = $this->input->get_post('nameA');
		$parte = explode("/", $Periodo1);
		$parte2 = explode("/", $Periodo2);	

		if ($parte[1]="25" and $parte2[1]="10")
		{			

			$NoPeriodo=2;
		}
		elseif($parte[1]="11" and $parte2[1]="24")
		{
			$NoPeriodo=1;
		}	
		$this->he_model->ingresar($Periodo1,$Periodo2,$NoPeriodo,$FechaE,$IdEM,$IdEMR,$IdEMA);		
	}



	public function updateReporte()
	{
		$fecha1=$_POST['fecha'];
		$fecha2= $_POST['fecha1'];
		$id=$_POST['idh'];
		$dias= $this->diff($fecha1,$fecha2);
		$dias=$dias+1;	
		//echo $dias;
		$this->he_model->updateNumero($dias,$id);
		//$this->he_model->updateReporte($fecha1,$fecha2,$id);
		//$this->guardarHE();
	}

	public function diff($date1, $date2) {
	    $diff = abs(strtotime($date2) - strtotime($date1));
	    $years = floor($diff / (365*60*60*24));
	    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
	    return $days;
	}


	public function guardarHE()
	{
		$comentario=$_POST['comentario'];
        $idRHE=$_POST['idreporte'];
        $columnas=$_POST['idc'];   
       	$columnas=$columnas;    
		$data['datos'] = $this->he_model->VerDetalleparametro($idRHE);
		$fechainicio=$data['datos'][0]['Finicio'];
		$fechafinal=$data['datos'][0]['Ffinal'];
		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);						
		$columnas=$columnas+4;			
		$consulta="insert into lldetallehe (IdRHE,IdEMP,Fecha,RHX) VALUES ( ";		
		$id;
		$idemp;		
		$rhx;
		$contador1=0;
		$contador2=0;
		echo "Guardando Datos por favor espere...";
		echo "<br>";

		$i=0;
		$this->he_model->borrar($idRHE);		
		foreach ($_POST as $key => $value) 
		{								
			if($contador1<=2)
			{						
			}
			else
			{
				if($contador2==3)
				{
					$id=$value;
				}
				 if($contador2==4)
				{
					$idemp=$value;
				}	
				if($contador2>=5) 
				{
					$rhx=$value;
					/*convierto las horas a entero ejem: 1.30=1.5
					if($rhx!=0 or 0.00)
					{
					list($hora_entera,$hora_decimal) = explode(".",$rhx); 
					$hora_decimal=$hora_decimal/60;
					$rhx=$hora_entera+$hora_decimal;
					//$rhx=round($rhx, 2);
					$rhx=number_format($rhx,2,".",",");  
					//echo $rhx;
					//echo "<br>";
					}
					else{}*/
	//				echo $rhx;
	//				echo "<br>";
					$consulta .="'".$id."',";
					$consulta .="'".$idemp."',";					
					$consulta .="'".$fechas['rangoDate'][$i]."',";	
					$i++;				
					$consulta .="'".$rhx."'";
					$consulta .=")";
					
					$this->he_model->llenarDetalle($consulta,$idRHE);
					//echo $consulta;
					$consulta="insert into lldetallehe (IdRHE,IdEMP,Fecha,RHX) VALUES ( ";	
					if($contador2==$columnas)
					{						
						$contador1=0;
						$contador2=0;
						$contador2=$contador2-1;
						//echo $contador2;
					//	echo "<br>";
						$contador2++;
						$i=0;
						//echo $contador2;
						//echo "<br>";
					}					
				}
			}
			++$contador1;
			++$contador2;		
		}
		$this->he_model->insert_comentario($comentario,$idRHE);
		
	redirect(base_url().'index.php/editar/'.$idRHE.'','refresh');
	}
	
}
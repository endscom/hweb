<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comparativa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('comparativa_model');
		$this->load->model('he_model');
		$user = $this->session->userdata('logged');

		   if (!isset($user)) { 
		       redirect(base_url().'index.php','refresh');
		   } 
	}

	public function cargarcomparativa()
	{	
	
		$data['gerencia']=$this->comparativa_model->gerencia();	
		$data['reportes']=$this->comparativa_model->reportesGeneral();
		$this->load->view('templates/header');		  				
		$this->load->view('admin_pages/prepararcomparativa',$data);
	}

	public function cargarcomparativaXID()
	{
 		
 		 
		$ID=$_POST['idGR'];	
		$data['gerencia']=$this->comparativa_model->gerencia();
		$data1['reportes']=$this->comparativa_model->reportesXgerencia($ID);
		$this->load->view('templates/header');			
		$this->load->view('admin_pages/prepararcomparativa',array_merge($data,$data1));
	}

	public function vercomparativa($id)
	{		
 	
		$data['datos'] = $this->he_model->VerDetalleparametro($id);
		$fechainicio=$data['datos'][0]['Finicio'];
		$fechafinal=$data['datos'][0]['Ffinal'];
		//$idMax=$data['datos'][0]['IdRHE'];

		$data['empleados']=$this->he_model->empleados($id);
		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		$fechas['rangoDateES'] = $this->he_model->generarDatesES($fechainicio,$fechafinal);			
		$data2['xd'] = $this->he_model->obtenernumero($id);
		$data2['xd2'] = $idMax=$data['datos'][0]['IdRHE'];
		$data['gerencia']=$this->comparativa_model->gerencia();

		$data1['detalle']=$this->comparativa_model->consolidado2($id,$fechainicio,$fechafinal);

		//$data1['detalle']=$this->comparativa_model->consolidado($id);
		$this->load->view('templates/header');			
		$this->load->view('admin_pages/verconsolidado',array_merge($data,$data1,$data2,$fechas));
	}

}
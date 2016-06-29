<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		 $this->load->database();
		 $this->load->library('session');
		 $this->load->model('empleados_model');
		$user = $this->session->userdata('logged');

		   if (!isset($user)) { 
		       redirect(base_url().'index.php','refresh');
		   } 
	}

	public function index()
	{	
		$data['cargos']=$this->empleados_model->mostrarCargos();		
		$data['gerencia']=$this->empleados_model->mostrarGerencias();
		$data['empresas']=$this->empleados_model->mostrarEmpresas();
		$data['empleados']=$this->empleados_model->mostrarEmpleados();
		$this->load->view('templates/header');						
		$this->load->view('Formularios/empleados', $data);
		$this->load->view('jsview/JSnewuser');
	}	

	public function save()
	{

		echo "Guardando empleado, por favor espere.....";
		$nombre=$_POST['nombre'];
		$cargo=$_POST['cargo'];
		$gerencia=$_POST['gerenciaa'];
		$empresa=$_POST['empresa'];
		$autoriza=$_POST['txtautoriza'];
		$revisa=$_POST['txtrevisa'];
		
		/*id de las empresas en que labora*/
		$idunimark=$_POST['txtunimark'];
		$idinnova=$_POST['txtinnova'];
		$idpandora=$_POST['txtpandora'];
		$nombre = ucwords($nombre);
		
		$this->empleados_model->save($nombre,$cargo,$gerencia,$empresa,$autoriza,$revisa,$idunimark,$idinnova,$idpandora);
		redirect(base_url().'index.php/empleados/','refresh');
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		 $this->load->database();
		 $this->load->library('session');
		 $this->load->model('user');
		$user = $this->session->userdata('logged');

		   if (!isset($user)) { 
		       redirect(base_url().'index.php','refresh');
		   } 
	}


	public function index()
	{	
		$data['usuarios']=$this->user->vertodos();
		$this->load->view('templates/header');						
		$this->load->view('Formularios/usuarios', $data);
		$this->load->view('jsview/JSnewuser');
	}	

	public function nuevo()
	{	
		$this->load->view('templates/header');						
		$this->load->view('Formularios/newusuario');
		$this->load->view('jsview/JSnewuser');
	}


	public function save()
	{	
		$usuario=$_POST['usuario'];
		$pass=$_POST['pass'];
		$empresa=$_POST['empresa'];
		$rol=$_POST['privilegio'];
		$activo=1;
		$fecha=date('Y-m-d G:i:s');
		$id=$_POST['id'];

		$data['idunico']=$this->user->maxUnico($id,$empresa);
 		$maximo= $data['idunico'][0]['IdUnico'];


 		if ($maximo!="") {
 		$this->user->save($usuario,MD5($pass),$rol,$activo,$fecha,$id,$empresa,++$maximo);
		redirect(base_url('index.php/verusuarios'));	
 		}
 		else{
 			$empresa2=$_POST['empresa'];
 			if($empresa2==1) {$empresa2="UNIMARK";}
        	if($empresa2==2) {$empresa2="INNOVA";}
        	if($empresa2==3){$empresa2="PANDORA";}

 			$error="No se encontro a ningun empleado con el id: ".$id." Perteneciente a la empresa: ".$empresa2.", verifique planilla.";
 			$this->error($error);
 		}
		
	}

	public function delete()
	{

		$id=$_POST['idDelete'];
		echo "Borrando Usuario espere....";
		$this->user->delete($id);
		redirect(base_url('index.php/verusuarios'));

	}

	public function updatePass()
	{
		$pass=$_POST['pass1'];
		$this->user->updatePass($pass);

	}
	  public function error($error)
	  {
	    $titulo="Error al crear el usuario, ocurrio el siguiente error: ";
	    $arrayName = array('error' => $error,'titulo'=>$titulo);
	    $data['error']=$arrayName;
	    $this->load->view('templates/header');      
	    $this->load->view('admin_pages/error',$data); 
	  }
}
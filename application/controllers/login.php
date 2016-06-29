<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
public function __construct()
	{
		parent::__construct();
		 $this->load->database();
		 $this->load->library('session');
		 $this->load->model('user');
	}


	public function index()
	{	
		$this->load->view('formularios/login');
	}	


	public function logueo()
	{
		$usuario= $this->input->post('usuario');
		$password= $this->input->post('pass');
		
		if (!isset($_POST['pass'])) 
		{
			$this->load->view('formularios/login');
		}
		 if (isset($_POST['pass'])) 
		{		

		$data['user'] = $this->user->login($usuario, $password);
		//echo $data['user'];	
		if ($data['user'] != 0)
		 {

			foreach ($data['user'] as $row) {
					$sessiondata = array(
							'username' => $row['Nombre'],
							'pass' => $row['Pass'],	
							'IdUser' => $row['IdUser'],			
							'Tipo' => $row['Rol'],	
							'Empresa' =>$row['IdEmpresa'],		
							'IdUnico'=>$row['IdUnico'],				
							'logged' => 1
					);
					$this->session->set_userdata($sessiondata);

				}
						
			if ( $sessiondata['Tipo']=="Super Administrador")
			{			
			
				$this->load->view('templates/header');						
				$this->load->view('admin_pages/master');
			}
			else if ( $sessiondata['Tipo']=="Gerente")
			{			
			
				$this->load->view('templates/header_gerente');						
				$this->load->view('admin_pages/master');
			}

			else if ( $sessiondata['Tipo']=="Administrador") 
			{		
	
				$this->load->view('templates/header_home');						
				$this->load->view('admin_pages/master');
			}
		}
			else
			{	
				$this->index();
			}	
		}			
	}


	public function salir(){
		$this->session->sess_destroy();
		$sessiondata = array(
				'logged' => 0
		);
		$this->session->set_userdata($sessiondata);	
		$this->clear_cache();
		$this->index();
	}
	function clear_cache()
	{
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
	}

}

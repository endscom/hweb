<?php if(! defined('BASEPATH')) exit('no direct script access allowed');


class Login_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->database();
		 $this->load->library('session');

	}


	

	public function login($usuario, $pass)
	{
		$this->db->where('Nombre',$usuario);
		$this->db->where('Pass',$pass);
		$sq= $this->db->get('tbluser');
		$asies = $sq->result_array();
		
		//echo $asies[0]['Nombre'];
		//echo $asies[0]['IdUser'];
		if ($sq->num_rows()>0)
		 {
		 	$newdata = array(
                   'Nombre'  =>$asies[0]['Nombre'],
                   'IdUser'    =>$asies[0]['IdUser'],
                   'Rol'	   =>$asies[0]['Rol'],
                   'activo'		=>$asies[0]['Activo'],
                   'logged_in' => TRUE
               );	
		//print_r($newdata);
		$this->session->set_userdata($newdata);
		return true;
		}
		else
		{
		return false;
		}
	}
}
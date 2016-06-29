<?php
/**
* elaborado por ALDER HERNANDEZ™ ™ ®
*/
class Empleados_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
    $this->load->library('session');
	}


	public function mostrarEmpleados()
	{
		$query=$this->db->get('view_todos_empleados');
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return 0;
	}

	public function mostrarGerencias()
	{		
		$this->db->distinct();
		$this->db->select('Gerencia,IdGR');
		$query=$this->db->get('empleado');

		if($query->num_rows() > 0){

			return $query->result_array();
		}
		return 0;
	}
	public function mostrarCargos()
	{
		$this->db->distinct();
		$this->db->select('Descripcion,IdCG');
		$query=$this->db->get('cargo');

		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return 0;
	}

	public function mostrarEmpresas()
	{
		$this->db->distinct();
		$this->db->select('Empresa,IdEP');
		$query=$this->db->get('empleado');

		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return 0;
	}

	public function save($nombre,$cargo,$idgerencia,$idempresa,$autoriza,$revisa,$idunimark,$idinnova,$idpandora)
	{

		$this->validarSAVE($nombre,$cargo,$idgerencia,$idempresa,$autoriza,$revisa,$idunimark,$idinnova,$idpandora);

		switch ($idempresa) {case '1':$empresa="UMKSA"; break;case '2':	$empresa="INNOVA"; break;case '3':$empresa="PANDORA";break;default:$empresa="INDEFINIDA";break;	}

		switch ($idempresa) {
			case 1: $idem=$idunimark; break; case 2: $idem=$idinnova; break; case 3:  $idem=$idpandora; break; default:$idem=0; break;}

		$this->db->distinct();
		$this->db->where('IdGR',$idgerencia);
		$this->db->select('Gerencia');
		$query =$this->db->get('empleado');
		$R = $query->row();


		echo "EL AUTORIZA ES: ".$autoriza." Y EL REVISADO ES: ".$revisa;
		//echo $R->Gerencia." ";
		//echo "LA EMPRESA ES: ".$empresa;
		$data= array('IdEP' => $idempresa, 'Empresa'=>$empresa,'IdGR'=>$idgerencia,'Alias'=>$nombre,'Gerencia'=>$R->Gerencia,'IdEM'=>$idem,'Nombre'=>$nombre,'IdCG'=> $cargo,'Activo'=>1,'IdUser'=>$idem,'Autoriza'=>$autoriza,'Revisa'=>$revisa);
		$this->db->insert('empleado',$data);
		$this->saveDETALLE($idempresa,$idunimark,$idinnova,$idpandora);
	}

	public function saveDETALLE($idempresa,$idunimark,$idinnova,$idpandora)
	{
		$this->db->select('MAX(IdUnico) as IdUnico');
		$query = $this->db->get('empleado');
		$R = $query->row();	

		($idunimark!="") ? $this->db->insert('detalleempleado', array('IdEmpleado' => $idunimark,'IdEmpresa'=>1,'Descripcion'=>'UMKSA','IdUnico' => $R->IdUnico)) : '';
		($idinnova!="") ? $this->db->insert('detalleempleado', array('IdEmpleado' => $idinnova,'IdEmpresa'=>2,'Descripcion'=>'INNOVA','IdUnico' => $R->IdUnico)) : '';
		($idpandora!="") ? $this->db->insert('detalleempleado', array('IdEmpleado' => $idpandora,'IdEmpresa'=>3,'Descripcion'=>'PANDORA','IdUnico' => $R->IdUnico)) : '';

	}

	public function validarSAVE($nombre,$cargo,$gerencia,$empresa,$autoriza,$revisa,$idunimark,$idinnova,$idpandora)
	{
		//echo "unimark: ".$idunimark." id innova: ".$idinnova." idpandora: ".$idpandora;
		$idunimark = ($idunimark == "") ? $idunimark=0 :$idunimark ;
		$idinnova = ($idinnova == "") ? $idinnova=0 :$idinnova ;
		$idpandora = ($idpandora == "") ? $idpandora=0 :$idpandora ;

		$this->db->where('IdEmpleado',$idunimark);
		$this->db->where('IdEmpresa',1);
		$this->db->select('IdEmpleado');
		$queryUNIMARK=$this->db->get('detalleempleado');
		
		$this->db->where('IdEmpleado',$idinnova);
		$this->db->where('IdEmpresa',2);
		$this->db->select('IdEmpleado');
		$queryINNOVA=$this->db->get('detalleempleado');

		$this->db->where('IdEmpleado',$idpandora);
		$this->db->where('IdEmpresa',3);
		$this->db->select('IdEmpleado');
		$queryPANDORA=$this->db->get('detalleempleado');

		if($queryUNIMARK->num_rows() > 0){
			$error="Ya existe un empleado con el id: ".$idunimark." en la empresa UNIMARKSA";
			$this->error($error);
			return false;
		}
		if($queryINNOVA->num_rows() >0){
			$error="Ya existe un empleado con el id: ".$idinnova." en la empresa INNOVA";
			$this->error($error);
			return false;
		}
		if($queryPANDORA->num_rows() >0){
			$error="Ya existe un empleado con el id: ".$idpandora." en la empresa PANDORA";
			$this->error($error);
			return false;
		}		
	}
	public function error($error)
	{
		$titulo="Error al ingresar al empleado, Ocurrio el siguiente error: ";
		$arrayName = array('error' => $error,'titulo'=>$titulo);
		$data['error']=$arrayName;
		$this->load->view('templates/header');			
		$this->load->view('admin_pages/error',$data);	
	}
}
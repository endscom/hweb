<?php
/*
*´¨) 
¸.•´¸.•*´¨) ¸.•*¨) 
(¸.•´ (¸.•` ¤ Alder Hernandez 2016

*/
class Bio_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function Insert($IdEMP,$Empresa,$IdEm,$User,$Fecha,$HoraE,$HoraS,$HoraX)
	{
		/*verifico si la hora de salida es igual a la de entrada, en ese caso la HS es 00:00:00*/
		if ($HoraE==$HoraS) {
			$HoraS="00:00:00";
		}
		/*obtenego el id Unico del empleado de la tabla de detalles*/
		//$query = $this->db->get_where('detalleempleado', array('IdEmpresa' => $IdEMP,'Idempleado' => $IdEm));
		//$R = $query->row();
		/***************************************************/
		/*obtenego los id de las empresas en que labora el empleado*/
		$this->db->distinct('IdEmpresa');
		$this->db->select('IdEmpresa,IdEmpleado,IdUnico');
		$this->db->where('IdUnico',$IdEm);
		$query3= $this->db->get('detalleempleado');
		/***************************************************/
		/*Arreglo que almacena todos los datos a insertar o updetear segun el caso*/	
		/**************************************************************************/
		/*******Ciclo para verificar si exite hora extra en cada una de las empresas en que labora el empleado*/
		foreach ($query3->result_array() as $key => $value) 
		{
			$this->db->where('IdEMPRESA',$value['IdEmpresa']); 
			$this->db->where('IdEM',$value['IdUnico']); 
			$this->db->where('Fecha',$Fecha); 
			$q = $this->db->get('biometrico'); 
			/*si encuentra updetea*/
			if ( $q->num_rows() > 0 )  
			{
				/*actualizo las horas y HoraX si existe,
				 esto por si se volvio a subir el mismo biometrico pero con cambios*/
				if($IdEMP==$value['IdEmpresa'])
				{
					//echo "se updeteo";
					//echo "<br>";
					$data = array(
					'HoraE'=>$HoraE,
					'HoraS'=>$HoraS,
					'HoraX'=>$HoraX
					);
					$this->db->where('IdEMPRESA',$value['IdEmpresa']); 
					$this->db->where('IdEM',$value['IdEmpleado']); 
					$this->db->where('Fecha',$Fecha); 
					$this->db->update('biometrico', $data);
				}
				else
				{
					//echo "se nose";
					//echo "<br>";
					$data = array(
					'HoraX'=>$HoraX
					);
					/*echo "la fecha: ".$Fecha." devuelve un valor en la empresa ".$value['IdEmpresa'];
					echo " ";		
					echo "se updeteo el data: ";print_r($data);
					echo "<br>";
					echo "<br>";*/		
					$this->db->where('IdEMPRESA',$value['IdEmpresa']); 
					$this->db->where('IdEM',$value['IdEmpleado']); 
					$this->db->where('Fecha',$Fecha); 
					$this->db->update('biometrico', $data);
				}
			}

			/*si no encuentra inserta un nuevo registro*/
			else if($IdEMP==$value['IdEmpresa'])
			{ 
					//echo "se ingreso";
					//echo "<br>";
					$data = array(
					'IdEMPRESA' =>$IdEMP,
					'Empresa' => $Empresa,
					'IdEm'=>$IdEm,
					'User'=>$User,
					'Fecha'=>$Fecha,
					'HoraE'=>$HoraE,
					'HoraS'=>$HoraS,
					'HoraX'=>$HoraX
					);
			/*echo "LA FECHA: ".$Fecha." NO TRAJO VALOR EN LA EMPRESA ".$value['IdEmpresa'];
				echo "<br>";
				echo "se INSERTO el data: ";print_r($data);
				echo "<br>";
				echo "<br>";*/
				$insert= $this->db->insert('biometrico', $data);
			}	
		}
	
	}

	public function insertTemp($idEMP,$Empresa,$IdEm,$Nombre,$Fecha,$Hora)
	{
		if($idEMP!="" and $Empresa!="" and $IdEm!="")
		{
		$data = array(
					'IdEmpresa' =>$idEMP,
					'Empresa' => $Empresa,
					'IdEM'=>$IdEm,
					'User'=>$Nombre,
					'Fecha'=>$Fecha,
					'HoraE'=>$Hora
					);
		$insert= $this->db->insert('tbltemporal', $data);
		}
	}

	public function TraerTemp()
	{
		$this->db->select('IdEmpresa,User,Empresa,IdEM,Fecha,MIN(HoraE) AS HoraE, MAX(HoraE) AS HoraS');
		$this->db->group_by("Fecha,IdEM"); 
		$this->db->order_by("IdEM", "asc"); 
		$query=$this->db->get('tbltemporal');
		if($query->num_rows() > 0)
		{
		$this->db->from('tbltemporal'); 
		$this->db->truncate(); 
			return $query->result_array();
		}
		return 0;		
	}

public function ObtenerHora($ID,$IdEmpleado,$fecha)
{
	/*obtenego el id Unico del empleado de la tabla de detalles*/
	$query = $this->db->get_where('detalleempleado', array('IdEmpresa' => $ID,'IdUnico' => $IdEmpleado));
	$R = $query->row();
	/***************************************************/

	//echo "El id empleado es: ".$IdEmpleado. " empresa: ".$ID. " Y SU IDUNICO ES:" .$R->IdUnico;
	//echo "<br>";
	/*obtenego los id de las empresas en que labora el empleado*/
	$this->db->distinct('IdEmpresa');
	$this->db->select('*');
	$this->db->where('IdUnico',$R->IdUnico);
	$query3= $this->db->get('detalleempleado');
	/***************************************************/

	$arrayHoras = array();

	/**Ciclo para mandar a traer las HE Y HS del empleado en las empresas en que marca biometrico***/
	foreach ($query3->result_array() as $key => $value) {
		$query4=$this->db->query("SELECT Fecha,HoraE,HoraS FROM biometrico WHERE IdEmpresa='".$value['IdEmpresa']."' and Fecha='".$fecha."' and IdEM='".$value['IdEmpleado']."'");	    	
		$arrayHoras[] = $query4->result_array();
	}
	/***************************************************/
	if(count($arrayHoras) > 0)
	{
		return $arrayHoras;
	}
	return 0;
	//return $arrayHoras;	
}

	public function get_fechas()
	{
		$query=$this->db->get('view_fechasbio');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return 0;
	}
	public function Idunico($id,$idempresa)
	{
		$this->db->select('IdUnico');
		$this->db->where('IdEmpleado',$id);
		$this->db->where('IdEmpresa',$idempresa);
		$query=$this->db->get('detalleempleado');
		if($query->num_rows() > 0)
		{

			//print_r($query->result_array());
			return $query->result_array();
		}
		return 0;
	}
}
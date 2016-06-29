<?php if(! defined('BASEPATH')) exit('no direct script access allowed');


class Comparativa_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('he_model');
	}

	/*OBTENGO TODAS LAS GERENCIAS*/
	public function gerencia()
	{				

		$this->db->select('distinct (Gerencia),IdGR');
		$this->db->order_by('IdGR', 'ASC'); 
		$query = $this->db->get('empleado');
		if($query->num_rows() > 0){

			return $query->result_array();
		}
		return 0;
	 // print_r($query->result_array());
	    //console.log($query)
	 // var_dump($query->result_array();
	}
	public function reportesGeneral()
	{
		$query=$this->db->get('view_reportesgeneral');
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return 0;
	}

	public function reportesXgerencia($id=FALSE)
	{

  	//echo $id;
		if ($id==null)
		{
			return 0;  
		}
		else
		{
			$this->db->where('IdGR', $id);   
			$query = $this->db->get('view_reportesxgerencia');    

			if($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			return 0;
		}
	}

	public function consolidado2($id,$fecha1,$fecha2)
	{
		$rangoDate=$this->he_model->generarDates($fecha1,$fecha2);

		$consulta="SELECT IDEMP, (SELECT Nombre FROM empleado WHERE IdUnico = T0.IDEMP) as NOMBRE,(SELECT
		DISTINCT cargo.Descripcion	FROM empleado INNER JOIN cargo ON empleado.IdCG = cargo.IdCG
		INNER JOIN lldetallehe ON lldetallehe.IdEMP = empleado.IdUnico 
		INNER JOIN llenadohe ON llenadohe.IdRHE = lldetallehe.IdRHE
		WHERE
		lldetallehe.IdRHE = $id AND lldetallehe.IdEMP = T0.IDEMP) as CARGO, T0.IdRHE, ";

		for ($i=0; $i <count($rangoDate) ; $i++) 
		{ 
$consulta.=" IF(IFNULL((select RHX FROM LLDETALLEHE WHERE FECHA = '$rangoDate[$i]' AND IDEMP = T0.IDEMP),0.0) <= IFNULL((select HoraX FROM biometrico WHERE FECHA = '$rangoDate[$i]' AND biometrico.IdEM =T0.IDEMP),0.0), 
IFNULL((select RHX FROM LLDETALLEHE WHERE FECHA = '$rangoDate[$i]' AND IDEMP = T0.IDEMP),0.0), 
IFNULL((select HoraX FROM biometrico WHERE FECHA ='$rangoDate[$i]' AND biometrico.IdEM = T0.IDEMP),0.0))";
			$i++;
			$consulta.="AS FECHA$i,";
			$i=$i-1;

			//echo $consulta;
			//echo "<br>";
		}
		$consulta = substr($consulta,0,-1);  
		$consulta.=" FROM LLDETALLEHE T0 WHERE T0.IdRHE =$id GROUP BY T0.IDEMP";
		//echo $consulta;
		//	echo "<br>";
		//echo $consulta;
		$query= $this->db->query($consulta);
		if($query->num_rows() > 0){
	//	echo $consulta;
			return $query;
		}
		return 0;
	}

	public function consolidado($id)
	{

		$obj = new Clsmysql;
		$link = $obj->open_database_connectionMYSQL();
		$resultado= mysql_query("CALL Sp_Consolidado('".$id."')",$link) or die (mysql_error()); 
		while($row=mysql_fetch_array($resultado)){   
			$Array[] =$row;
		}   
		$condicion=count($Array);      
		if($condicion != 0)
		{   
			return $Array; 
		}
		return 0;
	}
	
}
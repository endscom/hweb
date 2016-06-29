<?php
/**
* elaborado por ALDER HERNANDEZ™ ™ ®
*/
class He_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
    $this->load->library('session');
	}
  public function articulos($slug=FALSE)
  {
    $idEmpleado=$this->session->userdata('IdUnico');  

    
    $query2=$this->db->query("SELECT DISTINCT (IdGR) from empleado where IdUnico='$idEmpleado'");
    $R;
     if($query2->num_rows() > 0){
     $R = $query2->row();  
     //echo "ekisde";   
    }
    $this->db->where('IdGR',$R->IdGR);
    $query = $this->db->get('view_empleados');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    return 0;
  }
public function gerentes($slug=FALSE)
  {
    $this->db->where('Autoriza',1);
    $query = $this->db->get('view_autorizan');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    return 0;
  }
  /*OBTENGO TODAS LAS GERENCIAS*/
  public function gerencia(){
    $this->db->select('distinct (Gerencia),IdGR');
      $this->db->order_by('IdGR', 'ASC'); 
    $query = $this->db->get('empleado');
     
  if($query->num_rows() > 0){
    return $query->result_array();
   }
  return 0;
  }
/* OBTENGO LOS EMPLEADOS DEPENDIENDO DE LA GERENCIA**********
******************AJAX********************** */
  function get_cities($country = null){
      $this->db->select('IdEP, Nombre');
 
      if($country != NULL){
          $this->db->where('IdGR', $country);
      }
 
      $query = $this->db->get('empleado');
 
      $cities = array();

      if($query->result()){
          foreach ($query->result() as $city) {
              $cities[$city->id] = $city->city_name;                         

          }
      
      return $cities;
      }else{
          return FALSE;
      }
}

public function obtenerdetalle($id)
{
  $this->db->where('IdRHE', $id);
    $query = $this->db->get('view_detallehrext');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    return 0;
  //  echo $id;
  //  print_r($query->result_array());

}
  public function VerDetalle($slug=FALSE)
  {

    $row = $this->db->query('SELECT MAX(IdRHE) AS maxid FROM llenadohe')->row();
    $maxid = $row->maxid; 

    $this->db->where('IdRHE', $maxid);
    $query = $this->db->get('view_detallehrext');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    return 0;

  }

    public function VerDetalleparametro($id)
  {

    $this->db->where('IdRHE', $id);
    $query = $this->db->get('view_detallehrext');
    if($query->num_rows() > 0){

      return $query->result_array();
    }
    return 0;
  }

  public function eliminarReport($id)
  {
    $this->db->where('IdRHE', $id);
    $this->db->delete('llenadohe'); 
    $this->db->where('IdRHE', $id);
    $this->db->delete('lldetallehe');
  }

  public function obtenerIDreporte()
  {

       $pila = array();  
       $row = $this->db->query('SELECT MAX(IdRHE) AS maxid FROM llenadohe')->row();
       $maxid = $row->maxid; 
      array_push($pila, $maxid);
      return $pila;

  }

public function traerreportes()
{
$condicion ="" ;
 $IDUSER =$this->session->userdata('IdUnico');
 $this->db->select('IdRHE,FechaE,CONCAT (Finicio, " AL ",  Ffinal) AS RANGO');
 $this->db->from('llenadohe');
 $this->db->where('Autorizado', '!=1');
$this->db->where('Revisado', '!=1');
 $this->db->where('IdEM', $IDUSER);
 $query=$this->db->get();
  if($query->num_rows() > 0){
      return $query;
    }
    return 0;
}
public function reportesnoautorizados()
{ 
  if($this->session->userdata('Tipo')=="Administrador")
  {
  $IDUSER =$this->session->userdata('IdUnico');
  $query= $this->db->query("SELECT llenadohe.IdRHE, llenadohe.FechaE, llenadohe.Finicio, llenadohe.Ffinal, 'Revisa' FROM llenadohe WHERE IdEMR= '$IDUSER'  and Revisado !=1 UNION SELECT llenadohe.IdRHE, llenadohe.FechaE, llenadohe.Finicio, llenadohe.Ffinal, 'Autoriza' FROM llenadohe WHERE IdEMA='$IDUSER'  and Revisado !=1");
  //var_dump($query->result_array());
  if($query->num_rows() > 0){
        return $query;
      }
      return 0;
  }
  if($this->session->userdata('Tipo')=="Gerente")
  {
     $IDUSER =$this->session->userdata('IdUnico');
  $query= $this->db->query("SELECT llenadohe.IdRHE, llenadohe.FechaE, llenadohe.Finicio, llenadohe.Ffinal, 'Revisa' FROM llenadohe WHERE IdEMR= '$IDUSER'  and Revisado !=1 UNION SELECT llenadohe.IdRHE, llenadohe.FechaE, llenadohe.Finicio, llenadohe.Ffinal, 'Autoriza' FROM llenadohe WHERE IdEMA='$IDUSER'  and Autorizado !=1 and Revisado !=0");
  //var_dump($query->result_array());
  if($query->num_rows() > 0){
        return $query;
      }
      return 0;
    }
}
public function reportesAutorizados()
{

if($this->session->userdata('Tipo')=="Administrador")
{
  $IDUSER =$this->session->userdata('IdUnico');
$query= $this->db->query("SELECT llenadohe.IdRHE, llenadohe.FechaE, llenadohe.Finicio, llenadohe.Ffinal, 'Revisa' FROM llenadohe WHERE IdEMR= '$IDUSER'  and Revisado =1 UNION SELECT llenadohe.IdRHE, llenadohe.FechaE, llenadohe.Finicio, llenadohe.Ffinal, 'Autoriza' FROM llenadohe WHERE IdEMA='$IDUSER'  and Revisado =1");
//var_dump($query->result_array());
if($query->num_rows() > 0){
      return $query;
    }
    return 0;
}
else if ($this->session->userdata('Tipo')=="Gerente") {
 
}
 $IDUSER =$this->session->userdata('IdUnico');
$query= $this->db->query("SELECT llenadohe.IdRHE, llenadohe.FechaE, llenadohe.Finicio, llenadohe.Ffinal, 'Revisa' FROM llenadohe WHERE IdEMR= '$IDUSER'  and Revisado =1 UNION SELECT llenadohe.IdRHE, llenadohe.FechaE, llenadohe.Finicio, llenadohe.Ffinal, 'Autoriza' FROM llenadohe WHERE IdEMA='$IDUSER'  and Autorizado =1");
//var_dump($query->result_array());
if($query->num_rows() > 0){
      return $query;
    }
    return 0;

}

public function insert_comentario($coment,$id)
{
  $data=array(
      'Comentario'=>$coment
    );
  $this->db->where('IdRHE',$id);
  $this->db->update('llenadohe',$data);
}
public function checkreporte($id,$accion)
{
 // echo $id.$accion;
if ($accion=="Revisa") {
   $data = array(                
               'Revisado' => 1
            );
}
elseif($accion=="Autoriza")
{
    $data = array(                
               'Autorizado' => 1
            );
}

$this->db->where('IdRHE', $id);
$this->db->update('llenadohe', $data); 
   redirect(base_url('index.php/autorizar'));

}

public function get_where_data($idGR)
  {
       $this->db->where('IdGR',$idGR);  
     // $This->db->where('c.IdCG=e.IdCG'); 
        $this->db->order_by('IdEM', 'DESC');   
      $query = $this->db->get('view_empleadocargo');
     return $query->result_array();
  }


public function traerdetalle2($id,$fecha1,$fecha2)
{

 $rangoDate=$this->generarDates($fecha1,$fecha2);

  $consulta="SELECT IDEMP, (SELECT Nombre FROM empleado WHERE IdUnico = T0.IDEMP) as NOMBRE, (SELECT 
  DISTINCT cargo.Descripcion FROM empleado INNER JOIN cargo ON empleado.IdCG = cargo.IdCG INNER JOIN lldetallehe
  ON lldetallehe.IdEMP = empleado.IdUnico INNER JOIN llenadohe ON llenadohe.IdRHE = lldetallehe.IdRHE WHERE
  lldetallehe.IdRHE = $id AND lldetallehe.IdEMP = T0.IDEMP) as CARGO, T0.IdRHE, ";

for ($i=0; $i <count($rangoDate) ; $i++) 
{ 
   $consulta.=" IFNULL ((SELECT RHX FROM LLDETALLEHE WHERE FECHA = '$rangoDate[$i]' ";
   $i++;
   $consulta.=" AND IDEMP = T0.IDEMP), 0.0) AS FECHA$i,";
   $i=$i-1;
  
  }
  $consulta = substr($consulta,0,-1);  
  $consulta.=" FROM LLDETALLEHE T0
  WHERE T0.IdRHE =  $id
  GROUP BY T0.IDEMP";
  //echo $consulta;
  $query= $this->db->query($consulta);

 if($query->num_rows() > 0){
      return $query;
    }
    return 0;

}
public function traerdetalle($id)
{
        $obj = new Clsmysql;
        $link = $obj->open_database_connectionMYSQL();
        $resultado= mysql_query("CALL RowTOCol('".$id."')",$link) or die (mysql_error()); 

        $trow=mysql_num_rows($resultado);
        
        while($row=mysql_fetch_array($resultado)){   
            $Array[] =$row;
        }   
         if($trow != 0)
         {   
         return $Array; 
         }
       return 0;
}

public function obtenernumero($id)
  {
    $this->db->select('Numero');
    $this->db->from('llenadohe');
    $this->db->where('IdRHE', $id);
    $query = $this->db->get();
   if($query->num_rows() > 0){
     // return $query->result_array();
    $R = $query->row();
      //echo $R->Numero;
      return $R->Numero;
    }
    return 0;
  }

public function obtenerCargo($empleado)
{
$this->db->select('c.IdCG,c.Descripcion');
$this->db->from('cargo c, empleado e');
$this->db->where('e.IdEM',$empleado);
$this->db->where('c.IdCG=e.IdCG');
$query = $this->db->get();
 return $query->result_array();
}
  public function generarDates($fechauno,$fechados)
  {     
     $pila = array();  
     $fechaaamostar =$fechauno;
     while(strtotime($fechados) >= strtotime($fechauno))
     {     
      if(strtotime($fechados) != strtotime($fechaaamostar))
      {
       array_push($pila, $fechaaamostar);            
       $fechaaamostar = date("Y-m-d", strtotime($fechaaamostar . " + 1 day"));
     }
     else
     {
       array_push($pila, $fechaaamostar);            
       break;
     }
 }
return $pila;
}

function ingresar($periodo1,$periodo2,$NoPeriodo,$fecha,$Idem,$IdEMR,$IdEMA)
{
    	//$this->db->trans_strict(FALSE);
  $dias = (strtotime($periodo1)-strtotime($periodo2))/86400;
  $dias   = abs($dias); $dias = floor($dias);   
  $dias++;
    $data = array(
    'Nperiodo' => $NoPeriodo,
    'Finicio'=>$periodo1,
    'FechaE'=>$fecha,
    'Ffinal'=>$periodo2,
    'IdEM'=>$Idem,
    'IdEMR'=>$IdEMR,
    'IdEMA'=>$IdEMA,
    'Numero' =>$dias
    );
    //	$this->db->trans_start();
  $insert= $this->db->insert('llenadohe', $data);
     //   $this->db->trans_complete();		
   redirect(base_url('index.php/vertodos'));
}

public function updateNumero($numero,$id)
{
  $data = array(
               'Numero' => $numero
            );
$this->db->where('IdRHE', $id);

$this->db->update('llenadohe', $data); 

}

/********************************
*-***************************************
************************************/
  public function updateReporte($fecha1,$fecha2,$id)
  {

    $data=array(
     'Finicio'=>$fecha1,
     'Ffinal'=>$fecha2
     ); 
    $this->db->where('IdRHE', $id);
    $this->db->update('llenadohe', $data); 
    redirect(base_url().'index.php/editar/'.$id.'','refresh');
  }

  public function llenarDetalle($consulta,$id)
  {     
    $this->db->query($consulta);
  }
  public function borrar($id)
  {
    $this->db->where('IdRHE', $id);
    $this->db->delete('lldetallehe'); 
  }

  public function empleados($id)
  {
    $this->db->where('IdRHE', $id);   
    $query = $this->db->get('view_empleados_autorizados');    

    if($query->num_rows() > 0)
    {
      return $query->result_array();
    }
    return 0;
  }
   public function generarDatesES($fechauno,$fechados)
  {     
     $pila = array();  
     $fechaaamostar =$fechauno;
     while(strtotime($fechados) >= strtotime($fechauno))
     {     

          if(strtotime($fechados) != strtotime($fechaaamostar))
          {
         $transf = strtotime($fechaaamostar);     

         $mes = date("F", $transf);
         $dia = date("d", $transf);
        if ($mes=="January") $mes="Enero";
        if ($mes=="February") $mes="Febrero";
        if ($mes=="March") $mes="Marzo";
        if ($mes=="April") $mes="Abril";
        if ($mes=="May") $mes="Mayo";
        if ($mes=="June") $mes="Junio";
        if ($mes=="July") $mes="Julio";
        if ($mes=="August") $mes="Agosto";
        if ($mes=="September") $mes="Septiembre";
        if ($mes=="October") $mes="Octubre";
        if ($mes=="November") $mes="Noviembre";
        if ($mes=="December") $mes="Diciembre";
        $definitiva=$dia.' '.$mes;

           array_push($pila, $definitiva);     
           $fechaaamostar = date("Y-M-d", strtotime($fechaaamostar . " + 1 day"));
         }
         else
         {
            $transf = strtotime($fechaaamostar);     

         $mes = date("F", $transf);
         $dia = date("d", $transf);
        if ($mes=="January") $mes="Enero";
        if ($mes=="February") $mes="Febrero";
        if ($mes=="March") $mes="Marzo";
        if ($mes=="April") $mes="Abril";
        if ($mes=="May") $mes="Mayo";
        if ($mes=="June") $mes="Junio";
        if ($mes=="July") $mes="Julio";
        if ($mes=="August") $mes="Agosto";
        if ($mes=="September") $mes="Septiembre";
        if ($mes=="October") $mes="Octubre";
        if ($mes=="November") $mes="Noviembre";
        if ($mes=="December") $mes="Diciembre";
        $definitiva=$dia.' '.$mes;
          array_push($pila, $definitiva);              
           break;
         }
      }
    return $pila;
    }
}
<?php

/**
 * User: ALDER HERNANDEZ
 * Date: 03/16/2016
 * Time: 09:26 AM
 */
class User extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function login($name = FALSE, $pass = FALSE)
    {
        if($name != FALSE && $pass != FALSE){              
            $this->db->where('Nombre', $name);
            $this->db->where('Pass', MD5($pass));
            $this->db->where('Activo', !0);
            $query = $this->db->get('tbluser'); 
               
            if($query->num_rows() > 0)
            {
              return $query->result_array();             
            }
            return 0;
        }
    }
    public function vertodos()
    {
      $this->db->where('Activo',!0);
     $query = $this->db->get('view_usuarios');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    return 0;
    }

    public function save($user,$pass,$rol,$activo,$fecha,$id,$empresa,$maximo)
    {   
        $permiso;
        if($rol==0) {$permiso="Super Administrador"; }
        if($rol==1) {$permiso="Gerente";}
        if($rol==2){$permiso="Administrador";}


        $data = array(
           'Nombre' => $user,
           'Pass' => $pass,
           'Rol' => $permiso,
           'Activo' => $activo,
           'Fecha' => $fecha,
           'IdEmpresa'=>$empresa,
           'IdUnico'=>$maximo,
             'IdUser' => $id
        );         
        //print_r($data);
         $this->db->insert('tbluser',$data);
    }

    public function updatePass($pass)
    {
      $id=$this->session->userdata('IdUser');
      $Rol=$this->session->userdata('Tipo');
     
     if ($id!="" or $Rol!="")
      {
       $data = array(
               'Pass' => MD5($pass)
            );
      $this->db->where('IdUser', $id);
      $this->db->where('Rol', $Rol);

      $this->db->update('tbluser', $data);
       redirect(base_url('index.php/entrar'));

     }
     else
     {
       redirect(base_url('index.php/vercomparativa'));
     }
    

    }
    public function maxUnico($idEmpleado,$idempresa)
    {

      $this->db->select('IdUnico');
      $this->db->where('IdEmpleado',$idEmpleado);
      $this->db->where('IdEmpresa',$idempresa);
      $query=$this->db->get('detalleempleado');
      $R = $query->row();
       if($query->num_rows() > 0){
          return $query->result_array();
        }
        return 0;
    }
    public function delete($id)
    {
         $data = array(
               'Activo' => 0
            );

        $this->db->where('IdUser',$id); 
        $this->db->update('tbluser', $data); 
    }

  
}
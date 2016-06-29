<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('comparativa_model');
		$this->load->model('he_model');	
 		$this->load->library('MPDF/mpdf');
		$user = $this->session->userdata('logged');
		if (!isset($user)) { 
		    redirect(base_url().'index.php','refresh');
		} 
	}
	public function edicionhepdf()
	{
		$id=$_POST['idreporte'];
		$data['datos'] = $this->he_model->VerDetalleparametro($id);
		$fechainicio=$data['datos'][0]['Finicio'];
		$fechafinal=$data['datos'][0]['Ffinal'];
		//$idMax=$data['datos'][0]['IdRHE'];

		$data['empleados']=$this->he_model->empleados($id);

		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		$fechas['rangoDateES'] = $this->he_model->generarDatesES($fechainicio,$fechafinal);	
		$data['gerencia']= $this->he_model->gerencia();
		$data2['detalle'] = $this->he_model->traerdetalle2($id,$fechainicio,$fechafinal);
		$data2['xd'] = $this->he_model->obtenernumero($id);
		$data2['xd2'] = $idMax=$data['datos'][0]['IdRHE'];

		//print_r($data2['detalle']);
		$mPDF = new mPDF('utf-8','A4');		
		$mPDF->writeHTML($this->load->view('reportes/edicionhe_pdf',array_merge($data,$fechas,$data2),true));
		$mPDF->Output();

	}

	public function ingresohepdf()
	{
		$id=$_POST['idreporte'];
		$data['datos'] = $this->he_model->VerDetalleparametro($id);
		$fechainicio=$data['datos'][0]['Finicio'];
		$fechafinal=$data['datos'][0]['Ffinal'];
		//$idMax=$data['datos'][0]['IdRHE'];

		$data['empleados']=$this->he_model->empleados($id);

		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		$fechas['rangoDateES'] = $this->he_model->generarDatesES($fechainicio,$fechafinal);	
		$data['gerencia']= $this->he_model->gerencia();
		$data2['detalle'] = $this->he_model->traerdetalle2($id,$fechainicio,$fechafinal);
		$data2['xd'] = $this->he_model->obtenernumero($id);
		$data2['xd2'] = $idMax=$data['datos'][0]['IdRHE'];

		//print_r($data2['detalle']);
		$mPDF = new mPDF('utf-8','A4');		
		$mPDF->writeHTML($this->load->view('reportes/ingresohe_pdf',array_merge($data,$fechas,$data2),true));
		$mPDF->Output();

	}	


	public function reportegerentepdf()
	{
		$id=$_POST['idreporte'];

		$data['datos'] = $this->he_model->VerDetalleparametro($id);
		$fechainicio=$data['datos'][0]['Finicio'];
		$fechafinal=$data['datos'][0]['Ffinal'];
		//$idMax=$data['datos'][0]['IdRHE'];

		$data['empleados']=$this->he_model->empleados($id);

		$fechas['rangoDate'] = $this->he_model->generarDates($fechainicio,$fechafinal);	
		$fechas['rangoDateES'] = $this->he_model->generarDatesES($fechainicio,$fechafinal);	
		$data['gerencia']= $this->he_model->gerencia();
		$data2['detalle'] = $this->he_model->traerdetalle2($id,$fechainicio,$fechafinal);
		//$data2['detalle'] = $this->he_model->traerdetalle($id);
		$data2['xd'] = $this->he_model->obtenernumero($id);

		$data2['xd2'] = $idMax=$data['datos'][0]['IdRHE'];
		//$numero=$data['xd'][0]['Numero'];

		$mPDF = new mPDF('utf-8','A4');

		$mPDF->writeHTML($this->load->view('reportes/gerente_pdf',array_merge($data,$fechas,$data2),true));
        $mPDF->Output();

	}
	public function consolidadopdf()
	{
		$id=$_POST['idreporte'];
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

		$mPDF = new mPDF('utf-8','A4');

		$mPDF->writeHTML($this->load->view('reportes/consolidado_pdf',array_merge($data,$data1,$data2,$fechas),true));
        $mPDF->Output();
	}

	public function consolidadoexcel()
	{
		$id=$_POST['idreporte'];

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

		$this->load->view('reportes/consolidado_excel',array_merge($data,$data1,$data2,$fechas));
	}

}
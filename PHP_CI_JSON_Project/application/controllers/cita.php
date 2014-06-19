<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Cita extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('citas_model');//Cargamos el modelo de citas
	}
	
	
	public function index()
	{
		$obj = $this->citas_model->get_json();//obtenemos el json desde el modelo
		$dato_pie['puntofijo'] = $obj['puntofijo'];//definimos la variable de punto fijo
		$dato['obj']=$obj;//almacenamos los datos del json para pasarselos a la vista
		$header['titulo']="Citas";//Definimos el titulo
		if(isset($_POST['fecha']))//Determinamos si ya se nos ha pasado una fecha
		{
			$dato['fecha']=$_POST['fecha'];//si se ha pasado se almacena en la variable
		}
		else
		{
			$dato['fecha']=-1;//de no ser así la variable toma el valor -1 (no definido)
		}
		//Generamos la vista
		$this->load->view('layout/header',$header);
		$this->load->view('pages/citaView',$dato);
		$this->load->view('layout/footer',$dato_pie);
	}
}
?>
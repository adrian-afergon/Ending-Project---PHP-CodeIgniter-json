<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('citas_model');//Cargamos el modelo de citas
	}
	
	
	public function index()
	{
		$header['titulo']="About";//Definimos el título
		$obj = $this->citas_model->get_json();//cargamos el json
		$dato_pie['puntofijo'] = $obj['puntofijo'];//del json almacenamos el punto fijo
		//Creamos la vista
		$this->load->view('layout/header',$header);
		$this->load->view('pages/about');
		$this->load->view('layout/footer',$dato_pie);
	}
}
?>
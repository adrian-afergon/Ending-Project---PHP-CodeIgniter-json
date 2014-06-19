<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('citas_model');//Cargamos el modelo
	}
	
	
	public function index()
	{	
		$obj = $this->citas_model->get_json();//obtenemos el json desde el modelo
		$dato_pie['puntofijo'] = $obj['puntofijo'];//Definimos el punto fijo
		
		//Configuramos el mapa:
		$this->load->library('googlemaps');//Cargamos la libreria
		$config=array();//creamos el array de la configuracion
		$marker=array();//creamos el array de marcadores
		
		$marker['lat_long']= "". $obj["puntofijo"][0]["latitud"]." , ".$obj["puntofijo"][0]["longitud"]."";//Definimos el marcador
		$this->googlemaps->add_marker($marker);//añadimos el marcador
		
		$config['center_lat_long'] = "". $obj["puntofijo"][0]["latitud"]." , ".$obj["puntofijo"][0]["longitud"]."";//Definimos el centro
		$config['zoom']= 12;//Definimos el zoom
		$config['map_height']="250px";//definimos el alto
		$this->googlemaps->initialize($config);//pasamos la configuración establecida
		$dato['map'] = $this->googlemaps->create_map();//Creamos el mapa
		$header['map'] = $this->googlemaps->create_map();//Creamos el mapa
		
		$dato['titulo']="Home";//Definimos el titulo y creamos la vista:
		$this->load->view('layout/header',$dato);
		$this->load->view('pages/home',$dato);
		$this->load->view('layout/footer',$dato_pie);
	}
}
?>
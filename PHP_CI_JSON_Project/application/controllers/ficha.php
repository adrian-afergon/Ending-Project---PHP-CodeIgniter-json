<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Ficha extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('citas_model');//Cargamos el modelo de citas
	}
	
	/*Ver ficha nos permite ver un elemento en concreto en función de un id*/
	public function verFicha($id)
	{		
		$this->load->helper('form');//cargamos el helper del formulario
		$this->load->library('form_validation');//cargamos el validador del formulario
		
		//Cargamos los datos	
		$obj = $this->citas_model->get_json();//cargamos el json desde el modelo
		$dato['obj']=$obj["colectas"][$id];//Filtramos por el id y lo almacenamos en la variable a pasar a la vista
		$dato['id']=$id;//almacenamos el id recibido para pasarlo a la vista
		
		//Configuramos el mapa:
		$this->load->library('googlemaps');//cargamos la libreria de googlemaps
		$config=array();//definimos el array que llevará la configuración
		$marker=array();//definimos el array que contendrá los marcadores
		
		$marker['lat_long']= "". $obj["colectas"][$id]["latitud"]." , ".$obj["colectas"][$id]["longitud"]."";//Definimos el marcador que se corresponde con nuestro lugar
		$this->googlemaps->add_marker($marker);//añadimos el marcador al array
		
		$config['center_lat_long'] = "". $obj["colectas"][$id]["latitud"]." , ".$obj["colectas"][$id]["longitud"]."";//definimos el centro del mapa en nuestro marcador
		$config['zoom']= 15;//Definimos el zoom
		$config['map_width']="300px";//Definimos el ancho
		$config['map_height']="300px";//Definimos el alto
		$this->googlemaps->initialize($config);//le pasamos los parametros de configuración
		$dato['map'] = $this->googlemaps->create_map();//creamos el mapa y lo almacenamos en la variable a pasar a la vista
		$header['map'] = $this->googlemaps->create_map();//pasamos el mapa a la cabecera tambien
		
		$header['titulo']="Ficha";//definimos el titulo
		
		$dato_pie['puntofijo'] = $obj['puntofijo'];//determinamos el punto fijo
		//Cargamos la vista
		$this->load->view('layout/header',$header);
		$this->load->view('pages/fichaView',$dato);
		$this->load->view('layout/footer',$dato_pie);
		
	}
	
	/*Crear es la funcion encargada de insertar una nueva sita en la tabla de la base de datos*/
	public function crear($id)
	{
		$this->load->helper('form');//Definimos la libreria del formulario
		$this->load->library('form_validation');//Definimos la libreria de las validaciones
		
		//Cargamos los datos	
		$obj = $this->citas_model->get_json();//Cargamos el json desde el modelo
		$dato['obj']=$obj["colectas"][$id];//determinamos el elemento que hemos seleccionado y lo pasamos a la variable
		$dato['id']=$id;//pasamos el id a la variable
		
		$header['titulo']="Crear Ficha";//Definimos el titulo
		
		//Creamos la escritura de la DB
		$data['titulo'] = 'Crear';
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('horario', 'Horario', 'required');
		$this->form_validation->set_rules('lugar', 'Lugar', 'required');
		$this->form_validation->set_rules('localidad', 'Localidad', 'required');
		$this->form_validation->set_rules('donacion', 'Donacion', 'required');
		
		$dato_pie['puntofijo'] = $obj['puntofijo'];//Definimos el punto fijo
		
		if ($this->form_validation->run() === FALSE)//Si no se ha realizado insercion cargamos la vista de nuevo
		{
			$this->load->view('layout/header',$header);
			$this->load->view('pages/fichaView',$dato);
			$this->load->view('layout/footer',$dato_pie);
		}
		else//Si se realiza cargamos la vista de correcto
		{
			$this->citas_model->set_citas();
			$this->load->view('layout/header',$header);
			$this->load->view('pages/success');
			$this->load->view('layout/footer',$dato_pie);
		}
	} 
}

?>
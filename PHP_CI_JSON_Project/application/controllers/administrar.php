<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrar_model');//Cargamos el modelo de administrar
		$this->load->model('citas_model');//Cargamos el modelo de citas
	}
	
	
	public function index()
	{
		$this->load->helper('form');//Cargamos el helper del formulario
		$this->load->library('form_validation');//Cargamos la libreria de lavidaciones
		$dato["titulo"] = "Administración";//Definimos el título
		
		$obj = $this->citas_model->get_json();//Obtenemos el json desde el modelo
		$dato_pie['puntofijo'] = $obj['puntofijo'];//Obtenemos los datos del punto fijo
		
		//Cargamos la vista
		$this->load->view('layout/header',$dato);
		$this->load->view('pages/administrarView');
		$this->load->view('layout/footer',$dato_pie);
	}
	
	public function crear()
	{
		$this->load->helper('form');//Cargamos el helper del formulario
		$this->load->library('form_validation');//Cargamos la libreria de validacion
		
		$dato["titulo"] = "Administración Realizada";//Definimos un titulo
		
		//Definimos las reglas de validacion
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		
		$obj = $this->citas_model->get_json();//Obtenemos el json del modelo
		$dato_pie['puntofijo'] = $obj['puntofijo'];//definimos el punto fijo
		
		if ($this->form_validation->run() === FALSE)//Si la validacion no es correcta vuelve a generar la vista con los errores
		{
			$this->load->view('layout/header',$dato);
			$this->load->view('pages/administrarView',$dato);
			$this->load->view('layout/footer',$dato_pie);
		}
		else//si la validacion es correcta
		{
			
			$this->administrar_model->set_transaccion();//realizamos el metodo de insercion de transacciones
			$obj = $this->administrar_model->get_litrosSangre();//obtenemos los litros de sangre
			if ($this->input->post('tipo') == 1)//Extraer
			{	
				if (($obj[0]['litros'] - $this->input->post('cantidad')) < 0)//Si no hay litros suficientes, devuelve la vista error
				{
					$this->load->view('layout/header',$dato);
					$this->load->view('pages/error');
					$this->load->view('layout/footer',$dato_pie);
				}
				else//Si hay litros necesarios realiza la actualziacion y nos envia a la vista de correcto
				{
					$litros = $obj[0]['litros'] - $this->input->post('cantidad');//Realiza la resta
					$this->administrar_model->update_litros($litros);//realiza la actualziacion pasando como parámetro el nuevo valor
					$this->load->view('layout/header',$dato);
					$this->load->view('pages/success');
					$this->load->view('layout/footer',$dato_pie);
				}
			}
			else//Añadir
			{
				$litros = $obj[0]['litros'] + $this->input->post('cantidad');//realiza la operacion
				$this->administrar_model->update_litros($litros);//realiza la actualizacion
				$this->load->view('layout/header',$dato);
				$this->load->view('pages/success');
				$this->load->view('layout/footer',$dato_pie);
			}
		}
		
	}
}
?>
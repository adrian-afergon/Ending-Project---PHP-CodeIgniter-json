<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Estadistica extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('citas_model');//Cargamos el modelo
	}
	
	public function index()
	{		

		
		$month = date('m');//Obtenemos el mes actual en formato numérico
		$year = date('Y');//Definimos el año actual
		
		$data['citas'] = $this->citas_model->get_citas_estadistica();//obtenemos del modelo los datos para generar la estadística
		
		switch($month)//en funcion del mes miramos cuantos días tiene
		{
			case '01':
			case '03':
			case '05':
			case '07':
			case '08':
			case '10':
			case '12':
				$dias_mes=31;
				break;
			case '04':
			case '06':
			case '09':
			case '11':
				$dias_mes=30;
				break;
			case '02':
				if (($year % 4)==0 && (($year % 100)<>0 || ($year % 400)==0))
				{
					$dias_mes=29;
				}
				else
				{
					$dias_mes=28;
				}
				break;
		}
		$fecha= Array();//Definimos un array de fechas
		for ($i=1;$i<=$dias_mes;$i++)//generamos el array, el cual contiene en cada posicion una fecha
		{
			if ($i<10)//si el día es antes del 10, tendremos que añadirle un 0
				$fecha[$i] = $year."-".$month."-0".$i;
			else
				$fecha[$i] = $year."-".$month."-".$i;
		}
		
		$data['rango'] = $fecha;//almacenamos el array fecha en el array que pasaremos a la vista 

		$data['titulo'] = 'Archivo de citas';//definimos el título
		
		$obj = $this->citas_model->get_json();//obtenemos los datos del json
		$dato_pie['puntofijo'] = $obj['puntofijo'];//definimos el punto fijo
		//Generamos la vista:
		$this->load->view('layout/header',$data);
		$this->load->view('pages/estadisticaView',$data);
		$this->load->view('layout/footer',$dato_pie);
	
	}
	
	public function view($slug)
	{
		$data['citas'] = $this->citas_model->get_citas($slug);
	}
	
}
?>
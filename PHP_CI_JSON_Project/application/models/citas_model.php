<?php
class Citas_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	/*Esta funcion nos devuelve los parametros requeridos para realizar la estadistica*/
	public function get_citas_estadistica($slug=FALSE)
	{
		if ($slug === FALSE)
		{
			$this->db->select('Count(*) as cantidad, fecha_cita');//seleccionamos la cantidad y la fecha
			$this->db->order_by('fecha_cita');//ordenamos por fecha
			$this->db->group_by("fecha_cita");//agrupamos por fecha
			$query = $this->db->get('TB_Citas');//de la tabla indicada
			return $query->result_array();//devolvemos el resultado
		}
		$query = $this->db->get_where('TB_Citas', array('slug' => $slug));
		return $query->row_array();
	}
	
	/*Esta función realiza la escritura en la tabla de la cita solicitada*/
	public function set_citas()
	{
		$this->load->helper('url');
		$data = array(//asocia a cada campo el valor indicado por post
				'fecha_cita' => $this->input-> post('fecha'),
				'horario' => $this->input->post('horario'),
				'lugar' => $this->input->post('lugar'),
				'localidad' => $this->input->post('localidad'),
				'donacion' => $this->input->post('donacion')
		);
		return $this->db->insert('TB_Citas', $data);//Realzia la inserción
	}
	
	/*Esta funcion es la encargada de obtener los datos del JSON y parsearlo*/
	public function get_json()
	{
		$json = file_get_contents('http://www.donantescordoba.org/online/crtsCordoba-colectas.json');//Obtenemos el json
		$obj = json_decode(utf8_decode($json), true);//Lo decodificamos y le damos formato utf8
		/*Le damos el formato MySQL  a la fecha*/
		for ($i=0;$i<count($obj["colectas"]);$i++)//Recorremos el array
		{
			$date = str_replace('/', '-', $obj["colectas"][$i]["fecha"]);//Reemplazamos la / por un -
			$obj["colectas"][$i]["fecha"]= date('Y-m-d', strtotime($date));//le damos formato
		}
		
		return $obj;//devolvemos el json
	}
}
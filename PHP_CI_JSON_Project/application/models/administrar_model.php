<?php
class administrar_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	/*Esta funcion obtiene los litros de sangre que hay*/
	public function get_litrosSangre($slug=FALSE)
	{
		if ($slug === FALSE)
		{
			$this->db->select('litros');//realizamos un select de litros
			$query = $this->db->get('tb_LitrosSangre');//de la tabla indicada
			return $query->result_array();//devolvemos el array
		}
		$query = $this->db->get_where('tb_LitrosSangre', array('slug' => $slug));
		return $query->row_array();
	}
	
	/*Es la funcion encargada de almacenar una transaccion en la base de datos*/
	public function set_transaccion()
	{
		$this->load->helper('url');//Cargamos el helper url (necesario para el metodo post)
		$data = array(//almacenamos en el array los campos correspondientes y de donde los obtenemos
				'tipo' => $this->input-> post('tipo'),
				'cantidad' => $this->input->post('cantidad'),
				'descripcion' => $this->input->post('descripcion'),
				'fecha' => $this->input->post('fecha')
		);
		return $this->db->insert('TB_Administracion', $data);//Realizamos la inserción y devolvemos el resultado
	}
	
	/*Esta funcion actualiza los litros de el registro, por los que le indiquemos*/
	public function update_litros($litros)
	{
		$data = array(
				'litros' => $litros
		);
		$this->db->update('tb_LitrosSangre', $data);
	}
}
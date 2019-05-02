<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//CRUD usuarios del sistema
class Model_user extends CI_Model
{
	public function __construct() {
    parent::__construct();
  }

	//Registrar usuario, recibe un array con los datos a registrar en la BD
 	 public function insert_user($data)
	{
		$sql=$this->db->insert('usuarios', $data);
		return $sql;
	}

	//Consultar usuario, recibe el id del usuario a buscar en la BD
	public function get_user($data)
	{
		$sql=$this->db->get_where('usuarios', $data);
		return $sql->row();
	}

	//Consultar usuarios,  recibe un array con los campos para consultar
	public function get_users($data)
	{
		$sql = $this->db->get_where('usuarios', $data);
    	return $sql->result();
	}

	//actualizar usuario,  recibe un array con los campos y respectivos datos a actualizar en la BD
	public function update_user($data)
	{
		$this->db->where('id',$data['id']);
		$sql=$this->db->update('usuarios',$data);
		return $sql;
	}

	//eliminar usuario, recibe el id del usuario a eliminar de la BD
	public function delete_user($data)
	{
		$sql=$this->db->delete('usuarios', $data);
		return $sql;
	}
}
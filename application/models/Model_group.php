<?php
class Model_group extends CI_Model
{
	public function _construct()
	{
		parent::model();
	}

	//Optiene los usuarios por grupo
	public function get_group($data)
	{
		$sql=$this->db->get_where('usuarios', $data);
		return $sql->result();
	}
	//Optiene los grupos de un profesor
	public function get_groups($data)
	{
		
	  $sql = $this->db->get_where('grupos', $data);
		return $sql->result();
	}
	
	public function insert_group($data)
	{
		return $this->db->insert('grupos', $data);
	}

	public function delete_group($data)
	{
		$sql=$this->db->delete('grupos', $data);
		return $sql;
	}
	public function delete_proyecto($data)
	{
		$sql=$this->db->delete('proyectos', $data);
		return $sql;
	}
}
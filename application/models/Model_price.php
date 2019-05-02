<?php
class Model_price extends CI_Model
{
	public function _construct()
	{
		parent::model();
	}

	//Optiene los usuarios por grupo
	public function get_price($data)
	{
		$sql=$this->db->get_where('precios', $data);
		return $sql->row();
	}
	//Optiene los precios
	public function get_prices($data)
	{
		
	  $sql = $this->db->get_where('precios', $data);
		return $sql->result();
	}
	
	public function insert_price($data)
	{
		return $this->db->insert('precios', $data);
	}
	public function update_price($data)
	{
		$this->db->where('id',$data['id']);
	    $sql=$this->db->update('precios',$data);
	    return $sql;
	}
	public function delete_price($data)
	{
		$sql=$this->db->delete('precios', $data);
		return $sql;
	}
}
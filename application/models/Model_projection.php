<?php
class Model_projection extends CI_Model
{
	public function _construct()
	{
		parent::model();
	}
	
	/*------------------consultas para la memoria de gastos---------------------------------------*/
	//obtiene un concepto registrado en la memoria de costos
	public function get_cpto($data) //listo
	{
		//$sql=$this->db->query("SELECT * FROM memoria_gastos where {$data['id']} = id_proyecto");
		$sql = $this->db->get_where('memoria_gastos', $data);
		return $sql->row();
	}
	//obtiene todos los conceptos registrados en la memoria de costos
	public function get_cptos($data) //listo
	{
		//$sql=$this->db->query("SELECT * FROM memoria_gastos where {$data['id_proyecto']} = id_proyecto");
		$sql = $this->db->get_where('memoria_gastos', $data);
		return $sql->result();
	}
	//registra un concepto en la memoria de costos
	//public function set_cpto($id_proyecto,$concepto,$unidad_medida,$cantidad,$costo_unitario,$frecuencia)
	public function set_cpto($data) //listo
	{
		$costo_mensual = $data['cantidad']*$data['costo_unitario']*$data['frecuencia'];
		
		$sql=$this->db->query("
			INSERT INTO 
			memoria_gastos(concepto, unidad_medida, cantidad, costo_unitario, frecuencia, costo_mensual, id_proyecto
			)
			VALUES(
			'{$data['concepto']}','{$data['unidad_medida']}',{$data['cantidad']},{$data['costo_unitario']},{$data['frecuencia']},{$costo_mensual},{$data['id_proyecto']}
			)"
		);
		
		return $sql;
	}
	//elimina un concepto registrado en la memoria de costos
	public function del_cpto($data) //listo
	{
		//return  $this->db->query("DELETE FROM memoria_gastos WHERE id = {$data['id']}");
		return $this->db->delete('memoria_gastos', $data);
	}
	//actualiza un concepto registrado en la memoria de costos
	//public function upd_cpto($id,$update=NULL,$concepto=NULL,$unidad_medida=NULL,$cantidad=NULL,$costo_unitario=NULL,$frecuencia=NULL)
	public function upd_cpto($data)
	{
		$data['costo_mensual'] = $data['cantidad']*$data['costo_unitario']*$data['frecuencia'];
		$this->db->where('id_proyecto',$data['id_proyecto']);
		$sql = $this->db->update('memoria_gastos',$data);
		return $sql;
	}

}
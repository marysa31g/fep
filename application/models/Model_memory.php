	<?php
class Model_memory extends CI_Model
{
	public function _construct()
	{
		parent::model();
	}
	/*--------------------consultas para la memoria de costos------------------------------------------*/
	//se inserta una categoria en la memoria de costos

	public function set_category($data) //listo
	{
		$sql = $this->db->insert('categoria_memoria', $data);
		return $sql;
	}
	//obtiene las categorias para la memoria de costos
	public function categories($data) //listo
	{
		$sql=$this->db->query("
			SELECT * FROM (
			SELECT mc.*, cm.id id_cat, cm.nombre categoria, cm.subtotal 
			FROM memoria_costos mc 
			RIGHT JOIN categoria_memoria cm 
			ON mc.id_categoria = cm.id) as aux 
			WHERE id_proyecto = {$data['id_proyecto']} 
			ORDER BY categoria"
		);
		return $sql->result();		
	}

	public function get_categories($data) //listo
	{
		$sql = $this->db->get_where('categoria_memoria', $data);
		return $sql->result();
	}

	//registra un concepto en la memoria de costos
	public function set_concept_memory($data) //listo
	{
		$total = $data['volumen'] * $data['costo_unitario'];

		$cat = $this->db->query("SELECT * FROM categoria_memoria where id={$data['id_categoria']}");
		$cat = $cat->row();

		$subtotal = $total + $cat->subtotal;

		$sql=$this->db->query("UPDATE categoria_memoria Set subtotal={$subtotal} WHERE id={$data['id_categoria']}");

		$sql=$this->db->query("

			INSERT INTO memoria_costos(id_categoria, nombre, unidad_medida, volumen, costo_unitario, total, id_proyecto)

			VALUES('{$data['id_categoria']}','{$data['nombre']}','{$data['unidad_medida']}','{$volumen}','{$data['costo_unitario']}','{$total}','{$data['id_proyecto']}')");

		return $sql;
	}
	
		//elimina un concepto registrado en la memoria de costos
	public function delete_concept_memory($data) //listo
	{
		//optenemos el valor del concepto a eliminar
		$ant = $sql = $this->db->query("SELECT * FROM memoria_costos WHERE id={$data['id']}");
		$ant = $ant->row();
		//optenemos el subtotal actual
		$cat = $this->db->query("SELECT * FROM categoria_memoria where id={$ant->id_categoria}");
		$cat=$cat->row();
		//restamos
		$subtotal=$cat->subtotal-$ant->total;
		//actualizamos
		$sql=$this->db->query("UPDATE categoria_memoria Set subtotal={$subtotal} WHERE id={$ant->id_categoria}");
		//eliminamos concepto
		$sql=$this->db->query("DELETE FROM memoria_costos WHERE id={$data['id']}");
		return $sql;
	}

	//eliminar categoria
	public function delete_category($data) //listo
	{
		//optenemos el valor del concepto a eliminar
		$ant = $sql=$this->db->query("
			SELECT * FROM memoria_costos WHERE id_categoria={$data['id_categoria']}"
		);
		$ant = $ant->result();

		foreach ($ant as $aux )
		{
			$sql=$this->db->delete('memoria_costos', array('id' => $aux->id));
		}

		$sql=$this->db->delete('categoria_memoria', array('id' => $id));
		return $sql;
	}

	


	//actualiza un concepto registrado en la memoria de costos
	//public function update_concept($categoria_id=NULL,$concepto=NULL,$unidad_medida=NULL,$volumen=NULL,$costo_unitario=NULL)
	public function update_concept($data)
	{
		

			$total = $data['costo_unitario']*$data['volumen'];
			$ant=$sql=$this->db->query("
				SELECT * FROM memoria_costos WHERE id={$data['id']}");
			$ant=$ant->row();

			$catant=$this->db->query("
				SELECT * FROM categoria_memoria where id={$ant->id_categoria}");
			$catant=$catant->row();

			$cat=$this->db->query("
				SELECT * FROM categoria_memoria where id={$data['categoria_id']}");
			$cat=$cat->row();

			$subtotalant=$catant->subtotal-$ant->total;
			$subtotal=$cat->subtotal+$total;

			$sql=$this->db->query("
				UPDATE categoria_memoria Set subtotal={$subtotalant} WHERE id={$ant->id_categoria}");

			$sql=$this->db->query("
				UPDATE categoria_memoria Set subtotal={$subtotal} WHERE id={$data['categoria_id']}");

			$sql=$this->db->query("
				UPDATE memoria_costos 
				Set id_categoria='{$data['categoria_id']}', nombre='{$data['nombre']}', unidad_medida='{$data['unidad_medida']}', volumen={$data['volumen']}, costo_unitario={$data['costo_unitario']}, total={$total} 
				WHERE id={$data['id']}");

			return $sql;
		
	
	}

	public function update_category($data) //aun no se modifica la categoria
	{
		$this->db->where('id',$data['id']);
		$sql=$this->db->update('categoria_memoria',$data);
		return $sql;
	}


	//obtiene un concepto registrado en la memoria de costos
	public function get_concept($data)
	{
		$sql = $this->db->get_where("memoria_costos", $data);
		return $sql->row();
	}



}
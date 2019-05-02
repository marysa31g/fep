<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_investment extends CI_Model
{

  //Concepto Unidad Cantidad Costo_unitario  Montos  Programas Socios  id_activo id_proyecto
  public function insert_concept($data)
  {
    return $this->db->insert('presupuesto_inversion', $data);
  }
  
  //SELECT pi.*, ta.tipo FROM presupuesto_inversion pi JOIN tipo_activo ta on pi.id_proyecto = 2 and ta.id = pi.id_activo and ta.id = 1
  public function view_concept($data)
  {
    /*
    $data['id_proyecto']
    $data['tipo_activo']
    */
    $this->db->select('pi.*, ta.tipo matricula', false);
    $this->db->from('presupuesto_inversion pi'); //tabla1
    $this->db->join('tipo_activo ta', "pi.id_proyecto = {$data['id_proyecto']} and ta.id = pi.id_activo and ta.id = {$data['tipo_activo']}"); //(tabla2, condicion)
    
    $sql = $this->db->get();
    return $sql->result();
  }


  public function update_concept($data)
  {
    $this->db->where('id', $data['id']);
    return $this->db->update('presupuesto_inversion', $data);
  }

  public function delete_concept($data)
  {
    return $this->db->delete( 'presupuesto_inversion' , $data );
  }

}
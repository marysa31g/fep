<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_production extends CI_Model
{
  public function __construct() {
    parent::__construct();
  }

  //consultas para los parametros de  la produccion
  public function get_parameters($data){
    $sql = $this->db->get_where('parametros_produccion', $data ); //no funciona solo con tabla, $id
    return $sql->result();
  }
   
  public function set_parameters($data)
  {
      return $this->db->insert('parametros_produccion', $data);
  }
   
  public function update_parameters($id=NULL, $data=NULL)
  {
    $this->db->where('id',$id);
    $sql=$this->db->update('parametros_produccion',$data);
    return $sql;
  }
  
  //consultas para los pocentajes de produccion
  public function get_percentages($data){
    $sql = $this->db->get_where('porcentaje_produccion', $data ); //no funciona solo con tabla, $id
    return $sql->result();
  }

  public function get_percentage($data){
    $sql=$this->db->get_where('porcentaje_produccion', $data);
    return $sql->row();
  }
   
  public function set_percentage($data)
  {
      return $this->db->insert('porcentaje_produccion', $data);
  }
   
  public function update_percentage($data=NULL)
  {
    $this->db->where('id',$data['id']);
    $sql=$this->db->update('porcentaje_produccion',$data);
    return $sql;
  }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_technical extends CI_Model
{
  public function __construct() {
    parent::__construct();
  }

  //campos tabla usuarios
  // ID USUARIO PASS ROL
  public function get_parameters($data){
    $sql = $this->db->get_where('tecnicos', $data ); //no funciona solo con tabla, $id
    return $sql->row();
  }
   
  public function set_parameters($data)
  {
      return $this->db->insert('tecnicos', $data);
  }
   
  public function update_parameters($data)
  {
    $this->db->where('id',$data['id']);
    $sql=$this->db->update('tecnicos',$data);
    return $sql;
  }
}
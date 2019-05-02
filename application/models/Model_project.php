<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_project extends CI_Model
{
  public function __construct() {
    parent::__construct();
  }

  public function insert_project($data)
  {
    return $this->db->insert('proyectos', $data);
  }

  public function get_projects($data)
  {
    $this->db->select('usuarios.nombres autor, proyectos.titulo titulo, matricula', false);
    $this->db->from('usuarios');
    $this->db->join('proyectos', 'usuarios.id = proyectos.id_usuario');
    //$this->db->where('grupo',$data['grupo']);
    $sql = $this->db->get();
    return $sql->result();
  }

  public function get_project($data)
  {
    $sql = $this->db->get_where('proyectos', $data);
    return $sql->row();
  }

  public function update_project($data)
  {
    
    $this->db->where('id',$data['id']);
    return $this->db->update('proyectos', $data);
  }

  public function delete_project($data)
  {
    //la parte de navegacion de proyecto
    return $this->db->delete('proyectos', $data);
  }

}
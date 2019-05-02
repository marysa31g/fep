<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_system extends CI_Model
{
  public function __construct() {
    parent::__construct();
  }

  public function empty_db()
  {
    $this->db->truncate("categoria_memoria");
    $this->db->truncate("categoria_producto");
    $this->db->truncate("grupos");
    $this->db->truncate("memoria_costos");
    $this->db->truncate("memoria_gastos");
    $this->db->truncate("mes_produccion");
    $this->db->truncate("parametros_produccion");
    $this->db->truncate("porcentaje_produccion");
    $this->db->truncate("precios");
    $this->db->truncate("presupuesto_inversion");
    $this->db->truncate("produccion_mensual");
    $this->db->truncate("proyectos");   
    $this->db->truncate("tecnicos");
    $this->db->truncate("usuarios");

    $root = array(
      'matricula' => 'adminnova',
      'grupo' => 'root',
      'nombres' => 'Administrador de FEP',
      'apellido_paterno' => 'Nova',
      'apellido_materno' => 'Universitas',
      'pass' => '3strellitaMarinera',
      'foto' => 'No-profile.jpg'
    );

    $sql = $this->db->insert('usuarios', $root);
    //$sql = $this->db->insert('tipo_activo');
    return $sql;
  }

  
}
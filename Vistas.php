<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vistas extends CI_Controller
{
	public function __construct(){
		//llamado al constructor de la clase padre
		parent:: __construct();
	}

	public function reg_memoria_costos()
	{
    $data['titulo'] = 'Registro de proyecto';
    $data['categorias'] = $this->Modelo_proyectos->get_categorias();
    $data['agroquimicos'] = $this->Modelo_proyectos->get_cpto_memoria(1,1);
    $data['fertilizantes'] = $this->Modelo_proyectos->get_cpto_memoria(1,2);
    $data['preparacion'] = $this->Modelo_proyectos->get_cpto_memoria(1,3);
    $data['mano'] = $this->Modelo_proyectos->get_cpto_memoria(1,4);
		$arrayName = (object) array('id'=>0,'categoria' => "", 'nombre' => "",'unidad_medida' => "",'volumen' => "",'costo_unitario' => "");
		$data['cpto']=$arrayName;
	    $data['bandera']=0;
	    $data['bandera_upd']=0;
	    $this->load->view('hf/cabeza', $data);
	    $this->load->view('cont/navbar');
	    $this->load->view('cont/pro_reg');
	    $this->load->view('hf/pie');
  }

  public function memoria_costos()
  {
  		$data['titulo'] = 'Memoria de costos';
  		$data['categorias']=$this->modelo_proyectos->get_categorias();
  		$data['proyecto']=$this->modelo_proyectos->get_proyecto($this->session->userdata('id'));
  		/*foreach ($data['categorias'] as $categoria) {
  			$data[$categoria->nombre]=$this->Modelo_proyectos->get_cpto_memoria($categoria->id, $categoria->nombre);
  		}*/
  	    $this->load->view('hf/cabeza', $data);
	    $this->load->view('cont/navbar');
	    $this->load->view('cont/mem_costos');
	    $this->load->view('hf/pie');
  }

  /*por si acaso*/
  public function produccion()
	{
	    $data['titulo'] = 'Produccion';
	    $this->load->view('hf/cabeza', $data);
	    $this->load->view('cont/navbar');
	    $this->load->view('cont/produccion_mensual');
	    $this->load->view('hf/pie');
  }
}

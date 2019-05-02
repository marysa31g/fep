<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Technical_parameters extends CI_Controller
{
  public function __construct(){
    //llamado al constructor de la clase padre
    parent:: __construct();
  }

  public function index()
  {
    $data['titulo'] = 'Alumno:Proyecto';
    $data['pt'] = 0;
    $fields = array('id_usuario' => $this->session->userdata('id') );
    $data['proyecto'] = $this->model_project->get_project($fields);

    if ($data['proyecto'])
    { 
      $fields = array('id_proyecto' => $data['proyecto']->id );
      $data['pt'] = $this->model_technical->get_parameters($fields);
    }
    else
      $data['pt'] = 0;

    $this->load->view('hf/cabeza', $data);
    $this->load->view('cont/navbar');
    $this->load->view("cont/nav_proyecto");
    $this->load->view('cont/p_tecnicos');
    $this->load->view('hf/pie');
  }

  public function insert_parameters()
  {
    if($this->input->post('add_parametros'))
    {
      //guardamos los datos del formulario
      $area = $this->input->post("area");
      $plantas_metro = $this->input->post("plantas_metro");
      $rendimiento = $this->input->post("rendimiento");
      $um = $this->input->post("um");
      $modulos = $this->input->post('modulos');
      $riego = $this->input->post('riego');
      $calefaccion = $this->input->post('calefaccion');
      $ciclos = $this->input->post('ciclos');
      $inflacion=$this->input->post('inflacion');

      //aplicamos las reglas para validar los datos
      $this->form_validation->set_rules('area', 'area', 'required|numeric');
      $this->form_validation->set_rules('plantas_metro', 'plantas por metro', 'required|numeric');
      $this->form_validation->set_rules('rendimiento', 'rendimiento esperado', 'required|numeric');
      $this->form_validation->set_rules('um', 'unidad de medida', 'required');
      $this->form_validation->set_rules('modulos', 'Número de modulos', 'required|numeric');
      $this->form_validation->set_rules('riego', 'Número de sistemas de riego', 'required|numeric');
      $this->form_validation->set_rules('calefaccion', 'Número de sistemas de calefacción', 'required|numeric');
      $this->form_validation->set_rules('ciclos', 'ciclos por año', 'required|numeric');
      $this->form_validation->set_rules('inflacion', 'Porcentaje de inflación', 'required|numeric');

      //personalizacion de los mensajes de validacion
      $this->form_validation->set_message('required', '%s es un campo requerido');
      $this->form_validation->set_message('numeric', '%s es un campo numerico');
      //personalizacion de los delimitadores de validacion
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      //verificamos que los campos cumplan con la verificacion
      if ($this->form_validation->run() == FALSE)
      {
        $data['titulo'] = 'Alumno:Proyecto';
        $data['pt'] = 0;
        $data['modal'] = 'bandera_ins';
        
        $this->load->view('hf/cabeza', $data);
        $this->load->view('cont/navbar');
        $this->load->view("cont/nav_proyecto");
        $this->load->view('cont/p_tecnicos');
        $this->load->view('hf/pie');
      }
      else
      {
        //guardamos en la bd
        $fields = array('id_usuario' => $this->session->userdata('id') );

        $proyecto = $this->model_project->get_project($fields);

        $plantas_modulo = $plantas_metro*$area;

        $fields = array(
          'area' => $area,
          'plantas_metro' => $plantas_metro,
          'plantas_modulo' => $plantas_modulo,
          'rendimiento' => $rendimiento,
          'um' => $um,
          'modulos' => $modulos,
          'riego'  => $riego,
          'calefaccion' => $calefaccion,
          'ciclos' => $ciclos,
          'inflacion' => $inflacion,
          'id_proyecto' =>$proyecto->id
        );

        $insert = $this->model_technical->set_parameters($fields);
       for ($i=1; $i < 11 ; $i++) {
        $fields = array(
          'ciclo' =>  $i,
          'id_proyecto' =>$proyecto->id
          );
        $this->model_production->set_percentage($fields);
       }
        $msg = $insert?'<div class="exito">Concepto agregado</div>':'<div class="error">Ocurrio un problema, los parametros no se agregaron, porfavor vuelve a intentarlo</div>';
        $this->session->set_flashdata('flash',$msg);
        redirect('technical_parameters');
      }
    }
    else
      redirect('technical_parameters');
  }

  public function update_parameters($id)
  {
    if($this->input->post('upd_parametros'))
    {
      //guardamos los datos del formulario
      $area=$this->input->post("area");
      $plantas_metro=$this->input->post("plantas_metro");
      $rendimiento=$this->input->post("rendimiento");
      $um=$this->input->post("um");
      $modulos = $this->input->post('modulos');
      $riego = $this->input->post('riego');
      $calefaccion = $this->input->post('calefaccion');
      $ciclos = $this->input->post('ciclos');
      $inflacion=$this->input->post('inflacion');
      //aplicamos las reglas para validar los datos
      $this->form_validation->set_rules('area', 'area', 'required|numeric');
      $this->form_validation->set_rules('plantas_metro', 'plantas por metro', 'required|numeric');
      $this->form_validation->set_rules('rendimiento', 'rendimiento esperado', 'required|numeric');
      $this->form_validation->set_rules('um', 'unidad de medida', 'required');      
      $this->form_validation->set_rules('modulos', 'Número de modulos', 'required|numeric');
      $this->form_validation->set_rules('riego', 'Número de sistemas de riego', 'required|numeric');
      $this->form_validation->set_rules('calefaccion', 'Número de sistemas de calefacción', 'required|numeric');
      $this->form_validation->set_rules('ciclos', 'ciclos por año', 'required|numeric');
      $this->form_validation->set_rules('inflacion', 'Porcentaje de inflación', 'required|numeric');

      //personalizacion de los mensajes de validacion
      $this->form_validation->set_message('required', '%s es un campo requerido');
      $this->form_validation->set_message('numeric', '%s es un campo numerico');
      //personalizacion de los delimitadores de validacion
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      //verificamos que los campos cumplan con la verificacion
      if ($this->form_validation->run() == FALSE)
      {
        $data['titulo'] = 'Alumno:Proyecto';
        $fields = array('id_usuario' => $this->session->userdata('id') );
        $proyecto = $this->model_project->get_project($fields);
        $fields = array('id_proyecto' => $proyecto->id );
        $data['pt']=$this->model_technical->get_parameters($fields);
        $data['modal'] = 'modal_upd_tec'; //nombre del modal
        $this->load->view('hf/cabeza', $data);
        $this->load->view('cont/navbar');
        $this->load->view("cont/nav_proyecto");
        $this->load->view('cont/p_tecnicos');
        $this->load->view('hf/pie');
      }
      else
      {
        //guardamos en la bd
        $fields = array('id_usuario' => $this->session->userdata('id') );

        $proyecto = $this->model_project->get_project($fields);
        $plantas_modulo = $plantas_metro*$area;
        $fields = array(
          'area' => $area,
          'plantas_metro' => $plantas_metro,
          'plantas_modulo' => $plantas_modulo, 
          'rendimiento' => $rendimiento,
          'um' => $um,
          'modulos' => $modulos,
          'riego'  => $riego,
          'calefaccion' => $calefaccion,
          'ciclos' => $ciclos,
          'inflacion' => $inflacion,
          'id_proyecto' => $proyecto->id,
          'id' => $id
        );

        $insert = $this->model_technical->update_parameters($fields);

        $msg = $insert?'<div class="exito">Concepto modificado</div>':'<div class="error">Ocurrio un problema, los parametros no se actualizaron, porfavor vuelve a intentarlo</div>';
        $this->session->set_flashdata('flash',$msg);
        redirect('technical_parameters');
      }
    }
    else
    {
      //redirect("technical_parameters");
      $data['titulo'] = 'Alumno:Proyecto';
      $fields = array('id' => $id );
      $data['pt']=$this->model_technical->get_parameters($fields);
      $data['modal'] = 'modal_upd_tec';
      $this->load->view('hf/cabeza', $data);
      $this->load->view('cont/navbar');
      $this->load->view("cont/nav_proyecto");
      $this->load->view('cont/p_tecnicos');
      $this->load->view('hf/pie');
    }
  }
}
?>
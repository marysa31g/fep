<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends CI_Controller
{
  //PROYECCION DE INGRESOS TOTALES
	public function __construct()
	{
    parent::__construct();
	}
  
  public function index()//principal
  {
	  $data['titulo'] = 'Alumno : Proyecto';
    $fields = array('id_usuario' => $this->session->userdata('id'));
	  $data['proyecto'] = $this->model_project->get_project($fields);
    $fields = array('id_proyecto' => $data['proyecto']->id );
    $data['porcentajes']=$this->model_production->get_percentages($fields);
    $data['pt']=$this->model_technical->get_parameters($fields);
    $data['precios']=$this->model_price->get_price($fields);
	  $this->load->view('hf/cabeza', $data);
    $this->load->view('cont/navbar');
    $this->load->view("cont/nav_proyecto");
    $this->load->view('cont/proyeccion_ingresos');
    $this->load->view('hf/pie');
  }

  public function insert_prices($value='')
  {
    if($this->input->post('add_price')){
      //aplicamos las reglas para validar los datos
      $this->form_validation->set_rules('primera', 'Porcentaje de primera', 'trim|required|numeric');
      $this->form_validation->set_rules('segunda', 'Porcentaje de segunda', 'required|numeric');
      $this->form_validation->set_rules('tercera', 'Porcentaje de tercera', 'required|numeric');
      //definimos los mensajes de error
      $this->form_validation->set_message('required', '%s es un campo obligatorio');
      $this->form_validation->set_message('numeric', '%s debe ser un número');
      //definimos los delimitadores en caso de error
      $this->form_validation->set_error_delimiters('<div class="error">','</div>');
      if ($this->form_validation->run() == FALSE)
      {
        $data['titulo'] = 'Alumno : Proyecto';
        $fields = array('id_usuario' => $this->session->userdata('id'));
        $data['proyecto'] = $this->model_project->get_project($fields);
        $fields = array('id_proyecto' => $data['proyecto']->id );
        $data['modal']='modal_add_price';
        $data['porcentajes']=$this->model_production->get_percentages($fields);
        $data['pt']=$this->model_technical->get_parameters($fields);
        $data['precios']=$this->model_price->get_prices($fields);
        $this->load->view('hf/cabeza', $data);
        $this->load->view('cont/navbar');
        $this->load->view("cont/nav_proyecto");
        $this->load->view('cont/proyeccion_ingresos');
        $this->load->view('hf/pie');
      }
      else
      {
        $primera=$this->input->post('primera');
        $segunda=$this->input->post('segunda');
        $tercera=$this->input->post('tercera');
        $fields = array('id_usuario' => $this->session->userdata('id') );
        $proyecto = $this->model_project->get_project($fields);
        $fields = array(
          'primera' => $primera,
          'segunda' => $segunda,
          'tercera' => $tercera,
          'id_proyecto' => $proyecto->id);
        $insert=$this->model_price->insert_price($fields);
        $msg=$insert?'<div class="exito">Informacion actualizada</div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
        $this->session->set_flashdata('flash',$msg);
        redirect("income");
      }
    }
    else
    {
      redirect('income');
    }
  }

  public function update_prices($id)
  {
    if($this->input->post('upd_price')){
      //aplicamos las reglas para validar los datos
      $this->form_validation->set_rules('primera', 'Porcentaje de primera', 'trim|required|numeric');
      $this->form_validation->set_rules('segunda', 'Porcentaje de segunda', 'required|numeric');
      $this->form_validation->set_rules('tercera', 'Porcentaje de tercera', 'required|numeric');
      //definimos los mensajes de error
      $this->form_validation->set_message('required', '%s es un campo obligatorio');
      $this->form_validation->set_message('numeric', '%s debe ser un número');
      //definimos los delimitadores en caso de error
      $this->form_validation->set_error_delimiters('<div class="error">','</div>');
      if ($this->form_validation->run() == FALSE)
      {
        $data['modal']='modal_upd_price';
        $data['titulo'] = 'Alumno : Proyecto';
        $fields = array('id_usuario' => $this->session->userdata('id'));
        $data['proyecto'] = $this->model_project->get_project($fields);
        $fields = array('id_proyecto' => $data['proyecto']->id );
        $data['porcentajes']=$this->model_production->get_percentages($fields);
        $data['pt']=$this->model_technical->get_parameters($fields);
        $data['precios']=$this->model_price->get_price($fields);
        $this->load->view('hf/cabeza', $data);
        $this->load->view('cont/navbar');
        $this->load->view("cont/nav_proyecto");
        $this->load->view('cont/proyeccion_ingresos');
        $this->load->view('hf/pie');
      }
      else
      {
        $primera=$this->input->post('primera');
        $segunda=$this->input->post('segunda');
        $tercera=$this->input->post('tercera');
        $fields = array('id_usuario' => $this->session->userdata('id') );
        $proyecto = $this->model_project->get_project($fields);
        $fields = array(
          'primera' => $primera,
          'segunda' => $segunda,
          'tercera' => $tercera,
          'id' => $id);
        $insert=$this->model_price->update_price($fields);
        $msg=$insert?'<div class="exito">Informacion actualizada</div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
        $this->session->set_flashdata('flash',$msg);
        redirect("income");
      }
    }
    else
    {
      $data['modal']='modal_upd_price';
      $data['titulo'] = 'Alumno : Proyecto';
      $fields = array('id_usuario' => $this->session->userdata('id'));
      $data['proyecto'] = $this->model_project->get_project($fields);
      $fields = array('id_proyecto' => $data['proyecto']->id );
      $data['porcentajes']=$this->model_production->get_percentages($fields);
      $data['pt']=$this->model_technical->get_parameters($fields);
      $data['precios']=$this->model_price->get_price($fields);
      $this->load->view('hf/cabeza', $data);
      $this->load->view('cont/navbar');
      $this->load->view("cont/nav_proyecto");
      $this->load->view('cont/proyeccion_ingresos');
      $this->load->view('hf/pie');
    }
  }

}

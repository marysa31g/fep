<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller
{
	public function __construct(){
		//llamado al constructor de la clase padre
		parent:: __construct();
	}

	public function index()
	{
		$data['titulo'] = 'Alumno:Proyecto';
		$fields = array('id_usuario' => $this->session->userdata('id') );
		$data['proyecto'] = $this->model_project->get_project($fields);
		if ($data['proyecto'])
		{
			$fields = array('id_proyecto' => $data['proyecto']->id );
			$data['parametros']=$this->model_technical->get_parameters($fields);
			$data['porcentajes'] = $this->model_production->get_percentages($fields);
			$fields = array('id' => 0);
			$data['porciento'] = $this->model_production->get_percentage($fields);
		}
		else
			$data['parametros']=0;
		$this->load->view('hf/cabeza', $data);
		$this->load->view('cont/navbar');
		$this->load->view("cont/nav_proyecto");
		$this->load->view('cont/produccion_vista');
		$this->load->view('hf/pie');
	}

	public function upd_percentage($id)
	{
		if($this->input->post('upd_percentage')){
			//aplicamos las reglas para validar los datos
	        $this->form_validation->set_rules('primera', 'Porcentaje de primera', 'trim|required|numeric|max_length[2]');
	        $this->form_validation->set_rules('segunda', 'Porcentaje de segunda', 'required|numeric|max_length[2]');
	        $this->form_validation->set_rules('tercera', 'Porcentaje de tercera', 'required|numeric|max_length[2]');
	        $this->form_validation->set_rules('mermas', 'Porcentaje de mermas', 'required|numeric|max_length[2]');
	        //definimos los mensajes de error
	        $this->form_validation->set_message('required', '%s es un campo obligatorio');
	        $this->form_validation->set_message('numeric', '%s debe ser un número');
	        $this->form_validation->set_message('max_length', '%s debe ser maximo de 2 caracteres');
	        //definimos los delimitadores en caso de error
	        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
	        if ($this->form_validation->run() == FALSE)
            {
            	$data['titulo'] = 'Alumno:Proyecto';
				$fields = array('id_usuario' => $this->session->userdata('id') );
				$data['proyecto'] = $this->model_project->get_project($fields);
				$data['modal']='modal_upd_porcentaje';
				if ($data['proyecto'])
				{
					$fields = array('id_proyecto' => $data['proyecto']->id );
					$data['parametros']=$this->model_technical->get_parameters($fields);
					$data['porcentajes'] = $this->model_production->get_percentages($fields);
					$fields = array('id' => $id);
					$data['porciento'] = $this->model_production->get_percentage($fields);
				}
				else
					$data['parametros']=0;
				$this->load->view('hf/cabeza', $data);
				$this->load->view('cont/navbar');
				$this->load->view("cont/nav_proyecto");
				$this->load->view('cont/produccion_vista');
				$this->load->view('hf/pie');
            }
            else
            {
            	$primera=$this->input->post('primera');
				$segunda=$this->input->post('segunda');
				$tercera=$this->input->post('tercera');
				$mermas=$this->input->post('mermas');
				$fields = array('id_usuario' => $this->session->userdata('id') );
				$proyecto = $this->model_project->get_project($fields);
            	$fields = array(
            		'id' => $id,
            		'primera' => $primera,
            		'segunda' => $segunda,
            		'tercera' => $tercera,
            		'mermas' => $mermas);
            	$insert=$this->model_production->update_percentage($fields);
            	$msg=$insert?'<div class="exito">Informacion actualizada</div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
            	$this->session->set_flashdata('flash',$msg);
            	redirect("production");
            }
		}
		else
		{
			$data['titulo'] = 'Alumno:Proyecto';
			$fields = array('id_usuario' => $this->session->userdata('id') );
			$data['proyecto'] = $this->model_project->get_project($fields);
			$data['modal']='modal_upd_porcentaje';
			if ($data['proyecto'])
			{
				$fields = array('id_proyecto' => $data['proyecto']->id );
				$data['parametros']=$this->model_technical->get_parameters($fields);
				$data['porcentajes'] = $this->model_production->get_percentages($fields);
				$fields = array('id' => $id);
				$data['porciento'] = $this->model_production->get_percentage($fields);
			}
			else
				$data['parametros']=0;
			$this->load->view('hf/cabeza', $data);
			$this->load->view('cont/navbar');
			$this->load->view("cont/nav_proyecto");
			$this->load->view('cont/produccion_vista');
			$this->load->view('hf/pie');
		}
	}
}
	
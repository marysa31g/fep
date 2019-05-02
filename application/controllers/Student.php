<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//este controlador manejara las vistas que utilizara el usuario profesor
class Student extends CI_Controller
{
	public function __construct(){
		//llamado al constructor de la clase padre
		parent:: __construct();
		if ($this->session->userdata('logueado') != TRUE)
    {
      redirect('');
    }
	}

	//vista principal
	public function index()
	{
		$data['titulo'] = 'Alumno:Proyecto';
		$fields = array('id_usuario' => $this->session->userdata('id') );
		$data['proyecto'] = $this->model_project->get_project($fields);
		$this->load->view('hf/cabeza', $data);
	  	$this->load->view('cont/navbar'); 
		if($data['proyecto']) // verifica existencia del proyecto
		{
			
			$fields = array('id_proyecto' => $data['proyecto']->id, 'tipo_activo'=>  1 );
			$data['fijo'] = $this->model_investment->view_concept($fields);
	    $fields = array('id_proyecto' => $data['proyecto']->id, 'tipo_activo'=>  2 );
	    $data['diferido'] = $this->model_investment->view_concept($fields);
	    $fields = array('id_proyecto' => $data['proyecto']->id, 'tipo_activo'=>  3 );
	    $data['capital'] = $this->model_investment->view_concept($fields);
	    
	    $this->load->view("cont/nav_proyecto");
			$this->load->view('cont/presupuesto_inversion', $data);
		}
		else
		{
			$this->load->view("cont/nuevo_proyecto");
		}
	  	$this->load->view('hf/pie'); 
	}

	public function new_project()
	{
	  //guardamos los datos del formulario
	  $id_usuario = $this->session->userdata("id");
	  $titulo = $this->input->post('titulo');
		$this->form_validation->set_rules('titulo', 'Titulo', 'required|min_length[3]|alpha_numeric_spaces');
	  //Personalizamos las reglas
	  $this->form_validation->set_message('required', '%s es un campo requerido');
	  $this->form_validation->set_message('min_length', '%s debe tener al menos 3 caracteres');
	  $this->form_validation->set_message('max_length', '%s no debe tener mas de 20 caracteres');
	  $this->form_validation->set_message('alpha_numeric_spaces', '%s solo puede contener numeros, letras y espacios');

	  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

	  if ($this->form_validation->run() == FALSE)
	  {
	    $data['titulo'] = 'Alumno:Proyecto';
	    $fields = array('id_usuario' => $this->session->userdata('id') );
		$data['proyecto'] = $this->model_project->get_project($fields);
		$data['modal']='crear_proy';
		$this->load->view('hf/cabeza', $data);
		$this->load->view('cont/navbar');
		if($data['proyecto']) // Verificar existencia del proyecto
		{
			$this->load->view("cont/nav_proyecto");
		}
		else
		{
			$this->load->view("cont/nuevo_proyecto");
		}
		$this->load->view('hf/pie');
	  }
	  else
	  {
	    if ($this->input->post("submit"))
		{
		  $datos = array('titulo' => $titulo, 'id_usuario' => $id_usuario);
		  $verificar = $this->model_project->insert_project($datos);
		  $data['bandera_ins']=0;
		  if($verificar)
		  {
		  	$this->session->set_flashdata('flash', '<div class="exito">Proyecto agregado</div>');
		  }
		  else
		  {
		  		$this->session->set_flashdata('flash', '<div class="error">No se agrego el proyecto</div>');
		  }
		}			
		redirect('');	
	  }
	}

	public function update_project()
	{   
		//Establecemos las reglas para el formulario
		$this->form_validation->set_rules('titulo', 'Titulo', 'required|alpha_numeric_spaces|min_length[3]');
		//Personalizamos las reglas
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('min_length', '%s debe tener al menos 3 caracteres');
		$this->form_validation->set_message('alpha_numeric_spaces', '%s solo puede contener numeros, letras y espacios');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			//cargar las vistas no la funcion
			$data['titulo'] = 'Alumno:Proyecto';
			$fields = array('id_usuario' => $this->session->userdata('id') );
			$data['proyecto'] = $this->model_project->get_project($fields);
		  	$data['modal'] = 'modificar_proyecto';
			$this->load->view('hf/cabeza', $data);
			$this->load->view('cont/navbar');
			if($data['proyecto']) // Existe proyecto
			{
				$fields = array('id_proyecto' => $data['proyecto']->id, 'tipo_activo'=>  1 );
				$data['fijo'] = $this->model_investment->view_concept($fields);
				$fields = array('id_proyecto' => $data['proyecto']->id, 'tipo_activo'=>  2 );
				$data['diferido'] = $this->model_investment->view_concept($fields);
				$fields = array('id_proyecto' => $data['proyecto']->id, 'tipo_activo'=>  3 );
				$data['capital'] = $this->model_investment->view_concept($fields);
				$this->load->view("cont/nav_proyecto");
				$this->load->view('cont/presupuesto_inversion', $data);
			}
			else
			{
				$this->load->view("cont/nuevo_proyecto");
			}
			$this->load->view('hf/pie');
		}
		else
		{
			if($this->input->post("modificar_proyecto"))
			{
				$fields = array('id_usuario' => $this->session->userdata('id') );
				$proyecto = $this->model_project->get_project($fields);
				$titulo = $this->input->post('titulo');
				$id_proyecto = $proyecto->id;
				$data = array('titulo' => $titulo, 'id' => $id_proyecto);
				//mandar los datos al modelo 
				$verificar = $this->model_project->update_project($data);
				if($verificar)
				{
					$this->session->set_flashdata('flash', '<div class="exito">Nombre del proyecto modificado</div>');
					redirect('student');
				}// fin comprobacion
				else
				{
					//cargar las vistas
					$this->session->set_flashdata('flash', '<div class="error">No se pudo agregar</div>');
					redirect('student');
				}
		 } // fin input post
		 else
		 {
		   redirect('');
		 }
		}//fin else form validation
	}

	public function delete_project()
	{
		if ( $this->input->post('borrar_proyecto') )
    {
    	$fields = array('id_usuario' => $this->session->userdata('id') );
    	//$data['proyecto'] = $this->model_project->get_project($fields);
    	//eliminar proyecto
    	$del_proy = $this->model_project->delete_project($fields);

      if($del_proy)
      	$this->session->set_flashdata('flash', '<div class="exito">El proyecto ha sido borrado</div>');
    	else
    		$this->session->set_flashdata('flash', '<div class="error">No se pudo borrar el proyecto</div>');
        redirect('student');
    }
    else
    {
    	redirect('');
    }
	}
}
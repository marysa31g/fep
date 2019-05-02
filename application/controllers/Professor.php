<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//este controlador manejara las vistas que utilizara el usuario profesor
class Professor extends CI_Controller
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

		$data['titulo'] = 'Inicio';
		$fields = array('id_profesor' => $this->session->userdata('id'));
		$data['grupos']=$this->model_group->get_groups($fields);
		$data['bandera_ins']=0;
		$this->load->view('hf/cabeza', $data);
	    $this->load->view('cont/navbar');
	    $this->load->view('cont/principal_profesor');
	    $this->load->view('hf/pie');
	}

	//Vista para ver el perfil del profesor
	public function profile()
	{
		//actualizacion perfil profesor
		if($this->input->post('upd_profesor')){
			$matricula=$this->input->post('matricula');
			$nombres=$this->input->post('nombres');
			$apellido_paterno=$this->input->post('apellido_paterno');
			$apellido_materno=$this->input->post('apellido_materno');
			//aplicamos las reglas para validar los datos
			$fields = array('id' => $this->session->userdata('id'));
			$usu=$this->model_user->get_user($fields);
			if ($matricula==$usu->matricula) {
	        	$this->form_validation->set_rules('matricula', 'Usuario', 'required|min_length[8]');
			}
			else
			{
	        	$this->form_validation->set_rules('matricula', 'Usuario', 'required|is_unique[usuarios.matricula]|min_length[8]');
	        }
	        $this->form_validation->set_rules('nombres', 'Nombre', 'trim|required');
	        $this->form_validation->set_rules('apellido_paterno', 'Apellido paterno', 'required');
	        $this->form_validation->set_rules('apellido_materno', 'Apellido materno', 'required');
	        //definimos los mensajes de error
	        $this->form_validation->set_message('required', '%s es un campo obligatorio');
	        $this->form_validation->set_message('is_unique', 'El nombre de %s ya existe en la base de datos');
	        $this->form_validation->set_message('min_length', '%s debe ser al menos de 8 caracteres');
	        //definimos los delimitadores en caso de error
	        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
	        if ($this->form_validation->run() == FALSE)
            {
            	$data['titulo'] = 'Perfil';
				$data['user']=$this->model_user->get_usuario($this->session->userdata('id'));
			    $this->load->view('hf/cabeza', $data);
			    $this->load->view('cont/navbar');
			    $this->load->view('cont/perfil_profesor');
			    $this->load->view('hf/pie');
            }
            else
            {
            	$fields = array('id' => $this->session->userdata('id'),
            		'matricula' => $matricula,
            		'nombres' => $nombres,
            		'apellido_paterno' => $apellido_paterno,
            		'apellido_materno' => $apellido_materno );
            	$insert=$this->model_user->update_user($fields);
            	$msg=$insert?'<div class="exito">Informacion actualizada</div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
            	$this->session->set_flashdata('flash',$msg);
            	redirect("professor/profile");
            }
		}
		else
		{
			$data['titulo'] = 'Perfil';		
			$fields = array('id' => $this->session->userdata('id'));
			$data['user']=$this->model_user->get_user($fields);
		    $this->load->view('hf/cabeza', $data);
		    $this->load->view('cont/navbar');
		    $this->load->view('cont/perfil_profesor');
		    $this->load->view('hf/pie');
		}
	}

	public function list_group($grupo)
	{
		$data['grupo']=$grupo;
		$data['titulo'] = 'Lista';
		$fields = array('grupo' => $grupo );
		$data['alumnos']=$this->model_group->get_group($fields);
		$data['bandera_ins']=0;
		$data['bandera_upd']=0;
		$data['person']=(object) array('matricula'=>'',
						'grupo'=>'',
						'nombres'=>'',
						'apellido_paterno'=>'',
						'apellido_materno'=>'');
	    $this->load->view('hf/cabeza', $data);
	    $this->load->view('cont/navbar');
	    $this->load->view('cont/lista');
	    $this->load->view('hf/pie');
	}

	public function list_project($grupo)
	{
		$data['titulo'] = 'Lista';
		$fields = array( 'grupo' => $grupo);
		$data['proyectos']=$this->model_project->get_projects($fields);
	    $this->load->view('hf/cabeza', $data);
	    $this->load->view('cont/navbar');	
	    $this->load->view('cont/lista_proyectos');
	    $this->load->view('hf/pie');
	}

	//funciones que utiliza el profesor para los grupos
	public function insert_group()
	{
		if($this->input->post('add_group'))
		{
			$grupo=$this->input->post('grupo');
			$this->form_validation->set_rules('grupo', 'Grupo', 'required|is_unique[grupos.grupo]|alpha_numeric');
			$this->form_validation->set_message('is_unique', 'El nombre del %s ya existe en la base de datos');
			$this->form_validation->set_message('required', '%s es un campo obligatorio');
			$this->form_validation->set_message('alpha_numeric', 'El nombre de %s no debe contener espacios ni caracteres especiales');
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
		if ($this->form_validation->run() == FALSE)
		{
			$data['titulo'] = 'Inicio';
			$fields = array('id_profesor' => $this->session->userdata('id') );
			$data['grupos']=$this->model_group->get_groups($fields);
			$data['modal']= 'modal_add_grupo';
			$this->load->view('hf/cabeza', $data);
			$this->load->view('cont/navbar');
			$this->load->view('cont/principal_profesor');
			$this->load->view('hf/pie');
			}
			else
			{

				$fields = array(
					'grupo' => $grupo,
					'id_profesor' => $this->session->userdata('id')
				);
				$insert = $this->model_group->insert_group($fields);
				$msg = $insert?'<div class="exito">El grupo se añadio la lista </div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
			  $this->session->set_flashdata('flash', $msg);
			  redirect('professor');
			}
		}
		else
			redirect('professor');
	}

	public function delete_group()
	{
		if($this->input->post('del_group')){
			$grupo=$this->input->post('eli');
			$resultado=$this->model_group->delete_group($grupo);
			$msg=$resultado?'<div class="exito">El grupo fue eliminado de la lista</div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
            $this->session->set_flashdata('flash',$msg);
            redirect('professor');
		}
		else
			redirect('professor');
	}

	//funciones que utiliza el profesor para los alumnos
	public function insert_student()
	{
		if($this->input->post('add_alumno')){
			$matricula=$this->input->post('matricula');
			$grupo=$this->input->post('grupo');
			$nombres=$this->input->post('nombres');
			$apellido_paterno=$this->input->post('apellido_paterno');
			$apellido_materno=$this->input->post('apellido_materno');
			//aplicamos las reglas para validar los datos
	        $this->form_validation->set_rules('matricula', 'Usuario', 'required|is_unique[usuarios.matricula]|min_length[8]');
	        $this->form_validation->set_rules('grupo', 'Grupo', 'required');
	        $this->form_validation->set_rules('nombres', 'Nombre(s)', 'trim|required');
	        $this->form_validation->set_rules('apellido_paterno', 'Apellido paterno', 'required');
	        $this->form_validation->set_rules('apellido_materno', 'Apellido materno', 'required');
	        //definimos los mensajes de error
	        $this->form_validation->set_message('required', '%s es un campo obligatorio');
	        $this->form_validation->set_message('is_unique', 'El nombre de %s ya existe en la base de datos');	        
	        $this->form_validation->set_message('min_length', '%s debe ser al menos de 8 caracteres');
	        //definimos los delimitadores en caso de error
	        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
	        if ($this->form_validation->run() == FALSE)
            {

				$data['grupo']=$grupo;
		        $data['titulo'] = 'Lista';
				$fields = array('grupo' => $grupo );
				$data['alumnos']=$this->model_group->get_group($fields);
				$data['bandera_ins']=1;
			    $data['bandera_upd']=0;
			    $data['person']=(object) array('matricula'=>'',
						'grupo'=>'',
						'nombres'=>'',
						'apellido_paterno'=>'',
						'apellido_materno'=>'');
			    $this->load->view('hf/cabeza', $data);
			    $this->load->view('cont/navbar');
			    $this->load->view('cont/lista');
			    $this->load->view('hf/pie');
            }
            else
            {
            	$datos = array(
            		'matricula' => $matricula,
            		'grupo' => $grupo,
            		'nombres' => $nombres,
            		'apellido_paterno' => $apellido_paterno,
            		'apellido_materno' => $apellido_materno,
            		'pass' => $matricula);
            	$insert=$this->model_user->insert_user($datos);
            	$msg=$insert?'<div class="exito">Alumno agregado a la lista</div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
            	$this->session->set_flashdata('flash',$msg);
            	redirect('professor/list_group/'.$grupo);
            }
		}
	}

	public function update_student($id,$grupo)
	{
		if ($this->input->post('upd_alumno')) {
			$matricula=$this->input->post('matricula');
			$grupo=$this->input->post('grupo');
			$nombres=$this->input->post('nombres');
			$apellido_paterno=$this->input->post('apellido_paterno');
			$apellido_materno=$this->input->post('apellido_materno');
			$fields = array('id' => $id );
			$usu=$this->model_user->get_user($fields);
			if ($matricula==$usu->matricula) {
	        	$this->form_validation->set_rules('matricula', 'Usuario', 'required|min_length[8]');
			}
			else
			{
	        	$this->form_validation->set_rules('matricula', 'Usuario', 'required|is_unique[usuarios.matricula]');
	        }
	        $this->form_validation->set_rules('nombres', 'Nombre(s)', 'trim|required');
	        $this->form_validation->set_rules('apellido_paterno', 'Apellido paterno', 'required');
	        $this->form_validation->set_rules('apellido_materno', 'Apellido materno', 'required');
	        //definimos los mensajes de error
	        $this->form_validation->set_message('required', '%s es un campo requerido');
	        $this->form_validation->set_message('is_unique', 'El nombre de %s ya existe en la base de datos');
	        $this->form_validation->set_message('min_length', '%s debe ser al menos de 8 caracteres');
	        //definimos los delimitadores en caso de error
	        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
	        if ($this->form_validation->run() == FALSE)
            {
            	$data['grupo']=$grupo;
				$data['titulo'] = 'Lista';
				$data['alumnos']=$this->model_group->get_group($grupo);
				$data['bandera_ins']=0;
				$data['bandera_upd']=1;
				$fields = array('id' => $id );
				$data['person']=$this->model_user->get_user($fields);
			    $this->load->view('hf/cabeza', $data);
			    $this->load->view('cont/navbar');
			    $this->load->view('cont/lista');
			    $this->load->view('hf/pie');
            }
            else
            {
            	$datos = array(
            		'id' => $id,
            		'matricula' => $matricula,
            		'grupo' => $grupo,
            		'nombres' => $nombres,
            		'apellido_paterno' => $apellido_paterno,
            		'apellido_materno' => $apellido_materno,
            		'pass' => $matricula);
            	$insert=$this->model_user->update_user($datos);
            	$msg=$insert?'<div class="exito">Alumno modificado</div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
            	$this->session->set_flashdata('flash',$msg);
            	redirect('professor/list_group/'.$grupo);
            }
		}
		else
		{
			$data['grupo']=$grupo;
			$data['titulo'] = 'Lista';
			$fields = array('grupo' => $grupo );
			$data['alumnos']=$this->model_group->get_group($fields);
			$data['bandera_ins']=0;
			$data['bandera_upd']=1;$fields = array('id' => $id );
				$data['person']=$this->model_user->get_user($fields);
		    $this->load->view('hf/cabeza', $data);
		    $this->load->view('cont/navbar');
		    $this->load->view('cont/lista');
		    $this->load->view('hf/pie');
	    }
	}

	public function delete_student()
	{
		if($this->input->post('del_alumno')){
			$id=$this->input->post('eli');
			$grupo=$this->input->post('grupo');
			$fields = array('id' => $id);
			$insert=$this->model_user->delete_user($fields);
			$msg=$insert?'<div class="exito">El alumno fue eliminado de la lista </div>':'<div class="error">Ocurrio un problema, porfavor vuelve a intentarlo</div>';
            $this->session->set_flashdata('flash',$msg);
            redirect('professor/list_group/'.$grupo);
		}
		else
			redirect('professor/list_group/'.$grupo);
	}
}
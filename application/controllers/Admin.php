<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logueado') != TRUE)
    {
      redirect('');
    }
  }

  public function index() // para ver la lista de profesores y eliminarlos
  {
    $data['titulo'] = 'Ingreso de Usuarios | FEP';
    $fields = array('grupo' => "profesor" );
    $data['profesores'] = $this->model_user->get_users($fields);
    $this->load->view('hf/cabeza', $data);
    $this->load->view('cont/navbar');
    $this->load->view('cont/principal_admin');
    $this->load->view('hf/pie');
  }

  public function new_professor()
  {
    //Establecemos las reglas para el formulario
    //$this->form_validation->set_rules('cantidad', 'Cantidad', 'required|is_numeric');
    $this->form_validation->set_rules('correo', 'Correo','valid_email|required');

    //Personalizamos las reglas
    $this->form_validation->set_message('required', '%s es un campo requerido');
    $this->form_validation->set_message('valid_email', '%s no es valido');
    $this->form_validation->set_message('min_length', '%s debe tener al menos 8 caracteres');
    $this->form_validation->set_message('max_length', '%s no debe tener mas de 20 caracteres');
    $this->form_validation->set_message('alpha_numeric_spaces', '%s solo puede contener numeros, letras y espacios');
    //is_unique[usuarios.usuario]
    //$this->form_validation->set_message('is_unique', 'El %s debe ser unico');

    //cambiamos los delimitadores
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    if ($this->form_validation->run() == FALSE)
    {
      $data['titulo'] = 'Registrar profesor | FEP';
      $this->load->view('hf/cabeza', $data);
      $this->load->view('cont/navbar');
      $this->load->view('cont/registrar_profesor');
      $this->load->view('hf/pie');
    }
    else
    {
      if ($this->input->post("submit"))
      {
        //guardamos los datos del formulario
        //$cantidad = $this->input->post('cantidad');
        $correo = $this->input->post('correo');

        //obtener el id max de usuarios
        $this->db->select_max('id');
        $this->db->from("usuarios");
        $aux = $this->db->get();
        $aux = $aux->row();

        $id_max = $aux->id + 1;
        //echo '<pre>'.print_r($aux, TRUE).'</pre>';

        $profesores = array(
          'matricula' => "usuario{$id_max}",
          'grupo' => "profesor", 
          'pass' => "usuario{$id_max}"
        );
        //mandar los datos al modelo 
        $verificar_agregado = $this->model_user->insert_user($profesores);

        //send_email( $ destinatario , $ asunto , $ mensaje )
        //send_email($recipient, $subject, $message)


        $this->load->library('email');

        $this->email->from('e32wsaq1@gmail.com', 'Sistema FEP');  //de paerte de
        $this->email->to($correo);                   //para quien
        
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Usuario del sistema FEP');
        $this->email->message("Su usuario de ingreso es: usuario{$id_max}, Su contraseña es usuario{id_max}");

        
        $this->email->send();

        if($verificar_agregado != NULL)
        {
          $this->session->set_flashdata('flash', "<div class='exito'}>El usuario y contraseña ha sido enviado al correo {$correo}</div>");
          redirect('admin'); // ver profesores
        }
        else
        {
          $this->session->set_flashdata('flash', '<div class="error">No se pudo crear el profesor</div>');
            $data['titulo'] = 'Registrar profesores | FEP';
            $this->load->view('hf/cabeza', $data);
            $this->load->view('cont/navbar');
            $this->load->view('cont/registrar_profesor');
            $this->load->view('hf/pie');
        }
      }
    }
  
  }

  

  public function delete_professor($id_profesor=NULL)
  {
    // eliminar profesor (listar y eliminar) eliminar proyectos, alumnos, grupos y profesor
    // sacar id del profesor, consulta los  grupos del profesor, los alumnos de cada grupo, el proyecto de cada alumno

    /*
    $grupos = $this->model_user->get_grupos($id_profesor);


    foreach ($grupos as $g) //cada grupo
    {
      $alumnos = $this->model_user->get_grupo($g->grupo); //alumnos del grupo g

      foreach ($alumnos as $a)
      {
        $proy = $this->model_user->eliminar_proyecto($a->id); // del proy del alumno a
        $del_al = $this->model_user->delete_usuario($a->id);
      }

      $del_g = $this->model_user->delete_grupo($g->grupo); //del el grupo g

    }

    $aux = $this->model_user->eliminar_profesor($id_profesor);

    */
    $fields = array('id' => $id_profesor);
    $aux = $this->model_user->delete_user($fields);
    
    if ($aux)
    {
      $this->session->set_flashdata('flash', "<div class='exito'>El profesor, sus grupos, alumnos y proyectos han sido eliminados</div>");
    }
    else
    {
      $this->session->set_flashdata('flash', "<div class='error'>No se pudo eliminar</div>");
    }
    redirect('admin'); 
  }

  public function reset()
  {
    $header['titulo'] = 'Iniciar nuevo semestre | FEP';
    $this->load->view('hf/cabeza', $header);
    $this->load->view('cont/navbar');
    $this->load->view("cont/nuevo_semestre");
    $this->load->view('hf/pie');
  }

  public function empty_db()
  {
    if ( $this->input->post('vaciar') )
    {
      $vacio = $this->model_system->empty_db();
      if ($vacio)
        $this->session->set_flashdata('flash', '<div class="exito">Los datos han sido eliminados</div>');
      else
        $this->session->set_flashdata('flash', '<div class="error">No se eliminaron los datos</div>');
    }
    redirect('admin');
  }

}
  
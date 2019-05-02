<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller
{
	public function index() //login
	{
    if ( !$this->session->userdata('logueado') ) //true si es logueado 
    {
      //Establecemos las reglas para el formulario
      $this->form_validation->set_rules('usuario', 'Usuario', 'required|alpha_numeric');
      $this->form_validation->set_rules('pass', 'Contraseña','required|min_length[8]|alpha_numeric');

      //Personalizamos las reglas
      $this->form_validation->set_message('required', '%s es un campo obligatorio');
      $this->form_validation->set_message('min_length', '%s debe tener al menos 8 caracteres');
      $this->form_validation->set_message('max_length', '%s no debe tener mas de 20 caracteres');
      $this->form_validation->set_message('alpha_numeric', '%s solo puede contener numeros y letras');

      //cambiamos los delimitadores
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

      if ($this->form_validation->run() == FALSE)
      {
        $header['titulo'] = 'Ingreso de Usuarios | FEP';
        $this->load->view('hf/cabeza', $header);
        $this->load->view('cont/navbar');
        $this->load->view('cont/login');
        $this->load->view('hf/pie');
      }
      else
      {
        if ($this->input->post("entrar"))
        {
          //guardamos los datos del formulario
          $usuario = $this->input->post('usuario');
          $pass = $this->input->post('pass');

          //mandar los datos al modelo 
          
          $fields = array(
            'matricula' => trim(addslashes($usuario)),
            "pass" =>  trim(addslashes($pass))
          );
          $verificar = $this->model_user->get_user($fields);

          if($verificar)
          {
            //campos de la tabla usuarios id, usuario, pass, rol
            $datos_usuario = array(
              'id' => $verificar->id,
              'matricula' => $verificar->matricula,
              'grupo' => $verificar->grupo,
              'usuario' => $verificar->nombres,
              'logueado' => true
            );

            //crear la session de los datos obtenidos
            $this->session->set_userdata($datos_usuario);
            
            //loguear usuario
            $header['titulo'] = 'FEP';
            $this->load->view('hf/cabeza', $header);
            $this->load->view('cont/navbar');
            //$this->session->set_flashdata('flash', "<div class='exito'>Bienvenido {$this->session->userdata('usuario')}</div>");
            if ($this->session->userdata('id') == 1 && $this->session->userdata('grupo') == "root") {
              redirect("admin");
            }
            else
            {
              if ($this->session->userdata('id') != 1 && $this->session->userdata('grupo') == "profesor") {
                redirect("professor");
              }
              else
              {
                redirect('student');
              }
            }
            $this->load->view('hf/pie');

          }
          else
          {
            $this->session->set_flashdata('flash', '<div class="error">Usuario o contraseña incorrectos</div>');
            $header['titulo'] = 'Ingreso de Usuarios | FEP';
            $this->load->view('hf/cabeza', $header);
            $this->load->view('cont/navbar');
            $this->load->view('cont/login');
            $this->load->view('hf/pie');
          }
        }
      }
    } //fin if
    else
    {
      //ya esta logueado y se elige su vista inicial
      //loguear usuario
      $header['titulo'] = 'FEP';
      $this->load->view('hf/cabeza', $header);
      $this->load->view('cont/navbar');
      //$this->session->set_flashdata('flash', "<div class='exito'>Bienvenido {$this->session->userdata('usuario')}</div>");
      if ($this->session->userdata('id') == 1 && $this->session->userdata('grupo') == "root") {
        redirect("admin");
      }
      else
      {
        if ($this->session->userdata('id') != 1 && $this->session->userdata('grupo') == "profesor") {
          redirect("professor");
        }
        else
        {
          redirect('student');
        }
      }
      $this->load->view('hf/pie');
    }
	}

  public function logout() //listo
  {
    //funcion para cerrar la sesion del usuario
    $this->session->sess_destroy();
    redirect('');
  }

  public function update_pass() // la contraseña del usuario
  {
    //Establecemos las reglas para el formulario
    $this->form_validation->set_rules('pass_actual', 'Contraseña','required|alpha_numeric_spaces');
    $this->form_validation->set_rules('pass', 'Contraseña','required|alpha_numeric_spaces');
    $this->form_validation->set_rules('pass_conf', 'Contraseña','required|matches[pass]|min_length[8]|alpha_numeric_spaces');

    //Personalizamos las reglas
    $this->form_validation->set_message('required', '%s es un campo requerido');
    $this->form_validation->set_message('min_length', '%s debe tener al menos 8 caracteres');
    $this->form_validation->set_message('max_length', '%s no debe tener mas de 20 caracteres');
    $this->form_validation->set_message('alpha_numeric_spaces', '%s solo puede contener numeros, letras y espacios');
    $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');

    //cambiamos los delimitadores
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('flash', '<div class="error">No se actualizo la contraseña</div>');

      if ($this->session->userdata('id') != 1 && $this->session->userdata('grupo') == "profesor")
      {
        //es profesor
        $data['titulo'] = 'Perfil';
        $data['bandera_ins']=0; 
        $fields = array('id' => $this->session->userdata('id'));
        $data['user']=$this->model_user->get_user($fields);
        //echo ("<pre>".print_r($data['user'], true)."</pre>");
        $this->load->view('hf/cabeza', $data);
        $this->load->view('cont/navbar');
        $this->load->view('cont/perfil_profesor');
      }
      else
      {
        $data['modal'] = 'al_pass';
        //alumno
        $data["titulo"] = "Alumno : Proyecto";
        //$data["proyecto"] = $this->model_proyectos->get_proyecto($this->session->userdata("id"));

        $this->load->view("hf/cabeza", $data);
        $this->load->view("cont/navbar");
        
        if($data["proyecto"]) // Existe proyecto
        {
          $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo'=>1);
          $data["fijo"] = $this->model_investmen->view_concept();
          $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo'=>2);
          $data["diferido"] = $this->model_investmen->view_concept();
          $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo'=>3);
          $data["capital"] = $this->model_investmen->view_concept();
          $this->load->view("cont/nav_proyecto");
          $this->load->view("cont/presupuesto_inversion", $data);
        }
        else
        {
          $this->load->view("cont/nuevo_proyecto");
        }
      }
      

      $this->load->view('hf/pie', $data);
      
    }// validattiion
    else
    {
      if ($this->input->post("mod_pass"))
      {
        //guardamos los datos del formulario
        $id_usuario = $this->session->userdata("id");
        $pass = $this->input->post('pass');
        $pass_actual = $this->input->post('pass_actual');

        $datos = array('pass' => $pass);
        //mandar los datos al modelo 
        //verificar que la contraseña actual se la que ingreso
        $fields = array('id' => $id_usuario);
        $pass_ver = $this->model_user->get_user($fields);
        $pass_ver = $pass_ver->pass;

        $fields = array('id' => $id_usuario, 'pass' => $pass);
        

        if($pass_actual === $pass_ver) {
          $verificar = $this->model_user->update_user($fields);
          if($verificar)
          {
            $this->session->set_flashdata('flash', '<div class="exito">Se actualizaron los datos</div>');
          }
          else
          {
            $this->session->set_flashdata('flash', '<div class="error">No se actualizaron los datos</div>');
            $data['modal'] = 'al_pass';
          }
        }
        else //las pass no cinciden
        {
          $this->session->set_flashdata('flash', '<div class="error">Tu contraseña actual no coincide con la ingresada</div>');
          $data['modal'] = 'al_pass';
        }

        if ($this->session->userdata('id') != 1 && $this->session->userdata('grupo') == "profesor")
        {
          //es profesor
          $data['titulo'] = 'Perfil';
          $data['bandera_ins']=0; 
          $fields = array('id' => $this->session->userdata('id'));
          $data['user']=$this->model_user->get_user($fields);
          //echo ("<pre>".print_r($data['user'], true)."</pre>");
          
          $this->load->view('hf/cabeza', $data);
          $this->load->view('cont/navbar');
          $this->load->view('cont/perfil_profesor');
          $this->load->view('hf/pie');
          
        }
        else
        {
          //es alumno
          $data["titulo"] = "Alumno : Proyecto";
          $data["proyecto"] = $this->model_proyectos->get_proyecto($this->session->userdata("id"));

          $this->load->view("hf/cabeza", $data);
          $this->load->view("cont/navbar");
          
          if($data["proyecto"]) // Existe proyecto
          {
            $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo'=>1);
            $data["fijo"] = $this->model_investmen->view_concept();
            $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo'=>2);
            $data["diferido"] = $this->model_investmen->view_concept();
            $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo'=>3);
            $data["capital"] = $this->model_investmen->view_concept();
            $this->load->view("cont/nav_proyecto");
            $this->load->view("cont/presupuesto_inversion", $data);
          }
          else
          {
            $this->load->view("cont/nuevo_proyecto");
          }
        }
        $this->load->view('hf/pie', $data);

      }//fin submit
      else //else input post
      {
        $header['titulo'] = 'Ingreso de Usuarios | FEP';
        $this->load->view('hf/cabeza', $header);
        $this->load->view('cont/navbar');
        if ($this->session->userdata('id') == 1 && $this->session->userdata('grupo') == "root") {
          // se define la vista para mostrar, profesor alumno o root
        }
        else
        {
          if ($this->session->userdata('id') != 1 && $this->session->userdata('grupo') == "profesor") {
            redirect('professor');
          }
          else
          {
            redirect('student');
          }
        }
        $this->load->view('hf/pie', $data);
      }

    }
  }
}

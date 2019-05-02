<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Investment extends CI_Controller
{
  //PRESUPUESTO DE INVERSION
	public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logueado') != TRUE)
    {
      redirect('');
    }
  }
  
  public function index()
  {
	  $data["titulo"] = "Alumno : Proyecto";
    $fields = array('id_usuario' => $this->session->userdata("id"));
	  $data["proyecto"] = $this->model_project->get_project($fields);

	  $this->load->view("hf/cabeza", $data);
    $this->load->view("cont/navbar");

    if($data["proyecto"]) // Existe proyecto
    {
      $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 1 );
      $data["fijo"] = $this->model_investment->view_concept($fields);
      $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 2 );
      $data["diferido"] = $this->model_investment->view_concept($fields);
      $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 3 );
      $data["capital"] = $this->model_investment->view_concept($fields);
      $this->load->view("cont/nav_proyecto");      
      $this->load->view("cont/presupuesto_inversion", $data);
    }
    else
    {
      
      $this->load->view("cont/nuevo_proyecto");
    }
    $this->load->view("hf/pie");
  }

  // concepto unidad cantidad costo_unitario montos programas socios id_activo id_proyecto

  public function insert_concept($id_activo=NULL)
  {
    //Establecemos las reglas para el formulario
    $this->form_validation->set_rules("concepto", "Concepto", "required|alpha_numeric_spaces");
    $this->form_validation->set_rules("unidad", "Unidad", "required|alpha_numeric_spaces");
    $this->form_validation->set_rules("cantidad", "Cantidad", "required|numeric");
    $this->form_validation->set_rules("costo_unitario", "Costo unitario", "required|numeric");
    //$this->form_validation->set_rules("montos", "Montos", "required");
    $this->form_validation->set_rules("programas", "Programas", "numeric");
    $this->form_validation->set_rules("socios", "Socios", "numeric");

    //Personalizamos las reglas
    $this->form_validation->set_message("required", "%s es un campo requerido");
    $this->form_validation->set_message("numeric", "%s debe ser un numero");
    $this->form_validation->set_message("min_length", "%s debe tener al menos 8 caracteres");
    $this->form_validation->set_message("max_length", "%s no debe tener mas de 20 caracteres");
    $this->form_validation->set_message("alpha_numeric_spaces", "%s solo puede contener numeros, letras y espacios");
    //is_unique[usuarios.usuario]
    //$this->form_validation->set_message("is_unique", "El %s debe ser unico");

    //cambiamos los delimitadores
    $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");

    if ($this->form_validation->run() == FALSE)
    {
      //cargar las vistas no la funcion
      $data["titulo"] = "Alumno:Proyecto";
      $fields = array('id_usuario' => $this->session->userdata("id"));
      $data["proyecto"] = $this->model_project->get_project($fields);

      if ($id_activo == 1) {
        $data['modal'] = 'agregar_fijo';
      }elseif ($id_activo == 2) {
        $data['modal'] = 'agregar_diferido';
      }elseif ($id_activo == 3)
      {
        $data['modal'] = 'agregar_capital';
      }

      $this->load->view("hf/cabeza", $data);
      $this->load->view("cont/navbar");

      if($data["proyecto"]) // Existe proyecto
      {
        $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 1 );
        $data["fijo"] = $this->model_investment->view_concept($fields);
        $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 2 );
        $data["diferido"] = $this->model_investment->view_concept($fields);
        $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 3 );
        $data["capital"] = $this->model_investment->view_concept($fields);
        $this->load->view("cont/nav_proyecto");
        $this->load->view("cont/presupuesto_inversion", $data);
      }
      else
      {
        $this->load->view("cont/nuevo_proyecto");
      }
        //$this->load->view("cont/principal_alumno");
      $this->load->view("hf/pie");
    }
    else
    {
      if ($this->input->post("agregar_concepto"))
      {
        $fields = array('id_usuario' => $this->session->userdata("id"));
        $proyecto = $this->model_project->get_project($fields);
        //guardamos los datos del formulario
        //concepto unidad cantidad costo_unitario montos programas socios id_activo id_proyecto
        $concepto = $this->input->post("concepto");
        $unidad = $this->input->post("unidad");
        $cantidad = $this->input->post("cantidad");
        $costo_unitario = $this->input->post("costo_unitario");
        $montos = $cantidad*$costo_unitario;
        $programas = $this->input->post("programas");
        $socios = $this->input->post("socios");
        
        $id_proyecto = $proyecto->id;

        $data = array(
          "concepto" => $concepto,
          "unidad" => $unidad,
          "cantidad" => $cantidad,
          "costo_unitario" => $costo_unitario,
          "montos" => $montos,
          "programas" => $programas,
          "socios" => $socios,
          "id_activo" => $id_activo,
          "id_proyecto" => $id_proyecto
        );

        //mandar los datos al modelo 
        $verificar = $this->model_investment->insert_concept($data);
       
        if($verificar)
        {
          $this->session->set_flashdata("flash", "<div class='exito'>Concepto agregado</div>");
          redirect("investment");
        }// fin comprobacion
        else
        {
          //cargar las vistas
          $this->session->set_flashdata("flash", "<div class='error'>No se pudo agregar</div>");
          redirect("investment");
          
        }
      } // fin input post
      else
      {
        redirect("investment");
      }


    }//fin else form validation

  } //fin nuevo_concepto

  public function update_concept($id_concepto=NULL, $modal)
  {

    //Establecemos las reglas para el formulario
    $this->form_validation->set_rules("concepto_u{$id_concepto}", "Concepto{$id_concepto}", "required|alpha_numeric_spaces");
    $this->form_validation->set_rules("unidad_u{$id_concepto}", "Unidad", "required|alpha_numeric_spaces");
    $this->form_validation->set_rules("cantidad_u{$id_concepto}", "Cantidad", "required|numeric");
    $this->form_validation->set_rules("costo_unitario_u{$id_concepto}", "Costo unitario", "required|numeric");
    //$this->form_validation->set_rules("montos_u{$id_concepto}", "Montos", "required");
    $this->form_validation->set_rules("programas_u{$id_concepto}", "Programas", "numeric");
    $this->form_validation->set_rules("socios_u{$id_concepto}", "Socios", "numeric");
    $this->form_validation->set_rules("tipo_activo{$id_concepto}", "Tipo de concepto", "required|is_natural_no_zero");

    //Personalizamos las reglas
    $this->form_validation->set_message("required", "%s es un campo requerido");
    $this->form_validation->set_message("numeric", "%s debe ser un numero");
    $this->form_validation->set_message("is_natural_no_zero", "%s es un campo requerido");
    $this->form_validation->set_message("min_length", "%s debe tener al menos 8 caracteres");
    $this->form_validation->set_message("max_length", "%s no debe tener mas de 20 caracteres");
    $this->form_validation->set_message("alpha_numeric_spaces", "%s solo puede contener numeros, letras y espacios");
    //is_unique[usuarios.usuario]
    //$this->form_validation->set_message("is_unique", "El %s debe ser unico");

    //cambiamos los delimitadores
    $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");

    if ($this->form_validation->run() == FALSE)
    {
      //cargar las vistas no la funcion
      $data["titulo"] = "Alumno:Proyecto";
      $fields = array('id_usuario' => $this->session->userdata("id"));
      $data["proyecto"] = $this->model_project->get_project($fields);
      
      if ($modal == 1)
      {
        $data['modal'] = "modificar_fijo{$id_concepto}";
      }
      elseif ($modal == 2)
      {
        $data['modal'] = "modificar_diferido{$id_concepto}";
      }elseif ($modal == 3)
      {
        $data['modal'] = "modificar_capital{$id_concepto}";
      }

      $this->load->view("hf/cabeza", $data);
      $this->load->view("cont/navbar");
      
      if($data["proyecto"]) // Existe proyecto
      {
        $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 1 );
        $data["fijo"] = $this->model_investment->view_concept($fields);
        $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 2 );
        $data["diferido"] = $this->model_investment->view_concept($fields);
        $fields = array('id_proyecto' => $data["proyecto"]->id, 'tipo_activo' => 3 );
        $data["capital"] = $this->model_investment->view_concept($fields);
        $this->load->view("cont/nav_proyecto");
        $this->load->view("cont/presupuesto_inversion", $data);
      }
      else
      {
        $this->load->view("cont/nuevo_proyecto");
      }

      $this->load->view("hf/pie");
    }//fin if form validation
    else //form validation
    {
      if ($this->input->post("modificar_concepto{$id_concepto}"))
      {
        //guardamos los datos del formulario
        //concepto unidad cantidad costo_unitario montos programas socios id_activo id_proyecto
        $concepto = $this->input->post("concepto_u{$id_concepto}");
        $unidad = $this->input->post("unidad_u{$id_concepto}");
        $cantidad = $this->input->post("cantidad_u{$id_concepto}");
        $costo_unitario = $this->input->post("costo_unitario_u{$id_concepto}");
        $montos = $cantidad*$costo_unitario;
        $programas = $this->input->post("programas_u{$id_concepto}");
        $socios = $this->input->post("socios_u{$id_concepto}");
        $tipo_activo = $this->input->post("tipo_activo{$id_concepto}");

        $data = array(
          "concepto" => $concepto,
          "unidad" => $unidad,
          "cantidad" => $cantidad,
          "costo_unitario" => $costo_unitario,
          "montos" => $montos,
          "programas" => $programas,
          "socios" => $socios,
          "id_activo" => $tipo_activo,
          "id"=> $id_concepto
        );

        //mandar los datos al modelo 
        $verificar = $this->model_investment->update_concept($data);
       
        if($verificar)
        {
          $this->session->set_flashdata("flash", "<div class='exito'>Concepto modificado</div>");
          redirect("investment");
        }// fin comprobacion
        else
        {
          //cargar las vistas
          $this->session->set_flashdata("flash", "<div class='error'>No se pudo modificar</div>");
          redirect("investment");
          
        }
      } // fin if input post
      else
      {
        redirect("");
      }// fin else input post

    }//fin else form validation
  }

  public function delete_concept($id)
  {
    $fields = array('id' => $id );
    $aux = $this->model_investment->delete_concept($fields);
      
    if ($aux)
    {
      $this->session->set_flashdata("flash", "<div class='exito'>El concepto fue eliminado</div>");
    }
    else
    {
     $this->session->set_flashdata("flash", "<div class='error'>Error al eliminar el concepto</div>");
    }
    redirect("investment"); 
    //redirect("");
  }
  
}//fin clase

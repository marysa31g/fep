<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memory_calc extends CI_Controller
{
	public function __construct(){
		//llamado al constructor de la clase padre
		parent:: __construct();
		if ($this->session->userdata('logueado') != TRUE)
    {
      redirect('');
    }
	}


	public function index() //listo
	{
		$data['titulo'] = 'Alumno:Proyecto';

		$fields = array('id_usuario' => $this->session->userdata('id'));
		$data['proyecto'] = $this->model_project->get_project($fields);

		if ($data['proyecto'])
		{
			$fields = array('id_proyecto' =>$data['proyecto']->id);
			$data['categoriasR'] = $this->model_memory->get_categories($fields);
			$data['categorias'] = $this->model_memory->categories($fields);
		}
		else
		{
			$fields = array('id_proyecto' => 0 );
			$data['categorias']=$this->model_memory->categories($fields);
		}
		
		$data['cpto']= (object) array('id'=>0,'categoria' => "", 'nombre' => "",'unidad_medida' => "",'volumen' => "",'costo_unitario' => "");

		$this->load->view('hf/cabeza', $data);
		$this->load->view('cont/navbar');
		$this->load->view("cont/nav_proyecto");
		$this->load->view('cont/mem_costos');
		$this->load->view('hf/pie');
	}

	public function memory_calc() //listo
  {
		$data['titulo'] = 'Memoria de costos';

		$fields = array('id_usuario' => $this->session->userdata('id'));
		$data['proyecto'] = $this->model_project->get_project($fields);

		$fields = array('id_proyecto' =>$data['proyecto']->id);
		$data['categorias'] = $this->model_memory->get_categories($fields);

	  $this->load->view('hf/cabeza', $data);
    $this->load->view('cont/navbar');
    $this->load->view('cont/mem_costos');
    $this->load->view('hf/pie');
  }

	public function insert_category($id_proyecto) //listo
	{
		if($this->input->post('add_categoria'))
    {
    	
    	$this->form_validation->set_rules('categoria', 'Categoria', 'required');
      $this->form_validation->set_message('required', '%s es un campo requerido');

      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

      if ($this->form_validation->run() == FALSE)
      {

        $data['titulo'] = 'Alumno:Proyecto';
				$data['modal'] = 'modal_add_categoria';

				$fields = array('id_usuario' => $this->session->userdata('id') );
				$data['proyecto'] = $this->model_project->get_project($fields);

				if ($data['proyecto'])
				{
					$fields = array('id_proyecto' => $data['proyecto']->id );
					$data['categoriasR'] = $this->model_memory->get_categories($fields);
					$data['categorias'] = $this->model_memory->categories($fields);
				}
				else
				{
					$fields = array('id_proyecto' => 0);
					$data['categorias']=$this->model_memory->categories($fields);
				}

				$this->load->view('hf/cabeza', $data);
				$this->load->view('cont/navbar');
				$this->load->view("cont/nav_proyecto");
				$this->load->view('cont/mem_costos');
				$this->load->view('hf/pie');
      }/*fin if form validation*/
      else
      {
      	//guardamos en la bd
      	$categoria = $this->input->post("categoria");
       	$fields = array('nombre' => $categoria , 'id_proyecto'=>$id_proyecto);

       	$insert=$this->model_memory->set_category($fields);

       	$msg = $insert?'<div class="exito">Concepto agregado</div>':'<div class="error">Ocurrio un problema, el concepto no se agrego, porfavor vuelve a intentarlo</div>';

        $this->session->set_flashdata('flash',$msg);

        redirect('memory_calc');
      } /*fin else form validation*/
    }/*fin if add_categoria*/
    else /*else add_categoria*/
    {
    	redirect('memory_calc');
    }	/*fin else add_categoria*/
	}

	/*vistas de mc */
	public function insert_memory_calc()  // no se que demonios es
	{
    $data['titulo'] = 'Registro de proyecto';

  	$fields = array('id_usuario' => $this->session->userdata('id') );
    $data['categorias']	=	$this->model_memory->get_categories($fields);

    $fields = array( '' => 1, '' => 1 );
    $data['agroquimicos']	=	$this->model_memory->get_cpto_memoria($fields);

    $fields = array( '' => 1, '' => 2 );
    $data['fertilizantes']	=	$this->model_memory->get_cpto_memoria($fields);

    $fields = array( '' => 1, '' => 3 );
    $data['preparacion']	=	$this->model_memory->get_cpto_memoria($fields);

    $fields = array( '' => 1, '' => 1 );
    $data['mano'] = $this->model_memory->get_cpto_memoria($fields);

		$arrayName = (object) array('id' => 0,'categoria' => "", 'nombre' => "",'unidad_medida' => "",'volumen' => "",'costo_unitario' => "");
		$data['cpto'] = $arrayName;
   
    $this->load->view('hf/cabeza', $data);
    $this->load->view('cont/navbar');
    $this->load->view('cont/pro_reg');
    $this->load->view('hf/pie');
  }

	public function insert_concept_mc() //listo
	{
		if($this->input->post('add_concepto'))
    {
    	
    	//aplicamos las reglas para validar los datos
      $this->form_validation->set_rules('categoria', 'Categoria', 'required');
      $this->form_validation->set_rules('concepto', 'Concepto', 'required');
      $this->form_validation->set_rules('unidad_medida', 'Unidad de medida', 'required');
      $this->form_validation->set_rules('volumen', 'Volumen', 'required|numeric');
      $this->form_validation->set_rules('costo_unitario', 'Costo unitario', 'required|numeric');
      //personalizacion de los mensajes de validadcion
      $this->form_validation->set_message('required', '%s es un campo requerido');
      $this->form_validation->set_message('numeric', '%s es un campo numerico');
      //personalizacion de los delimitadores de validacion
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      //verificamos que los campos cumplan con la verificacion
      if ($this->form_validation->run() == FALSE)
      {
      	$data['titulo'] = 'Alumno:Proyecto';
      	$fields = array('id_usuario' => $this->session->userdata('id') );
				$data['proyecto'] = $this->model_project->get_project($fields);

				if ($data['proyecto'])
				{
					$fields = array('id_proyecto' => $data['proyecto']->id );
					$data['categoriasR']=$this->model_memory->get_categories($fields);
					$data['categorias']=$this->model_memory->categories($fields);
				}
				else
				{
					$fields = array('id_proyecto' => 0 );
					$data['categorias']=$this->model_memory->categories($fields);
				}

				$data['modal'] = 'modal_add_concepto';
				$this->load->view('hf/cabeza', $data);
				$this->load->view('cont/navbar');
				$this->load->view("cont/nav_proyecto");
				$this->load->view('cont/mem_costos');
				$this->load->view('hf/pie');

      }/*fin form validation*/
      else /*else form validation*/
      {
      	//guardamos en la bd
      	$fields = array('id_usuario' => $this->session->userdata('id') );
      	$data['proyecto'] = $this->model_project->get_project($fields);

      	//guardamos los datos del formulario
	    	$id_categoria=$this->input->post("categoria");
	    	$nombre_concepto=$this->input->post("concepto");
	    	$unidad_medida=$this->input->post("unidad_medida");
	    	$volumen = $this->input->post("volumen");
	    	$costo_unitario=$this->input->post("costo_unitario");
      	
      	//public function set_concept_memory($id_proyecto,$categoria,$concepto,$unidad_medida,$volumen,$costo_unitario)
      	$fields = array(
      		'id_categoria' => $id_categoria, //id de la categoria
      		'nombre' => $nombre_concepto,
      		'unidad_medida' => $unidad_medida,
      		'volumen' => $volumen,
      		'costo_unitario' => $costo_unitario,
      		'id_proyecto' => $data['proyecto']->id
      	);

      	$insert = $this->model_memory->set_concept_memory($fields);

      	$msg = $insert?'<div class="exito">Concepto agregado</div>':'<div class="error">Ocurrio un problema, el concepto no se agrego, porfavor vuelve a intentarlo</div>';
      	$this->session->set_flashdata('flash', $msg);

      	redirect('memory_calc');
      }/*fin else form validation*/
    }
    else /*else add_concepto*/
    {
    	redirect('memory_calc');
    }
	}

	public function delete_mc()  //listo
	{
		if($this->input->post('del_categoria'))
		{
			$id = $this->input->post("eli");
			$fields = array('id_categoria' => $id);
			$insert = $this->model_memory->delete_category($fields);

			$msg = $insert?'<div class="exito">Categoria eliminada</div>':'<div class="error">Ocurrio un problema, la categoria no se elimino, porfavor vuelva a intentarlo</div>';

    	$this->session->set_flashdata('flash',$msg);
    	redirect('memory_calc');
		}
		else if($this->input->post('del_concepto'))
		{
			$id = $this->input->post("eli");
			$fields = array('id' => $id );
			$insert = $this->model_memory->delete_concept_memory($fields);
			$msg = $insert?'<div class="exito">Concepto Eliminado</div>':'<div class="error">Ocurrio un problema, el concepto no se elimino, porfavor vuelva a intentarlo</div>';
			$this->session->set_flashdata('flash',$msg);
      redirect('memory_calc');
		}
		else
		{
			redirect('memory_calc');
		}
	}

	public function update_concept_mc($id)
	{
		if ($this->input->post('upd_cpto'))
		{
    	//aplicamos las reglas para validar los datos
      $this->form_validation->set_rules('categoria_udp', 'Categoria', 'required');
      $this->form_validation->set_rules('concepto_udp', 'Concepto', 'required');
      $this->form_validation->set_rules('unidad_medida_udp', 'Unidad de medida', 'required');
      $this->form_validation->set_rules('volumen_udp', 'Volumen', 'required|numeric');
      $this->form_validation->set_rules('costo_unitario_udp', 'Costo unitario', 'required|numeric');
      //personalizacion de los mensajes de validadcion
      $this->form_validation->set_message('required', '%s es un campo requerido');
      $this->form_validation->set_message('numeric', '%s es un campo numerico');
      //personalizacion de los delimitadores de validacion
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	    //verificamos que los campos cumplan con la verificacion
	    if ($this->form_validation->run() == FALSE)
      {
				$data['titulo'] = 'Alumno:Proyecto';
				$fields = array('id_usuario' => $this->session->userdata('id') );
				$data['proyecto'] = $this->model_project->get_project($fields);
				if ($data['proyecto'])
				{
					$fields = array('id_proyecto' => $data['proyecto']->id);
					$data['categoriasR']=$this->model_memory->get_categories($fields);
					$data['categorias']=$this->model_memory->categories($fields);
				}
				else
				{
					$fields = array('id_proyecto' => 0);
					$data['categorias']=$this->model_memory->categories($fields);
				}
			  
			  $arrayName = (object) array('id'=>$id,'categoria' => "", 'nombre' => "",'unidad_medida' => "",'volumen' => "",'costo_unitario' => "");

			  $data['cpto']= $arrayName;

				$data['modal'] = 'modal_upd_concepto';
				$this->load->view('hf/cabeza', $data);
				$this->load->view('cont/navbar');
				$this->load->view("cont/nav_proyecto");
				$this->load->view('cont/mem_costos');
				$this->load->view('hf/pie');
      } /* fin if form validation */
      else /*else form validation*/
      {
      	//guardamos los datos del formulario
		  	$categoria=$this->input->post("categoria_udp");
		  	$nombre=$this->input->post("concepto_udp");
		  	$unidad_medida=$this->input->post("unidad_medida_udp");
		  	$volumen=$this->input->post("volumen_udp");
		  	$costo_unitario=$this->input->post("costo_unitario_udp");
      	
      	//modificamos en la bd
      	$fields = array(
      		'id' => $id,
      		'categoria_id' => $categoria, /*id en tabla*/
      		'nombre' => $nombre,
      		'unidad_medida' => $unidad_medida,
      		'volumen' => $volumen,
      		'costo_unitario' => $costo_unitario
      	);
      	
      	$insert = $this->model_memory->update_concept($fields);

      	$msg = $insert?'<div class="exito">Concepto agregado</div>':'<div class="error">Ocurrio un problema, el concepto no se agrego, porfavor vuelve a intentarlo</div>';
      	$this->session->set_flashdata('flash', $msg);
      	redirect('memory_calc');
      } /* fin else form validation */
		} /*fin if update concepto*/
		else // else update concepto 
		{
			$data['modal']= 'modal_upd_concepto';
			$data['titulo'] = 'Alumno:Proyecto';
			$fields = array('id_usuario' => $this->session->userdata('id') );
			$data['proyecto'] = $this->model_project->get_project($fields);

			if ($data['proyecto'])
			{
				$fields = array('id_proyecto' => $data['proyecto']->id);
				$data['categoriasR']=$this->model_memory->get_categories($fields);
				$data['categorias']=$this->model_memory->categories($fields);
			}
			else
			{
				$fields = array('id_proyecto' => 0);
				$data['categorias'] = $this->model_memory->categories($fields);
			}

			$fields = array('id' => $id );
			$data['cpto']=$this->model_memory->get_concept($fields);

			$this->load->view('hf/cabeza', $data);
			$this->load->view('cont/navbar');
			$this->load->view("cont/nav_proyecto");
			$this->load->view('cont/mem_costos');
			$this->load->view('hf/pie');
		}  //fin else update concepto 
	}
}
	
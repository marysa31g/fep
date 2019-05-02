<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projection_costs extends CI_Controller
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

		//echo "<pre>".print_r($data['proyecto'], true)."";

		if ($data['proyecto'])
		{
			$fields = array('id_proyecto' => $data['proyecto']->id);
			$data['conceptos'] = $this->model_projection->get_cptos($fields);
			$fields = array('id_proyecto' => $data['proyecto']->id );
			$data['categorias']=$this->model_memory->get_categories($fields);
		}
		else
		{
			$fields = array('id_proyecto' => 0 );
			$data['conceptos'] = $this->model_projection->get_cpto($fields); #0
			$data['categorias'] = $this->model_memory->get_categories($fields); #0
		}

		$data['cpto'] = (object) array('id'=>"",'concepto' => "", 'nombre' => "",'unidad_medida' => "",'cantidad' => "",'costo_unitario' => "", 'frecuencia'=>"");

		$this->load->view('hf/cabeza', $data);
		$this->load->view('cont/navbar');
		$this->load->view("cont/nav_proyecto");
		$this->load->view('cont/proyeccion_costos');
		$this->load->view('hf/pie');
	}

	public function insert_concept() //listo
	{
		if($this->input->post('add_concepto'))
    {
    	//aplicamos las reglas para validar los datos
      $this->form_validation->set_rules('concepto', 'Concepto', 'required');
      $this->form_validation->set_rules('unidad_medida', 'Unidad de medida', 'required');
      $this->form_validation->set_rules('cantidad', 'Cantidad', 'required|numeric');
      $this->form_validation->set_rules('costo_unitario', 'Costo unitario', 'required|numeric');
      $this->form_validation->set_rules('frecuencia', 'Frecuencia', 'required|numeric');
      //personalizacion de los mensajes de validacion
      $this->form_validation->set_message('required', '%s es un campo requerido');
      $this->form_validation->set_message('numeric', '%s es un campo numerico');
      //personalizacion de los delimitadores de validacion
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      //verificamos que los campos cumplan con la verificacion
      if ($this->form_validation->run() == FALSE)
      {
      	$data['bandera_ins'] = 1;
				$data['titulo'] = 'Alumno:Proyecto';

				$fields = array('id_usuario' => $this->session->userdata('id'));
				$data['proyecto'] = $this->model_project->get_project($fields);

				if ($data['proyecto'])
				{
					$fields = array('id_proyecto' => $data['proyecto']->id );
					$data['conceptos']=$this->model_projection->get_cptos($fields);
					$data['categorias']=$this->model_memory->get_categories($fields);
				}
				else
				{
					$fields = array('id_proyecto' => 0 );
					$data['conceptos']=$this->model_projection->get_cpto($fields); #0
					$data['categorias']=$this->model_memory->get_categories($fields); #0
				}
				$fields = array('id_proyecto' => 0 );
				$data['cpto']= $this->model_projection->get_cptos($fields); #0

				$this->load->view('hf/cabeza', $data);
				$this->load->view('cont/navbar');
				$this->load->view("cont/nav_proyecto");
				$this->load->view('cont/proyeccion_costos');
				$this->load->view('hf/pie');
      }
      else
      {
      	//guardamos los datos del formulario
	    	$concepto=$this->input->post("concepto");
	    	$unidad_medida=$this->input->post("unidad_medida");
	    	$cantidad=$this->input->post("cantidad");
	    	$costo_unitario=$this->input->post("costo_unitario");
	    	$frecuencia=$this->input->post("frecuencia");

      	//guardamos en la bd
      	$fields = array('id_usuario' => $this->session->userdata('id') );
      	$proyecto=$this->model_project->get_project($fields);

      	$fields = array(
      		'id_proyecto' => $proyecto->id,
      		'concepto' => $concepto,
      		'unidad_medida' => $unidad_medida,
      		'cantidad' => $cantidad,
      		'costo_unitario' => $costo_unitario,
      		'frecuencia' => $frecuencia
      	);
      	$insert = $this->model_projection->set_cpto($fields);
      	$msg = $insert?'<div class="exito">Concepto agregado</div>':'<div class="error">Ocurrio un problema, el concepto no se agrego, porfavor vuelve a intentarlo</div>';
      	$this->session->set_flashdata('flash',$msg);
      	redirect('projection_costs');
      }
    }
    else
      redirect('projection_costs');
	}

	public function delete_concept()
	{
		if($this->input->post('del_concepto'))
		{
			$fields = array('id' => $this->input->post("eli") );
			$insert=$this->model_projection->del_cpto($fields);

			$msg = $insert?'<div class="exito">Concepto Eliminado</div>':'<div class="error">Ocurrio un problema, el concepto no se elimino, porfavor vuelva a intentarlo</div>';
      $this->session->set_flashdata('flash', $msg);
      redirect('projection_costs');
		}
	}

	public function update_concept($id) //listo
	{
		if ($this->input->post('upd_cpto'))
		{
    	//aplicamos las reglas para validar los datos
      $this->form_validation->set_rules('concepto_upd', 'Concepto', 'required');
      $this->form_validation->set_rules('unidad_medida_upd', 'Unidad de medida', 'required');
      $this->form_validation->set_rules('cantidad_upd', 'Cantidad', 'required|numeric');
      $this->form_validation->set_rules('costo_unitario_upd', 'Costo unitario', 'required|numeric');
      $this->form_validation->set_rules('frecuencia_upd', 'Frecuencia', 'required|numeric');
      //personalizacion de los mensajes de validacion
      $this->form_validation->set_message('required', '%s es un campo requerido');
      $this->form_validation->set_message('numeric', '%s es un campo numerico');
      //personalizacion de los delimitadores de validacion
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      //verificamos que los campos cumplan con la verificacion
      if ($this->form_validation->run() == FALSE)
      {
				$data['modal']= 'modal_upd_concepto';
				$data['titulo'] = 'Alumno:Proyecto';

				$fields = array('id_usuario' => $this->session->userdata('id') );
				$data['proyecto'] = $this->model_project->get_project($fields);

				if ($data['proyecto'])
				{
					$fields = array('id_proyecto' => $data['proyecto']->id );
					$data['conceptos']=$this->model_projection->get_cptos($fields);
					$data['categorias']=$this->model_memory->get_categories($fields);
				}
				else
				{
					$fields = array('id_proyecto' => 0 );
					$data['conceptos']=$this->model_projection->get_cpto($fields); //0
					$data['categorias']=$this->model_memory->get_categories($fields); //0
				}

				$data['cpto']= (object) array('id'=>$data['proyecto']->id,'concepto' => "", 'nombre' => "",'unidad_medida' => "",'cantidad' => "",'costo_unitario' => "", 'frecuencia'=>"");
				
				$this->load->view('hf/cabeza', $data);
				$this->load->view('cont/navbar');
				$this->load->view("cont/nav_proyecto");
				$this->load->view('cont/proyeccion_costos');
				$this->load->view('hf/pie');
      }
      else // else del form validation (datos corerectod)
      {
      	$fields = array('id_usuario' => $this->session->userdata('id') );
				$data['proyecto'] = $this->model_project->get_project($fields);
      	//guardamos los datos del formulario
	    	$concepto = $this->input->post("concepto_upd");
	    	$unidad_medida = $this->input->post("unidad_medida_upd");
	    	$cantidad = $this->input->post("cantidad_upd");
	    	$costo_unitario = $this->input->post("costo_unitario_upd");
	    	$frecuencia = $this->input->post("frecuencia_upd");

      	//modificamos en la bd
				$fields = array(
      		//'id_proyecto' => $proyecto->id,
      		'id_proyecto' => $data['proyecto']->id,
      		'concepto' => $concepto,
      		'unidad_medida' => $unidad_medida,
      		'cantidad' => $cantidad,
      		'costo_unitario' => $costo_unitario,
      		'frecuencia' => $frecuencia
      	);

      	$insert = $this->model_projection->upd_cpto($fields);

      	$msg = $insert?'<div class="exito">Concepto modificado</div>':'<div class="error">Ocurrio un problema, el concepto no se agrego, porfavor vuelve a intentarlo</div>';
      	$this->session->set_flashdata('flash',$msg);
      	//echo "<pre>".print_r($fields, 1)."</pre>";
      	redirect('projection_costs');
      }
		}
		else //else del boton input upd cpto
		{
			$data['modal']='modal_upd_concepto';
			$data['titulo'] = 'Alumno:Proyecto';

			$fields = array('id_usuario' => $this->session->userdata('id') );
			$data['proyecto'] = $this->model_project->get_project($fields);

			if ($data['proyecto'])
			{
				$fields = array('id_proyecto' => $data['proyecto']->id);

				$data['conceptos'] = $this->model_projection->get_cptos($fields);
				$data['categorias'] = $this->model_memory->get_categories($fields);
			}
			else
			{
				$fields = array('id_proyecto' => 0 );
				$data['conceptos']=$this->model_projection->get_cpto($fields);
				$data['categorias']=$this->model_memory->get_categories($fields);
			}
		  
		  $fields = array('id' => $id );
		  $data['cpto']=$this->model_projection->get_cpto($fields);

			$this->load->view('hf/cabeza', $data);
			$this->load->view('cont/navbar');
			$this->load->view("cont/nav_proyecto");
			$this->load->view('cont/proyeccion_costos');
			$this->load->view('hf/pie');
		}
	}
}
	
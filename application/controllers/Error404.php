<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller
{
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
    //codigo para el error de sesion
    if ($this->session->userdata('logueado') == TRUE)
    {
      $this->session->set_flashdata('flash', '<div class="error">No encontrado</div>');
      redirect('');
    }
    else
    {
      $this->session->set_flashdata('flash', '<div class="error">No se ha iniciado la sesion</div>');
      redirect('');
    }
  }

}

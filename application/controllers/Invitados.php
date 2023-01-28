<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invitados extends CI_Controller{
	

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url","language");
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->model('Ion_auth_model');
		$this->load->model('traza_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		
	}

	public function index(){
      $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      $data['success_message'] = $this->session->flashdata('success_message');
      
        $this->load->view('head');
        $this->load->view('invitados',$data);
        $this->load->view('footer');
	}
}
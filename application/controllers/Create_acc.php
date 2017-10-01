<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_acc extends MY_Controller {

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper( array('form', 'url') );
		$this->load->library( array('form_validation', 'session') );
		$this->load->model('Users_model');

		$this->require_logout();

		$this->data['css_includes'] = array('form', 'main');
		$this->data['title'] = "Create Account";
		$this->data['bottom'] = array('title' => 'Login', 'uri' => 'login');
	}

	public function index()
	{

		// load view

		$this->load->view('templates/head', $this->data);
		$this->load->view('create_acc', $this->data);
		$this->load->view('templates/foot', $this->data);

	}

	public function process()
	{
		if( empty( $this->input->post('submit') ) )
		{
			redirect('craete_acc');
			die();
		}
		else
		{
			$this->form_validation->set_message('required', '{field} is required');
      $this->form_validation->set_message('max_length', '{field} must be less than {param} characters');
      $this->form_validation->set_message('min_length', '{field} must be greater than {param} characters');
      $this->form_validation->set_message('valid_email', 'Invalid email');
      $this->form_validation->set_message('is_unique', '{field} is taken');

      $this->form_validation->set_rules('firstname', 'First Name', 'required|max_length[20]|alpha');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required|max_length[30]|alpha');
      $this->form_validation->set_rules('email', 'Email', 'valid_email');
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/head', $this->data);
				$this->load->view('create_acc', $this->data);
				$this->load->view('templates/foot', $this->data);
			}
			else
			{
        echo "success";
			}
		}
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper( array('form', 'url') );
		$this->load->library( array('form_validation', 'session') );
		$this->load->model('Users_model');

		$this->require_logout();

		$this->data['css_includes'] = array('form', 'main');
		$this->data['title'] = "Login";
		$this->data['bottom'] = array('title' => 'Create Account', 'uri' => 'create_acc');
	}

	public function index()
	{

		// load view

		$this->load->view('templates/head', $this->data);
		$this->load->view('login', $this->data);
		$this->load->view('templates/foot', $this->data);

	}

	public function process()
	{
		if( empty( $this->input->post('submit') ) )
		{
			redirect('login');
			die();
		}
		else
		{
			$this->form_validation->set_message('required', '{field} is required');
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/head', $this->data);
				$this->load->view('login', $this->data);
				$this->load->view('templates/foot', $this->data);
			}
			else
			{

				if( $user = $this->Users_model->valid_user( $this->input->post('username'), $this->input->post('password') ) )
				{
					$this->session->user_id = $user;
					redirect('main');
				}

				else
				{
					$this->data['user_err'] = "Invalid username/password";
					$this->load->view('templates/head', $this->data);
					$this->load->view('login', $this->data);
					$this->load->view('templates/foot', $this->data);
				}
			}
		}
	}

}

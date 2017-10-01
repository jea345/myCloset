<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends MY_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->helper( array('form', 'url') );
		$this->load->library( array('form_validation', 'session') );

    $this->require_login();
  }

  public function index()
  {

    $data['css_includes'] = array('form', 'main');
		$data['title'] = "Add Clothes";
    $data['bottom'] = array('title' => 'Back', 'uri' => 'main');

    $this->load->view('templates/head', $data);

		// form validation

		$this->form_validation->set_message('required', '{field} is required');
    $this->form_validation->set_message('max_length', '{field} cannot exceed {param} characters');
		$this->form_validation->set_rules('name', 'name', array('required', 'max_length[20]') );
		$this->form_validation->set_rules('category', 'category', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('main/add_clothing', $data);
		}
    else
    {
      $this->load->library('upload');

      $config['upload_path']          = './images/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 100;
      $config['max_width']            = 3000;
      $config['max_height']           = 3000;

      $this->upload->initialize($config);

      if ( !$this->upload->do_upload('image') )
      {
        $error = array('error' => $this->upload->display_errors());

        $this->load->view('main/add_clothing', $error);
      }
      else
      {
        echo "Success";
      }
    }

    $this->load->view('templates/foot');

  }


}

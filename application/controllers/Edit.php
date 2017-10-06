<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends MY_Controller {

    public $data;

    public function __construct()
    {
      parent::__construct();

      $this->load->helper( array('form', 'url') );
  		$this->load->library( array('form_validation', 'session') );

      $this->require_login();

      $this->data['css_includes'] = array('form', 'main');
      $this->data['title'] = "Edit Clothes";
      $this->data['bottom'] = array('title' => 'Back', 'uri' => 'main');

      $this->load->model('Clothes_model');


    }

    public function clothing($id)
    {
      $name = $this->input->post('name');
      $category = $this->input->post('category');

      $this->load->view('templates/head', $this->data);

  		// form validation

  		$this->form_validation->set_message('required', '{field} is required');
      $this->form_validation->set_message('max_length', '{field} cannot exceed {param} characters');
  		$this->form_validation->set_rules('name', 'name', array('required', 'max_length[20]') );
  		$this->form_validation->set_rules('category', 'category', 'required');

  		if($this->form_validation->run() == FALSE)
  		{
        if( $item = $this->Clothes_model->get_where_id($id) !== FALSE)
        {
          var_dump($item);
          $this->data['item_name'] = $item->name;
          $this->data['item_category'] = $item->category;
          $this->data['item_id'] = $item->id;


          if( !empty( $item->picture_id ) )
          {
            $this->data['item_picture'] = TRUE;
          }

          $this->load->view('main/edit_clothing', $this->data);
        }
        else
        {
          redirect('main');
          die();
        }
  		}
      elseif ( $_FILES && $_FILES['image']['name'] )
      {
        $this->load->library('upload');

        $config['upload_path']          = './images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['encrypt_name']         = TRUE;

        $this->upload->initialize($config);

        if ( !$this->upload->do_upload('image') )
        {
          $this->data['upload_error'] = $this->upload->display_errors('<h3 class="error">', '</h3>');

          $this->load->view('main/edit_clothing', $this->data);
        }
        else
        {
          $picture_id = $this->upload->data('file_name');

          $this->Clothes_model->edit($id, $name, $category, $picture_id);
          redirect('main');
          die();
        }
      }
      else
      {
        $this->Clothes_model->edit($id, $name, $category);
        redirect('main');
        die();
      }

      $this->load->view('templates/foot');

    }


}

?>

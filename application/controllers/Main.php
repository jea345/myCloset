<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Main extends MY_Controller {

  public $data;

  public function __construct()
  {
    parent::__construct();
    $this->require_login();

    $this->load->model('Clothes_model');

    $this->data['css_includes'] = array('main');
    $this->data['title'] = "My Clothes";
    $this->data['bottom'] = array('title' => 'Logout', 'uri' => 'logout');

    $this->clothing_arr = $this->Clothes_model->get_by_type();

    $this->data['clothing_arr'] = $this->clothing_arr;
  }

  public function index()
  {
    // load view

		$this->load->view('templates/head', $this->data);
    $this->load->view('main/nav', $this->data);
    $this->load->view('main/default', $this->data);
    $this->load->view('templates/foot', $this->data);
  }

  public function selected($category, $index)
  {
    $item = $this->clothing_arr[$category][$index];

    if( isset( $item ) )
    {
      if( isset( $item['picture_id'] ) )
      {
        $this->data['img'] = $item['picture_id'];
      }

      $this->data['selected'] = $item['id'];

      $this->load->view('templates/head', $this->data);
      $this->load->view('main/nav', $this->data);
      $this->load->view('main/clothing_info', $this->data);
      $this->load->view('templates/foot', $this->data);

    }
    else
    {
      redirect('main');
      die();
    }

  }

}

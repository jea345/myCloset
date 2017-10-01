<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Main extends MY_Controller {

  public $clothing_arr = array();
  public $data;

  public function __construct()
  {
    parent::__construct();
    $this->require_login();

    $this->load->model('Clothes_model');

    $this->data['css_includes'] = array('main');
    $this->data['title'] = "My Clothes";
    $this->data['bottom'] = array('title' => 'Logout', 'uri' => 'logout');

    foreach( $this->Clothes_model->get_by_type() as $clothing )
    {
      if( isset($this->clothing_arr[ $clothing->category ]) )
      {
        array_push($this->clothing_arr[ $clothing->category ], array('id' => $clothing->id, 'name' => $clothing->name, 'picture_id' => $clothing->picture_id));
      }
      else
      {
        $this->clothing_arr[ $clothing->category ] = array( array('id' => $clothing->id, 'name' => $clothing->name, 'picture_id' => $clothing->picture_id) );
      }

    }


    $this->data['clothing_arr'] = $this->clothing_arr;
  }

  public function index()
  {
    // load view

		$this->load->view('templates/head', $this->data);
    $this->load->view('main/nav', $this->data);
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

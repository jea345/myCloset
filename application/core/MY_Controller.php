<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class MY_Controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->library('session');
    $this->load->helper('url');

  }

  public function require_login()
  {
    if( !isset($this->session->user_id) )
    {
      redirect('login');
      die();
    }
  }

  public function require_logout()
  {
    if( isset($this->session->user_id) )
    {
      redirect('main');
      die();
    }
  }



}

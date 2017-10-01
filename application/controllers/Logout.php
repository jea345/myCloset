<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->require_login();
    
    session_destroy();

    redirect('login');
    die();
  }


}

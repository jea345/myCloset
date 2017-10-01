<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clothes_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
  }

  public function get_by_type()
  {
    $this->db->order_by('category', 'DESC');
    $query = $this->db->get_where( 'clothes', array('user_id' => $this->session->user_id) );


    return $query->result();

  }
}

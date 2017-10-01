<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

  function valid_user($username, $password)
  {
    $query = $this->db->get_where('users', array('username' => $username ) );

    if( !empty($query->result()) )
    {
      if( password_verify($password, $query->result()[0]->password) )
      {
        return $query->result()[0]->id;
      }
      else
      {
        return FALSE;
      }
    }
    else
    {
      return FALSE;
    }

  }

}

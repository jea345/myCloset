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

    $clothing_arr = array();

    foreach( $query->result() as $clothing )
    {
      if( isset($clothing_arr[ $clothing->category ]) )
      {
        array_push($clothing_arr[ $clothing->category ], array('id' => $clothing->id, 'name' => $clothing->name, 'picture_id' => $clothing->picture_id));
      }
      else
      {
        $clothing_arr[ $clothing->category ] = array( array('id' => $clothing->id, 'name' => $clothing->name, 'picture_id' => $clothing->picture_id) );
      }

      sort( $clothing_arr[ $clothing->category ] );
    }

    uksort( $clothing_arr, [ $this, '_cat_cmp' ] );


    return $clothing_arr;

  }

  public function get_where_id($id)
  {
    $query = $this->db->get_where( 'clothes', array('id' => $id, 'user_id' => $this->session->user_id) );

    return ( !empty( $query->result() ) ) ? $query->result() : FALSE;

  }

  public function insert($name, $category, $picture_id = NULL)
  {
    $data = array(
        'name' => $name,
        'category' => $category,
        'user_id' => $this->session->user_id
    );

    if( !empty($picture_id) )
    {
      $data['picture_id'] = $picture_id;
    }

    $this->db->insert('clothes', $data);

  }

  public function delete($id)
  {
    $this->db->delete( 'clothes', array('id' => $id) );
  }

  public function delete_image($id)
  {
    $this->db->where( array('id' => $id, 'user_id' => $this->session->user_id) );
    $this->db->update('clothes', array ('picture_id' => NULL) );
  }

  public function edit($id, $name, $category, $picture_id = NULL)
  {
    $data = array(
        'name' => $name,
        'category' => $category,
    );

    if( !empty($picture_id) )
    {
      $data['picture_id'] = $picture_id;
    }

    $this->db->where( array('id' => $id, 'user_id' => $this->session->user_id) );
    $this->db->update('clothes', $data);

  }

  private function _cat_cmp($a, $b)
  {
    if ( $a == $b ) { return 0; }

    $order = array("outerwear", "tops", "bottoms", "footwear", "underwear", "accessories", "other");

    $position = array_search( $a, $order );
    $position2 = array_search( $b, $order );

    if ( $position2 !== false && $position !== false ) { return ( $position < $position2 ) ? -1 : 1; }

    if( $position !== false ) { return -1; }
    if( $position2 !== false ) { return 1; }

    return ( $a < $b ) ? -1 : 1;
  }

}

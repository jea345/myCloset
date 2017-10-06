<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends MY_Controller {

  public function clothing($id)
  {
    $this->load->model('Clothes_model');
    $this->Clothes_model->valid_id($id);

    unlink(FCPATH . 'images/' . $this->Clothes_model->get_where_id($id)[0]->picture_id );

    $this->Clothes_model->delete($id);

    redirect('main');
    die();
  }

  public function clothing_image($id)
  {
    $this->load->model('Clothes_model');
    $this->Clothes_model->valid_id($id);

    unlink(FCPATH . 'images/' . $this->Clothes_model->get_where_id($id)[0]->picture_id );

    $this->Clothes_model->delete_image($id);

    redirect('edit/clothing/' . $id);
    die();

  }

}

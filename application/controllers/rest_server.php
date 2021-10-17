<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries\RestController.php';
use chriskacerguis\RestServer\RestController;

class rest_server extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data
    function index_get() {
      $id = $this->get('id');
      if ($id == '') {
        $member = $this->db->get('member')->result();
      } else {
        $this->db->where('id', $id);
        $member = $this->db->get('member')->result();
      }
      $this->response($member, 404); 
        $this->response($member, 200);
      }

      function index_post() {
           $data = array(
                       'id'  => $this->post('id'),
                       'nama_member'  => $this->post('nama_member'),
                       'email'  => $this->post('email'),
                       'no_telp'    => $this->post('no_telp'));
           $insert = $this->db->insert('member', $data);
           if ($insert) {
               $this->response($data, 200);
           } else {
               $this->response(array('status' => 'fail', 502));
           }
       }
     
   }
   function index_put() {
    $id = $this->put('id');
    $data = array(
                'id'   => $this->put('id'),
                'nama_member'  => $this->put('nama_member'),
                'email'  => $this->put('email'),
                'no_telp'  => $this->put('no_telp'));
    $this->db->where('id', $id);
    $update = $this->db->update('member', $data);
    if ($update) {
        $this->response($data, 200);
    } else {
        $this->response(array('status' => 'fail', 502));
    }
}

function index_delete() {
  $id = $this->delete('id');
  $this->db->where('id', $id);
  $delete = $this->db->delete('member');
  if ($delete) {
      $this->response(array('status'=>'sukses'), 200);
  } else {
      $this->response(array('status' => 'gagal', 502));
  }
}


?> 
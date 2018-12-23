<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModels extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

// добавление box
    public function addBox($d)
    {
        $string = array(
            'title' => $d['name'],
            'weight' => $d['weight'],
            'price' => $d['price'],
            'img_name' => $d['imgname'],
        );
        $this->db->insert('box', $string);
        return $this->db->insert_id();
    }

}
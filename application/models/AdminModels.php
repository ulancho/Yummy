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
    public function add_box_composition($arr){
        for($i=0;count($arr)>$i;$i++ ){
            $child=array(
                'title' =>$arr[$i]['title'],
                'id_box' =>$arr[0]['box_id']
            );
            $this->db->insert('box_composition',$child);
        }
    }
// Select ALL
    public function selectAll($table, $num = null, $offset = null)
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table, $num, $offset);
        return $query->result();
    }
    // Select with where po id
    public function getId($tablename, $id)
    {
        $sql = "SELECT * FROM $tablename WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    // Удаление изобр из папки
    private function deleteFiles($name, $puth)
    {
        return unlink(FCPATH . "public/images/$puth/" . $name);
    }

// Delete по id и tablename
    public function deleteOne($table, $id, $puth = '')
    {
        $con = $this->getId($table, $id);
        $name = $con->img_name;
        $this->db->where('id', $id);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            $this->deleteFiles($name,$puth);
            return TRUE;
        } else {
            return FAlSE;
        }
    }
}
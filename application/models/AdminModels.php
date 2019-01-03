<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModels extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function getBoxComposition($id_box) {
        $box_composition = [];
        $query = $this->db->query("SELECT * FROM box_composition WHERE id_box = $id_box");
        foreach ($query->result_array() as $row) {
            $box_composition[] = $row;
        }

        return $box_composition;
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
    // добавление Фруктов
    public function addFruits($d)
    {
        $string = array(
            'name' => $d['name'],
            'weight' => $d['weight'],
            'price' => $d['price'],
            'img_name' => $d['imgname'],
        );
        $this->db->insert('fruits', $string);
        return $this->db->insert_id();
    }

    // добавление овощи
    public function addVegetable($d)
    {
        $string = array(
            'name' => $d['name'],
            'weight' => $d['weight'],
            'price' => $d['price'],
            'img_name' => $d['imgname'],
        );
        $this->db->insert('vegetables', $string);
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

    public function updateBox($arr){
        if (isset($arr['imgname'])){
            $data = array(
                'title' => $arr['name'],
                'price' => $arr['price'],
                'weight' => $arr['weight'],
                'img_name' => $arr['imgname']
            );
        }
        else{
            $data = array(
                'title' => $arr['name'],
                'price' => $arr['price'],
                'weight' => $arr['weight'],
            );
        }

        $this->db->where('id', $arr['id']);
        $this->db->update('box', $data);

        $success = $this->db->affected_rows();

        if (!$success) {
            return false;
        } else {
            return true;
        }
    }

    public function update_composition($da){
        for($i=0;count($da)>$i;$i++ ){
            $data=array(
                'title' =>$da[$i]['title'],
            );
            $id = $da[$i]['id'];
            $this->db->where('id', $id);
            $this->db->update('box_composition', $data);
        }
        $success = $this->db->affected_rows();

        if (!$success) {
            return false;
        } else {
            return true;
        }
    }

    public function updateFrVg($table,$arr){
        if (isset($arr['imgname'])){
            $data = array(
                'name' => $arr['name'],
                'price' => $arr['price'],
                'weight' => $arr['weight'],
                'img_name' => $arr['imgname']
            );
        }
        else{
            $data = array(
                'name' => $arr['name'],
                'price' => $arr['price'],
                'weight' => $arr['weight'],
            );
        }

        $this->db->where('id', $arr['id']);
        $this->db->update($table, $data);

        $success = $this->db->affected_rows();

        if (!$success) {
            return false;
        } else {
            return true;
        }

    }

    public function addNews($d){
        $string = array(
            'title' => $d['name'],
            'text' => $d['text'],
            'title2' => $d['text2'],
            'img_name' => $d['imgname'],
        );
        $this->db->insert('news', $string);
        return $this->db->insert_id();
    }

    public function updateNews($arr){
        if (isset($arr['imgname'])){
            $data = array(
                'title' => $arr['name'],
                'text' => $arr['text'],
                'img_name' => $arr['imgname']
            );
        }
        else{
            $data = array(
                'title' => $arr['name'],
                'text' => $arr['text'],
            );
        }

        $this->db->where('id', $arr['id']);
        $this->db->update('news', $data);

        $success = $this->db->affected_rows();

        if (!$success) {
            return false;
        } else {
            return true;
        }
    }

    //Select ALL
    public function selectAll($table, $num = null, $offset = null)
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table, $num, $offset);
        return $query->result();
    }

    public function selectAllArray($table)
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table);
        return $query->result_array();
    }
    // Select with where po id
    public function getId($tablename, $id)
    {
        $sql = "SELECT * FROM $tablename WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    // Удаление изобр из папки
    public function deleteFiles($name, $puth)
    {
        return unlink(FCPATH . "public/images/$puth/" . $name);
    }

    // Delete по id и tablename
    public function deleteOne($table, $id, $puth = '')
    {
        $con = $this->getId($table, $id);
        $name = $con[0]->img_name;
        $this->db->where('id', $id);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            $this->deleteFiles($name,$puth);
            return TRUE;
        } else {
            return FAlSE;
        }
    }

    public function select(){
        $query = $this->db->query('SELECT * FROM box');
    }

    public function newsfour(){
        $query=$this->db->query('SELECT * FROM news LIMIT 4');
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
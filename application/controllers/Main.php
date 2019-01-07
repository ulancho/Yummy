<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->helper('html');
        $this->load->model('AdminModels');
        $this->load->database();
        header('Content-Type: text/html; charset=utf-8');
    }
    // отправка на почту
    private function send_mail($phone,$name='',$addres='' ,$zakaz=''){
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'yummyfruitkg@gmail.com';
        $config['smtp_pass']    = '123456ulan';
        $config['charset']    = 'utf-8';
       $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; //  html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $this->email->initialize($config);
        $this->email->from('yummyfruitkg@gmail.com', 'Заявки из сайта');
        $this->email->to('ulan.five@gmail.com');

        $this->email->subject('Заявка');
        if ($name=='' && $addres='' && $zakaz=''){
            $this->email->message('Телефон:' .$phone);
        }
        else{
            $this->email->message('Телефон:' .$phone. '<br>ИМЯ:'.$name. '<br>Адресс:' .$addres .'<br>заказ:'.$zakaz);
        }
        $this->email->send();
        //debugger
//        if (!$this->email->send()) {
//            show_error($this->email->print_debugger()); }
//        else {
//            echo 'ok!';
//        }
    }
    public function getBox() {

        $box = [];
        $querys = $this->db->query('SELECT * FROM box');
        foreach ($querys->result_array() as $row) {
            $box[] = $row;
        }

        return $box;
    }
    public function index()
    {
        $arr = $this->getBox();
        $data['box'] = $arr;
        $arr['noHomePage'] = 'm';
        $arr['bootstrap'] = '';
        $arr['none'] = 'l';

        $table = 'fruits';
        $cart['prod'] = $this->AdminModels->selectAllArray($table);
        $table2 = 'vegetables';
        $cart['prodvg'] = $this->AdminModels->selectAllArray($table2);

        $footer['news'] = $this->AdminModels->newsfour();
        $table3 = 'partners';
        $footer['partners'] =$this->AdminModels->selectAllArray($table3);

        $this->load->view('main/header',$arr);
        $this->load->view('main/index',$data);
        $this->load->view('main/bugaga',$cart);
        $this->load->view('main/footer',$footer);
    }
    public function cart(){
        $url = base_url();
        $arr = $this->getBox();
        foreach ($arr as $id){
            $cart['composition'][] = $this->AdminModels->getBoxComposition($id['id']);
        }
        $cart['box'] = $arr;
        $table = 'fruits';
        $cart['prod'] = $this->AdminModels->selectAllArray($table);

        $table2 = 'vegetables';
        $cart['prodvg'] = $this->AdminModels->selectAllArray($table2);

        $data['bootstrap'] = $url."public/css/bootstrap.min.css";
        $data['noHomePage'] = 'noHomePage';
        $data['none'] = 'l';

        $footer['news'] = $this->AdminModels->newsfour();
        $table3 = 'partners';
        $footer['partners'] =$this->AdminModels->selectAllArray($table3);

        $this->load->view('main/header',$data);
        $this->load->view('main/cart');
        $this->load->view('main/bugaga',$cart);
        $this->load->view('main/footer',$footer);
    }
    public function cart_proc(){
    $name = $this->input->post('name');
    $phone = $this->input->post('phone');
    $adress = $this->input->post('adress');
    $good = $this->input->post('good');
    $json_decode = json_decode($good);
    $total = $json_decode[0]->total;
    $count = count($json_decode)-1;
        $zakaz = '';
        for ($i = 1; $i <=$count; $i++) {
            $zakaz = $zakaz. '№'.$i.'название='.$json_decode[$i]->name.'; количество='.$json_decode[$i]->count.' шт/кг<br>';
        }
        $this->send_mail($phone,$name,$adress,$zakaz);
        $message = array(
            'total' => $total,
        );
        echo json_encode($message);

    }
    public function add_request(){
       $phone = $this->input->post('number');
        if(empty($phone)){
            $massiv['error'] = '1';
        }
        else{
            $phone = preg_replace('~\D+~','', $phone);
            $phone = strip_tags($phone);
            $this->send_mail($phone);
            $massiv['error'] = '0';
        }
        echo json_encode($massiv);
    }
    public function fruits(){
        $cart['box'] = $this->getBox();
        $table2 = 'vegetables';
        $cart['prodvg'] = $this->AdminModels->selectAllArray($table2);

        $table = 'fruits';
        $arr['prod'] = $this->AdminModels->selectAllArray($table);

        $data['noHomePage'] = 'noHomePage';
        $data['bootstrap'] = '';
        $arr['title'] = 'ФРУКТЫ';
        $data['none'] = 'l';
        $footer['news'] = $this->AdminModels->newsfour();
        $table3 = 'partners';
        $footer['partners'] =$this->AdminModels->selectAllArray($table3);

        $this->load->view('main/header',$data);
        $this->load->view('main/fruits',$arr);
        $this->load->view('main/bugaga',$cart);
        $this->load->view('main/footer',$footer);
    }
    public function vegetables(){
        $cart['box'] = $this->getBox();
        $table2 = 'fruits';
        $cart['prod'] = $this->AdminModels->selectAllArray($table2);

        $data['noHomePage'] = 'noHomePage';
        $data['bootstrap'] = '';
        $arr['title'] = 'ОВОЩИ';
        $data['none'] = 'l';
        $table = 'vegetables';
        $arr['prod'] = $this->AdminModels->selectAllArray($table);
        $footer['news'] = $this->AdminModels->newsfour();
        $table3 = 'partners';
        $footer['partners'] =$this->AdminModels->selectAllArray($table3);
        $this->load->view('main/header',$data);
        $this->load->view('main/fruits',$arr);
        $this->load->view('main/bugaga',$cart);
        $this->load->view('main/footer',$footer);
    }
    public function news(){
        $config['base_url'] = base_url() . 'Main/news/';
        $config['total_rows'] = $this->db->count_all('news');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['next_link'] = 'Следующая';
//        $config['next_tag_open'] = '<a href="#">';
//        $config['next_tag_close'] = '</a>';

        $config['prev_link'] = 'Предыдущая';
//        $config['prev_tag_open'] = '<a href="#">';
//        $config['prev_tag_close'] = '</a>';
        $config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        $table = 'news';
        $arr['news'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(3));




        $data['noHomePage'] = 'noHomePage';
        $data['bootstrap'] = '';
        $data['none'] = 'none';
        $table3 = 'partners';
        $footer['partners'] =$this->AdminModels->selectAllArray($table3);
        $footer['news'] = $this->AdminModels->newsfour();
        $this->load->view('main/header',$data);
        $this->load->view('main/news',$arr);
        $this->load->view('main/footer',$footer);
    }
    public function contacts(){
        $url = base_url();
        $data['noHomePage'] = 'noHomePage';
        $data['bootstrap'] = $url."public/css/bootstrap.min.css";
        $data['none'] = 'none';
        $this->load->view('main/header',$data);
        $this->load->view('main/contacts');
    }
    public function contactAction(){
        $name = $this->input->post('name');
        $phone = $this->input->post('phone_cont');
        $comm = $this->input->post('comments');
        if (empty($name)  || empty($phone) || empty($comm)){
            $massiv['error'] = '1';
        }
        else{
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'yummyfruitkg@gmail.com';
        $config['smtp_pass']    = '123456ulan';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; //  html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $this->email->initialize($config);
        $this->email->from('yummyfruitkg@gmail.com', 'Cообщение из сайта');
        $this->email->to('ulan.five@gmail.com');

        $this->email->subject('Из сайта');
        $this->email->message('Телефон:' .$phone. '<br>ИМЯ:'.$name. '<br>Собщ:' .$comm);
        $this->email->send();
        $massiv['error'] = '0';
        }
        echo json_encode($massiv);
    }

    public function oneNews($id){
        $table = 'news';
        $arr['news'] = $this->AdminModels->getId($table, $id);
        $data['noHomePage'] = 'noHomePage';
        $data['bootstrap'] = '';
        $data['none'] = 'none';
        $footer['news'] = $this->AdminModels->newsfour();
        $table3 = 'partners';
        $footer['partners'] =$this->AdminModels->selectAllArray($table3);
        $this->load->view('main/header',$data);
        $this->load->view('main/newsone',$arr);
        $this->load->view('main/footer',$footer);
    }

}
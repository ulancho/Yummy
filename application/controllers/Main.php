<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->helper('html');
        $this->load->model('AdminModels');
    }
    // отправка на почту
    private function send_mail($phone){
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'academybishkek@gmail.com';
        $config['smtp_pass']    = 'qwertyuiop6723233333';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; //  html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $this->email->initialize($config);
        $this->email->from('academybishkek@gmail.com', 'Заявки из сайта');
        $this->email->to('ulan.four@gmail.com');

        $this->email->subject('Заявка');
        $this->email->message('Телефон:' .$phone);
        $this->email->send();
//        if (!$this->email->send()) {
//            show_error($this->email->print_debugger()); }
//        else {
//            echo 'ok!';
//        }
    }


    public function index()
    {
//        $table = ''
//        $data['box'] = $this->AdminModels->selectAll($table);
        $this->load->view('main/header');
        $this->load->view('main/index');
        $this->load->view('main/footer');
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
}
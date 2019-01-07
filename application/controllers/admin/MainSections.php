<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainSections extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModels');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $arraydata = $this->session->userdata['login'];
        if (empty($arraydata)) {
            redirect(site_url() . 'admin/Admin_page/');
        }
    }

    //  Грузит страничку  коробки
    public function box()
    {
        $array['imgerror'] = '';
        $this->load->view('admin/header');
        $this->load->view('admin/navbar', $array);
        $this->load->view('admin/box');
        $this->load->view('admin/footer');
    }

    // для загрузки фото
    public function do_upload($location, $name)
    {
        $config['upload_path'] = './public/images/' . $location . '/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 1000;
        $config['max_width'] = 1000;
        $config['max_height'] = 1000;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($name)) {
            return array('error' => $this->upload->display_errors());
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }

    //  для добавления в бд коробки.
    public function addBox()
    {

        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[100]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 100 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('weight', 'role', 'required|trim',
            array('required' => 'Заполните.',
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $array['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $array);
            $this->load->view('admin/container');
            $this->load->view('admin/addBox');
            $this->load->view('admin/footer');
        } else {
            $array['name'] = $this->input->post('name');
            $array['weight'] = $this->input->post('weight');
            $array['price'] = $this->input->post('price');
            $location = 'main';
            $imgname = 'photo';
            $ph = $this->do_upload($location, $imgname);
            if (isset($ph['upload_data'])) {
                $array['imgname'] = $ph['upload_data']['file_name'];
                $addBox = $this->AdminModels->addBox($array);

                $child=array();
                for($i=0;count($_POST['composition'])>$i;$i++ ){
                    $child[]=array(
                        'title' =>$_POST['composition'][$i],
                        'box_id' => $addBox
                    );
                }
                $this->AdminModels->add_box_composition($child);

                // получить insert id и добавить
                if (!$addBox) {
                    $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                } else {
                    $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                }
                redirect(site_url() . 'admin/MainSections/addBox');

            } else {
                $array['imgerror'] = $ph['error'];
                $this->load->view('admin/header');
                $this->load->view('admin/navbar', $array);
                $this->load->view('admin/container');
                $this->load->view('admin/addBox');
                $this->load->view('admin/footer');
            }

        }


    }

    public function test(){
        $table = 'fruits';
        $id = 6;
        $result = $this->AdminModels->getid($table, $id);
        print_r($result[0]->img_name);
        die();

    }

    // для загрузки всех коробок
    public function allBox()
    {
        $config['base_url'] = base_url() . 'admin/MainSections/allBox/';
        $config['total_rows'] = $this->db->count_all('box');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'box';
        $data['sportpits'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allBox', $data);
        $this->load->view('admin/footer');
    }

    // для удаление одной коробки
    public function deleteBox($id)
    {
        $table = 'box';
        $puth = 'main';
        $result = $this->AdminModels->deleteOne($table, $id,$puth);
            $tables = 'box_composition';
            $this->db->where('id_box', $id);
            $this->db->delete($tables);
        if ($result == FALSE) {
            $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
        } else {
            $this->session->set_flashdata('success_message', 'Успешно удален!');

        }
        redirect(site_url() . 'admin/MainSections/allBox');
    }

    // для загрузки всех фруктов и овощей
    public function allFruits()
    {
        $config['base_url'] = base_url() . 'admin/MainSections/allFruits/';
        $config['total_rows'] = $this->db->count_all('fruits');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'fruits';
        $data['fruits'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));
        $data['title'] = 'Фрукты';
        $data['add'] = 'addFruits';
        $data['delete'] = 'deleteFruits';
        $data['update'] = 'updateFruits';

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allFruits', $data);
        $this->load->view('admin/footer');
    }

    // для добавления в бд фруктов.
    public function addFruits()
    {

        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[100]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 100 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('weight', 'role', 'required|trim',
            array('required' => 'Заполните.',
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $array['imgerror'] = '';
            $arr['form'] = 'addFruits';
            $arr['all'] = 'allFruits';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $array);
            $this->load->view('admin/container');
            $this->load->view('admin/addFruits',$arr);
            $this->load->view('admin/footer');
        } else {
            $array['name'] = $this->input->post('name');
            $array['weight'] = $this->input->post('weight');
            $array['price'] = $this->input->post('price');
            $location = 'fruits';
            $imgname = 'photo';
            $ph = $this->do_upload($location, $imgname);
            if (isset($ph['upload_data'])) {
                $array['imgname'] = $ph['upload_data']['file_name'];
                $addBox = $this->AdminModels->addFruits($array);
                if (!$addBox) {
                    $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                } else {
                    $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                }
                redirect(site_url() . 'admin/MainSections/addFruits');

            } else {
                $array['imgerror'] = $ph['error'];
                $this->session->set_flashdata('danger_message', 'Слишком большая картина! 1000x1000');
                redirect(site_url() . 'admin/MainSections/addFruits');
            }

        }


    }

    public function deleteFruits($id){
        $table = 'fruits';
        $puth = "fruits";
        $result = $this->AdminModels->deleteOne($table, $id,$puth);
        if ($result == FALSE) {
            $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
        } else {
            $this->session->set_flashdata('success_message', 'Успешно удален!');

        }
        redirect(site_url() . 'admin/MainSections/allFruits');
    }

    public function allVege(){
        $config['base_url'] = base_url() . 'admin/MainSections/allVege/';
        $config['total_rows'] = $this->db->count_all('vegetables');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'vegetables';
        $data['fruits'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));
        $data['title'] = 'Овощи';
        $data['add'] = 'addVegetable';
        $data['delete'] = 'deleteVegetable';
        $data['update'] = 'updateVegetable';

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allFruits', $data);
        $this->load->view('admin/footer');
    }

    // для добавления в бд  овощей.
    public function addVegetable()
    {

        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[100]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 100 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('weight', 'role', 'required|trim',
            array('required' => 'Заполните.',
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $array['imgerror'] = '';
            $arr['form'] = 'addVegetable';
            $arr['all'] = 'allVege';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $array);
            $this->load->view('admin/container');
            $this->load->view('admin/addFruits',$arr);
            $this->load->view('admin/footer');
        } else {
            $array['name'] = $this->input->post('name');
            $array['weight'] = $this->input->post('weight');
            $array['price'] = $this->input->post('price');
            $location = 'fruits';
            $imgname = 'photo';
            $ph = $this->do_upload($location, $imgname);
            if (isset($ph['upload_data'])) {
                $array['imgname'] = $ph['upload_data']['file_name'];
                $addBox = $this->AdminModels->addVegetable($array);
                if (!$addBox) {
                    $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                } else {
                    $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                }
                redirect(site_url() . 'admin/MainSections/addVegetable');

            } else {
                $array['imgerror'] = $ph['error'];
                $this->session->set_flashdata('danger_message', 'Слишком большая картина! 1000x1000');
                redirect(site_url() . 'admin/MainSections/addVegetable');
            }

        }


    }

    // для Удаление овощей
    public function deleteVegetable($id){
        $table = 'vegetables';
        $puth = "fruits";
        $result = $this->AdminModels->deleteOne($table, $id,$puth);
        if ($result == FALSE) {
            $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
        } else {
            $this->session->set_flashdata('success_message', 'Успешно удален!');

        }
        redirect(site_url() . 'admin/MainSections/allVege');
    }

    // для загрузки странички  редактирования box
    public function updateBox($id)
    {
        if ($id) {
            $table = 'box';
            $data['box'] = $this->AdminModels->getId($table, $id);
            $query = $this->db->query("Select * From box_composition Where id_box = $id");
            $data['composition'] = $query->result_array();

            $data['imgerror'] = '';
            if ($data['box'] != false) {
                $this->load->view('admin/header');
                $this->load->view('admin/navbar');
                $this->load->view('admin/container');
                $this->load->view('admin/updateBox', $data);
                $this->load->view('admin/footer');
            } else {
                redirect(site_url() . 'admin/MainSections/allbox');
            }

        } else {
            redirect(site_url() . 'admin/');
        }

    }
    // Action редактирование Главного Boxa
    public function updateBoxActionMain(){

        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('weight', 'Last Name', 'required|trim',
            array('required' => 'Заполните вес.')
        );
        $id = $this->input->post('id');
        $table = 'box';
        $data['box'] = $this->AdminModels->getId($table, $id);
        if ($this->form_validation->run() == FALSE) {
            $data['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/container');
            $this->load->view('admin/updateBox');
            $this->load->view('admin/footer');
        } else {
            $array['id'] = $id;
            $array['name'] = $this->input->post('name');
            $array['price'] = $this->input->post('price');
            $array['weight'] = $this->input->post('weight');
            $location = 'main';
            $imgname = 'photo';
            $img = $_FILES['photo'];
            $photoname = $img['name'];
            if (empty($photoname)) {

            } else {
                $ph = $this->do_upload($location, $imgname);
                $array['imgname'] = $ph['upload_data']['file_name'];
                $table = 'box';
                $result = $this->AdminModels->getId($table, $id);
                if ($result != false) {
                    $namefile = $result[0]->img_name;
                    $file = 'main';
                    $this->AdminModels->deleteFiles($namefile, $file);
                }
            }

            if (!$this->AdminModels->updateBox($array)) {
                $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
            } else {
                $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
            }
            redirect(site_url() . 'admin/MainSections/updateBox/' . $id);

        }
    }
    // Action редактирование cостава Boxa
    public function updateBoxActionTwo(){
        $box_id = $this->input->post('box_id');
        $child=array();
        for($i=0;count($_POST['composition'])>$i;$i++ ){
            $child[]=array(
                'title' => $_POST['composition'][$i],
                'id' => $_POST['id'][$i]
            );
        }
        if (!$this->AdminModels->update_composition($child)) {
            $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
        } else {
            $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
        }
        redirect(site_url() . 'admin/MainSections/updateBox/' . $box_id);
    }
    //  страничка  редактирование фрукты
    public function updateFruits($id){
        if ($id) {
            $table = 'fruits';
            $data['arr'] = $this->AdminModels->getId($table, $id);
            $data['title'] = 'Фрукты';
            $data['procc'] = 'updateFruitsAction';
            $data['allfruits'] = 'allFruits';
            $data['imgerror'] = '';
            if ($data['arr'] != false) {
                $this->load->view('admin/header');
                $this->load->view('admin/navbar');
                $this->load->view('admin/container');
                $this->load->view('admin/updateFrVg', $data);
                $this->load->view('admin/footer');
            } else {
                redirect(site_url() . 'admin/MainSections/allFruits');
            }

        } else {
            redirect(site_url() . 'admin/');
        }
    }
    // update action фрукты
    public function updateFruitsAction(){
        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('weight', 'Last Name', 'required|trim',
            array('required' => 'Заполните вес.')
        );
        $id = $this->input->post('id');
        $table = 'fruits';
        $data['fruits'] = $this->AdminModels->getId($table, $id);
        if ($this->form_validation->run() == FALSE) {
            $data['imgerror'] = '';
            $this->session->set_flashdata('danger_message', 'Надо заполнить все поля.');
            redirect(site_url() . 'admin/MainSections/updateFruits/' . $id);

        } else {
            $array['id'] = $id;
            $array['name'] = $this->input->post('name');
            $array['price'] = $this->input->post('price');
            $array['weight'] = $this->input->post('weight');
            $location = 'fruits';
            $imgname = 'photo';
            $img = $_FILES['photo'];
            $photoname = $img['name'];
            if (empty($photoname)) {

            } else {
                $ph = $this->do_upload($location, $imgname);
                $array['imgname'] = $ph['upload_data']['file_name'];
                $table = 'fruits';
                $result = $this->AdminModels->getId($table, $id);
                if ($result != false) {
                    $namefile = $result[0]->img_name;
                    $file = 'fruits';
                    $this->AdminModels->deleteFiles($namefile, $file);
                }
            }

            if (!$this->AdminModels->updateFrVg($table,$array)) {
                $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
            } else {
                $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
            }
            redirect(site_url() . 'admin/MainSections/updateFruits/' . $id);

        }
    }
    //страничка для редактирование овощи
    public function updateVegetable($id){
        if ($id) {
            $table = 'vegetables';
            $data['arr'] = $this->AdminModels->getId($table, $id);
            $data['title'] = 'Овощи';
            $data['procc'] = 'updateVegAction';
            $data['allfruits'] = 'allVege';
            $data['imgerror'] = '';
            if ($data['arr'] != false) {
                $this->load->view('admin/header');
                $this->load->view('admin/navbar');
                $this->load->view('admin/container');
                $this->load->view('admin/updateFrVg', $data);
                $this->load->view('admin/footer');
            } else {
                redirect(site_url() . 'admin/MainSections/allFruits');
            }

        } else {
            redirect(site_url() . 'admin/');
        }
    }

    public function updateVegAction(){
        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('weight', 'Last Name', 'required|trim',
            array('required' => 'Заполните вес.')
        );
        $id = $this->input->post('id');
        $table = 'vegetables';
        $data['vegetables'] = $this->AdminModels->getId($table, $id);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('danger_message', 'Надо заполнить все поля.');
            redirect(site_url() . 'admin/MainSections/updateVegetable/' . $id);
        } else {
            $array['id'] = $id;
            $array['name'] = $this->input->post('name');
            $array['price'] = $this->input->post('price');
            $array['weight'] = $this->input->post('weight');
            $location = 'fruits';
            $imgname = 'photo';
            $img = $_FILES['photo'];
            $photoname = $img['name'];
            if (empty($photoname)) {

            } else {
                $ph = $this->do_upload($location, $imgname);
                $array['imgname'] = $ph['upload_data']['file_name'];
                $table = 'vegetables';
                $result = $this->AdminModels->getId($table, $id);
                if ($result != false) {
                    $namefile = $result[0]->img_name;
                    $file = 'fruits';
                    $this->AdminModels->deleteFiles($namefile, $file);
                }
            }

            if (!$this->AdminModels->updateFrVg($table,$array)) {
                $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
            } else {
                $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
            }
            redirect(site_url() . 'admin/MainSections/updateVegetable/' . $id);

        }
    }
    // для загрузки все новостей
    public function allNews(){
        $config['base_url'] = base_url() . 'admin/MainSections/allNews/';
        $config['total_rows'] = $this->db->count_all('news');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'news';
        $data['news'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allNews', $data);
        $this->load->view('admin/footer');
    }

    public function addNews(){

        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[100]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 100 символов.'
            )
        );
        $this->form_validation->set_rules('text', 'Last Name', 'required|trim',
            array('required' => 'Заполните.')
        );

        if ($this->form_validation->run() == FALSE) {
            $array['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $array);
            $this->load->view('admin/container');
            $this->load->view('admin/addNews');
            $this->load->view('admin/footer');
        } else {
            $text = $this->input->post('text');
            $string = strip_tags($text);
            $string = substr($string, 0, 220);
            $string = rtrim($string, "!,.-");
            $text2  = substr($string, 0, strrpos($string, ' '));



            $array['name'] = $this->input->post('name');
            $array['text'] = $text;
            $array['text2'] = $text2;
            $location = 'news';
            $imgname = 'photo';
            $ph = $this->do_upload($location, $imgname);
            if (isset($ph['upload_data'])) {
                $array['imgname'] = $ph['upload_data']['file_name'];
                $addBox = $this->AdminModels->addNews($array);
                if (!$addBox) {
                    $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                } else {
                    $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                }
                redirect(site_url() . 'admin/MainSections/addFruits');

            } else {
                $array['imgerror'] = $ph['error'];
                $this->load->view('admin/header');
                $this->load->view('admin/navbar', $array);
                $this->load->view('admin/container');
                $this->load->view('admin/addNews');
                $this->load->view('admin/footer');
            }

        }

    }

    public function deleteNews($id){
        $table = 'news';
        $puth = "news";
        $result = $this->AdminModels->deleteOne($table, $id,$puth);
        if ($result == FALSE) {
            $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
        } else {
            $this->session->set_flashdata('success_message', 'Успешно удален!');

        }
        redirect(site_url() . 'admin/MainSections/allNews');
    }

    public function updateNews($id){
        if ($id) {
            $table = 'news';
            $data['news'] = $this->AdminModels->getId($table, $id);
            $data['imgerror'] = '';
            if ($data['news'] != false) {
                $this->load->view('admin/header');
                $this->load->view('admin/navbar');
                $this->load->view('admin/container');
                $this->load->view('admin/updateNews', $data);
                $this->load->view('admin/footer');
            } else {
                redirect(site_url() . 'admin/MainSections/allNews');
            }

        } else {
            redirect(site_url() . 'admin/');
        }

    }

    public function updateNewsAction(){
        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[100]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 100 символов.'
            )
        );
        $this->form_validation->set_rules('text', 'Last Name', 'required|trim',
            array('required' => 'Заполните.')
        );
        $id = $this->input->post('id');
        $table = 'news';
        $data['news'] = $this->AdminModels->getId($table, $id);
        if ($this->form_validation->run() == FALSE) {
            $data['imgerror'] = '';
            $this->session->set_flashdata('danger_message', 'Надо заполнить все поля.');
            redirect(site_url() . 'admin/MainSections/updateNews/' . $id);

        } else {
            $array['id'] = $id;
            $array['name'] = $this->input->post('name');
            $array['text'] = $this->input->post('text');
            $location = 'news';
            $imgname = 'photo';
            $img = $_FILES['photo'];
            $photoname = $img['name'];
            if (empty($photoname)) {

            } else {
                $ph = $this->do_upload($location, $imgname);
                $array['imgname'] = $ph['upload_data']['file_name'];
                $table = 'news';
                $result = $this->AdminModels->getId($table, $id);
                if ($result != false) {
                    $namefile = $result[0]->img_name;
                    $file = 'news';
                    $this->AdminModels->deleteFiles($namefile, $file);
                }
            }

            if (!$this->AdminModels->updateNews($array)) {
                $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
            } else {
                $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
            }
            redirect(site_url() . 'admin/MainSections/updateNews/' . $id);

        }
    }

    public function allPartners(){
        $config['base_url'] = base_url() . 'admin/MainSections/allPartners/';
        $config['total_rows'] = $this->db->count_all('partners');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'partners';
        $data['partners'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allPart', $data);
        $this->load->view('admin/footer');
    }

    public function addPartners(){

        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[100]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 100 символов.'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $array['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $array);
            $this->load->view('admin/container');
            $this->load->view('admin/addPart');
            $this->load->view('admin/footer');
        } else {
            $array['name'] = $this->input->post('name');
            $location = 'partners';
            $imgname = 'photo';
            $ph = $this->do_upload($location, $imgname);
            if (isset($ph['upload_data'])) {
                $array['imgname'] = $ph['upload_data']['file_name'];
                $addBox = $this->AdminModels->addPartners($array);
                if (!$addBox) {
                    $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                } else {
                    $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                }
                redirect(site_url() . 'admin/MainSections/addPartners');

            } else {
                $array['imgerror'] = $ph['error'];
                $this->load->view('admin/header');
                $this->load->view('admin/navbar', $array);
                $this->load->view('admin/container');
                $this->load->view('admin/addPartners');
                $this->load->view('admin/footer');
            }

        }

    }

    public function deletePartners($id){
        $table = 'partners';
        $puth = "partners";
        $result = $this->AdminModels->deleteOne($table, $id,$puth);
        if ($result == FALSE) {
            $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
        } else {
            $this->session->set_flashdata('success_message', 'Успешно удален!');

        }
        redirect(site_url() . 'admin/MainSections/allPartners');
    }

}
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
            redirect(site_url() . 'mainAdmin/');
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
                $this->load->view('admin/header');
                $this->load->view('admin/navbar', $array);
                $this->load->view('admin/container');
                $this->load->view('admin/addFruits');
                $this->load->view('admin/footer');
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
        $config['base_url'] = base_url() . 'admin/MainSections/allFruits/';
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
                $this->load->view('admin/header');
                $this->load->view('admin/navbar', $array);
                $this->load->view('admin/container');
                $this->load->view('admin/addFruits');
                $this->load->view('admin/footer');
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

    // для загрузки все новостей
    public function allNews(){
        $config['base_url'] = base_url() . 'admin/MainSections/allNews/';
        $config['total_rows'] = $this->db->count_all('news');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'fruits';
        $data['fruits'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));
        $data['title'] = 'Фрукты';
        $data['add'] = 'addFruits';
        $data['delete'] = 'deleteFruits';

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allFruits', $data);
        $this->load->view('admin/footer');
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










    // для редактирования спортивного питание
    public function updateSportpit()
    {
        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('text', 'role', 'required|trim|max_length[220]',
            array('required' => 'Заполните.',
                'max_length' => 'Должно содержать не больше 220 символов.'
            )
        );

        $id = $this->input->post('id');
        $table = 'spo';
        $data['sportpit'] = $this->AdminModels->getId($table, $id);
        if ($this->form_validation->run() == FALSE) {
            $data['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/container');
            $this->load->view('admin/updateSportPit');
            $this->load->view('admin/footer');
        } else {
            $array['id'] = $id;
            $array['name'] = $this->input->post('name');
            $array['price'] = $this->input->post('price');
            $array['text'] = $this->input->post('text');
            $array['section'] = $this->input->post('section');
            $location = 'sport-pit';
            $imgname = 'photo';
            $img = $_FILES['photo'];
            $photoname = $img['name'];
            if (empty($photoname)) {

            } else {
                $ph = $this->do_upload($location, $imgname);
                $array['imgname'] = $ph['upload_data']['file_name'];
                $table = 'spo';
                $result = $this->AdminModels->getId($table, $id);
                if ($result != false) {
                    $namefile = $result->imgname;
                    $file = 'sportpit';
                    $this->deleteFiles($file, $namefile);
                }
            }

            if (!$this->AdminModels->updatepit($array)) {
                $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
            } else {
                $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
            }
            redirect(site_url() . 'admin/MainSections/updateSp/' . $id);

        }
    }

    // для загрузки всех спорт оборудований
    public function allsporteq()
    {
        $config['base_url'] = base_url() . 'admin/MainSections/allsporteq/';
        $config['total_rows'] = $this->db->count_all('equipment');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'equipment';
        $data['sportpits'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allsporteq', $data);
        $this->load->view('admin/footer');
    }

    // для загрузки станички  редактирования
    public function updateEq($id)
    {
        if ($id) {
            $table = 'equipment';
            $data['sportpit'] = $this->AdminModels->getId($table, $id);
            $data['imgerror'] = '';
            if ($data['sportpit'] != false) {
                $this->load->view('admin/header');
                $this->load->view('admin/navbar');
                $this->load->view('admin/container');
                $this->load->view('admin/updateEq', $data);
                $this->load->view('admin/footer');
            } else {
                redirect(site_url() . 'admin/mainAdmin/');
            }

        } else {
            redirect(site_url() . 'admin/mainAdmin/');
        }

    }

    // для редактирования спортивного питание
    public function updatefunctionEq()
    {


        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('text', 'role', 'required|trim|max_length[220]',
            array('required' => 'Заполните.',
                'max_length' => 'Должно содержать не больше 220 символов.'
            )
        );

        $id = $this->input->post('id');
        $table = 'equipment';
        $data['sportpit'] = $this->AdminModels->getId($table, $id);
        if ($this->form_validation->run() == FALSE) {
            $data['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/container');
            $this->load->view('admin/updateEq');
            $this->load->view('admin/footer');
        } else {
            $array['id'] = $id;
            $array['name'] = $this->input->post('name');
            $array['price'] = $this->input->post('price');
            $array['text'] = $this->input->post('text');
            $array['phone'] = $this->input->post('phone');
            $location = 'equipment';
            $imgname = 'photo';
            $img = $_FILES['photo'];
            $photoname = $img['name'];
            if (empty($photoname)) {

            } else {
                $ph = $this->do_upload($location, $imgname);
                $array['imgname'] = $ph['upload_data']['file_name'];
                $table = 'spo';
                $result = $this->AdminModels->getId($table, $id);
                if ($result != false) {
                    $namefile = $result->imgname;
                    $file = 'sporteq';
                    $this->deleteFiles($file, $namefile);
                }
            }

            if (!$this->AdminModels->updateEquipment($array)) {
                $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
            } else {
                $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
            }
            redirect(site_url() . 'admin/MainSections/updateEq/' . $id);

        }
    }
    // для удаление спорт оборудование
    public function deleteEq($id){
        $table = 'equipment';
        $puth = 'equipment';
        $result = $this->AdminModels->deleteOne($table, $id,$puth);
        if ($result == FALSE) {
            $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
        } else {
            $this->session->set_flashdata('success_message', 'Успешно удален!');
        }
        redirect(site_url() . 'admin/MainSections/allsporteq');

    }
    // для добавление спортивного оборудование
    public function addEq(){
        $array['name'] = $this->input->post('name');
        $array['price'] = $this->input->post('price');
        $array['text'] = $this->input->post('text');
        $array['number_phone'] = $this->input->post('number_phone');
        if (!isset($array['name']) && !isset($array['price']) && !isset($array['text']) && !isset($array['number_phone'])){
            $array['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $array);
            $this->load->view('admin/addEq');
            $this->load->view('admin/footer');
        }
        else{
            $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
                array('required' => 'Заполните название.',
                    'max_length' => 'Должно содержать не больше 60 символов.'
                )
            );
            $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
                array('required' => 'Заполните цену.')
            );

            $this->form_validation->set_rules('text', 'role', 'required|trim|max_length[220]',
                array('required' => 'Заполните.',
                    'max_length' => 'Должно содержать не больше 220 символов.'
                )
            );
            $this->form_validation->set_rules('number_phone', 'role', 'required|trim',
                array('required' => 'Заполните.'
                )
            );

            if ($this->form_validation->run() == FALSE) {
                $array['imgerror'] = '';
                $this->load->view('admin/header');
                $this->load->view('admin/navbar', $array);
                $this->load->view('admin/container');
                $this->load->view('admin/addEq');
                $this->load->view('admin/footer');
            } else {
                $location = 'equipment';
                $imgname = 'photo';
                $ph = $this->do_upload($location, $imgname);
                if (isset($ph['upload_data'])) {
                    $array['imgname'] = $ph['upload_data']['file_name'];
                    if (!$this->AdminModels->addEq($array)) {
                        $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                    } else {
                        $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                    }
                    redirect(site_url() . 'admin/MainSections/addEq');

                } else {
                    $array['imgerror'] = $ph['error'];
                    $this->load->view('admin/header');
                    $this->load->view('admin/navbar', $array);
                    $this->load->view('admin/container');
                    $this->load->view('admin/addEq');
                    $this->load->view('admin/footer');
                }

            }


        }


    }



}
<?php
class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 모델 사용
        $this->load->model('Blog_model');
    }

    public function index()
    {
        // 모델함수 사용
        $this->Blog_model->get_last_ten_entries();

        $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');

        $data['title'] = 'My Real Title';
        $data['heading'] = 'My Real Heading';

        $this->load->view('blogview', $data);
    }

    public function comments()
    {
        echo 'Loot at this!';
    }

    public function insert()
    {
        $this->Blog_model->insert_entry();
    }

    public function update($val)
    {
        $this->Blog_model->update_entry($val);
    }

    public function delete($val)
    {
        $this->Blog_model->delete_entry($val);
    }
}
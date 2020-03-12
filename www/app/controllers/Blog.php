<?php
class Blog extends CI_Controller
{
    public function index()
    {
        $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');

        $data['title'] = 'My Real Title';
        $data['heading'] = 'My Real Heading';

        $this->load->view('blogview', $data);

        // 모델 사용
        $this->load->model('Blog_model');
        $this->Blog_model->get_last_ten_entries();
        $this->Blog_model->insert_entry();
        $this->Blog_model->update_entry();
    }

    public function comments()
    {
        echo 'Loot at this!';
    }
}
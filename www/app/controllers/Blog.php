<?php
class Blog extends CI_Controller
{
    public function index()
    {
        // 모델 사용
        $this->load->model('Blog_model');

        $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');

        $data['title'] = 'My Real Title';
        $data['heading'] = 'My Real Heading';

        $this->load->view('blogview', $data);
    }

    public function comments()
    {
        echo 'Loot at this!';
    }
}
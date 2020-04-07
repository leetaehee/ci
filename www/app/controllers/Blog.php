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
        // open config file.
        $this->config->load('thConfig');
        $testSetting =  $this->config->item('test_setting');

        //$this->config->set_item('dev_dbms', 'MariaDB');
        $testSetting['dev_dbms'] = 'MariaDB';

        // 파일캐싱
        $this->load->driver('cache');
        $content = 'Loot at this! : ' . $testSetting['dev_dbms'];
        $this->cache->file->save('content', $content, 60);

        // 가져오기.
        echo $this->cache->file->get('content');
    }

    public function insert()
    {
        $this->Blog_model->insert_entry();

        // 이메일 보내기
        $this->load->library('email');

        $this->email->from('lastride25@naver.com', "이태희");
        $this->email->to('ceman08071039@gmail.com');
        $this->email->subject('코드이그나이터에서 이메일 발송 테스트');
        $this->email->message('코드이그나이터 테스트');

        $this->email->send();
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
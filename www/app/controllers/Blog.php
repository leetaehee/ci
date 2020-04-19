<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 모델 사용
        $this->load->model('Blog_model');
        // 페이징 로드
        $this->load->library('pagination');
        // 파일캐싱
        $this->load->driver('cache');
        // 암호화 클래스 초기화
        $this->load->library('encryption');
        // 이메일 보내기
        $this->load->library('email');
        // 템플릿 파서
        $this->load->library('parser');
    }

    public function index($page = 0)
    {
        // 모델함수 사용
        $this->Blog_model->get_last_ten_entries();


        $data['title'] = 'My Real Title';
        $data['heading'] = 'My Real Heading';
        $data['todo_list'] = array(
            'Clean House',
            'Call Mom',
            'Run Errands',
            'develop_php',
            'publishing_web',
            'css',
            'js',
            'BEMS',
            'BEMS Mobile',
            'HEMS',
            'Laravel',
            'CodeIgniter',
            'PHP'
        );

        // paging
        $baseURL = $this->config->item('base_url');

        // config/pagination.php 만들어서 할수있음
        $config['base_url'] = $baseURL  . '/blog/index';
        $config['total_rows'] = count($data['todo_list']);
        $config['page_query_string']  = true;

        $config['per_page'] = 5;

        $this->pagination->initialize($config);

        // view
        $this->load->view('blogview', $data);
    }

    public function comments()
    {
        // open config file.
        $this->config->load('thConfig');
        $testSetting =  $this->config->item('test_setting');

        //$this->config->set_item('dev_dbms', 'MariaDB');
        $testSetting['dev_dbms'] = 'MariaDB';

        $content = 'Loot at this! : ' . $testSetting['dev_dbms'];
        $this->cache->file->save('content', $content, 60);

        // 가져오기.
        echo $this->cache->file->get('content');
    }

    public function insert()
    {
        $this->Blog_model->insert_entry();

        // 암호화
        $encryptPassword = $this->encryption->encrypt('akfxlwmeoxhdfud!@');
        // 복호화
        $decryptPassword = $this->encryption->decrypt($encryptPassword);
    }

    public function update($val)
    {
        $this->Blog_model->update_entry($val);
    }

    public function delete($val)
    {
        $this->Blog_model->delete_entry($val);
    }

    public function mail()
    {
        $this->email->from('lastride25@naver.com', "이태희");
        $this->email->to('ceman08071039@gmail.com');
        $this->email->cc(
            array(
                'lastride25@naver.com',
                'jimin860987@naver.com'
            )
        );
        $this->email->subject('코드이그나이터 프레임워크 사용하기: smtp mail 테스트');
        $this->email->message('코드이그나이터 정복 하기! ㅎㅎ');

        $result = $this->email->send();
        $errorMessage = ($result === true) ?  'success' : 'fail';

        log_message('info', '==> mail send status code : ' . $errorMessage);
    }

    public function template()
    {
        $data = array(
            'blog_title' => 'My Blog Title',
            'blog_heading' => 'To do List',
            'blog_entries' => array(
                array(
                    'title' => 'To do Item 1',
                    'body' => 'BEMS'
                ),
                array(
                    'title' => 'To do Item 2',
                    'body' => 'BEMS MOBILE'
                ),
                array(
                    'title' => 'To do Item 3',
                    'body' => 'HEMS'
                ),
                array(
                    'title' => 'To do Item 4',
                    'body' => 'Laravel'
                ),
                array(
                    'title' => 'To do Item 5',
                    'body' => 'CodeIgniter.'
                ),
                array(
                    'title' => 'To do Item 6',
                    'body' => 'Java Android.'
                )
            )
        );

        // paging
        $baseURL = $this->config->item('base_url');

        // config/pagination.php 만들어서 할수있음
        $config['base_url'] = $baseURL  . '/blog/template';
        $config['total_rows'] = count($data['blog_entries']);
        $config['page_query_string']  = true;
        $config['per_page'] = 3;

        $this->pagination->initialize($config);

        $this->parser->parse('blog_template', $data);
    }
}
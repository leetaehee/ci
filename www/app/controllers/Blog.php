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
        // 세션
        $this->load->library('session');
    }

    public function index()
    {
        // 페이지 번호
        $page = (int)$this->input->get('per_page');

        if ($page === 0) {
            $page = 0;
        }

        // 블로그데이터 가져오기
        $result = $this->Blog_model->getBlogData($page);
        // 블로그 데이터 카운트
        $total = $this->Blog_model->getBlogDataTotal();

        $data['title'] = 'My Real Title';
        $data['blog_title'] = 'My Real Heading';
        $data['blog_description'] = $result;

        // paging
        $baseURL = $this->config->item('base_url');

        // config/pagination.php 만들어서 할수있음
        $config['base_url'] = $baseURL  . '/blog/index';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['total_rows'] = $total;
        $config['page_query_string']  = true;

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
        // 암호화
        $encryptPassword = $this->encryption->encrypt('akfxlwmeoxhdfud!@');
        // 복호화
        $decryptPassword = $this->encryption->decrypt($encryptPassword);

        $affectedRows = $this->Blog_model->insert_entry();
        if ($affectedRows < 0) {
            echo '데이터 입력에 실패하였습니다. ';
            exit;
        }

        echo '데이터 입력에 성공하였습니다!';

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

    public function saveSession()
    {
        $newData = array(
            'username' => 'johndoe',
            'email' => 'johndoe@some-site.com',
            'logged_in' => true
        );

        // 세션 생성
        $this->session->set_userdata('userData1', $newData);

        // 생성후 결과 조회
        print_r($_SESSION['userData1']);

        // 세션 키 조회
        //echo isset($_SESSION['userData1']['username']);

        // 개별 세션 삭제
        //$this->session->unset_userdata('userData1');

        // 삭제후 결과 조회 (삭제가 되면 출력되지 않음
        //print_r($_SESSION['userData1']);

        // 모든 세션 삭제
        //session_destroy()
        $this->session->sess_destroy();

    }
}
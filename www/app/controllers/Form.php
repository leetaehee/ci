<?php
class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->lang->load('form_validation_lang');
    }

    public function index()
    {
        // 입력데이터 가져오기
        $username = $this->input->post('username', true);
        $ip = $this->input->ip_address();

        // 언어파일 로딩
        $this->lang->load('error_lang', 'english');
        echo $this->lang->line('error_language_key');

        /** config/form_validation.php 에서 불러옴*/
        // 배열의 키를 불러오는 방법
        /*
            if ($this->form_validation->run('signup') == false) {
                $this->load->view('myform');
            } else {
                $this->load->view('formsuccess');
            }
        */

        //controller  class/function 명으로 불러오는 방법
        if ($this->form_validation->run('form/index') == false) {
            $this->load->view('myform');
        } else {
            $this->load->view('formsuccess');
        }

    }

    public function username_check($str)
    {
        // 중복체크
        if ($str == '광개토대왕') {
            $this->form_validation->set_message('username_check', '광개토대왕은 등록 할 수없습니다.');
            return false;
        } else {
            return true;
        }
    }
}
<?php
class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

    }

    public function index()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'username',
            'Username',
            'trim|required|min_length[2]|max_length[10]|callback_username_check'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required',
            'trim|required|md5'
        );
        $this->form_validation->set_rules(
            'passconf',
            'Password Confirmation',
            'trim|required|matches[password]'
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required',
            array('required' => '필수입니다!!!')
        );

        $this->form_validation->set_message('min_length', '{field} 필드는 {param} 자 이상 입력하세요!');
        $this->form_validation->set_message('max_length', '{field} 필드는 {param} 자 이내로 입력하세요!');

        if ($this->form_validation->run() === false) {
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
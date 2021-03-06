<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'form/index' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'passconf',
            'label' => 'Password Confirmation',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        )
    )
);
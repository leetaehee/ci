<?php
class MY_Loader extends CI_Loader
{
    public function template($templateName, $vars = array(), $return = false)
    {
        $param = array();

        $htmlHeader = isset($vars['htmlHeader']) ? $vars['htmlHeader'] : 'layout/html_header';
        $layoutHeader = isset($vars['layoutHeader']) ? $vars['layoutHeader'] : 'layout/layout_header';
        $layoutFooter = isset($vars['layoutFooter']) ? $vars['layoutFooter'] : 'layout/layout_footer';
        $htmlFooter = isset($vars['htmlFooter']) ? $vars['htmlFooter'] : 'layout/html_footer';

        $param['htmlHeader'] = $htmlHeader;
        $param['layoutHeader'] = $layoutHeader;
        $param['layoutFooter'] = $layoutFooter;
        $param['htmlFooter'] = $htmlFooter;
        $param['templateName'] = $templateName;
        $param['vars'] = $vars;

        $this->view('layout/layout_body', $param);
    }
}
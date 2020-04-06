<?php
class Blog_model extends CI_Model
{
    public $title;
    public $content;
    public $date;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_last_ten_entries()
    {
        log_message('error', '==> Blog_model :: get_last_ten_entries()');
    }

    public function insert_entry()
    {
        log_message('error', '==> Blog_model :: insert_entry()');
    }

    public function update_entry($val)
    {
        log_message('error', '==> Blog_model :: update_entry() : ' . $val);
    }

    public function delete_entry($val)
    {
        log_message('error', '==> Blog_model :: delete_entry() : ' . $val);
    }
}
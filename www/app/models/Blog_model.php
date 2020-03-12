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
        echo "==> Blog_model :: get_last_ten_entries() <br>";
    }

    public function insert_entry()
    {
        echo "==> Blog_model :: insert_entry() <br>";
    }

    public function update_entry()
    {
        echo "==> Blog_model :: update_entry() <br>";
    }
}
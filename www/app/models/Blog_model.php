<?php
class Blog_model extends CI_Model
{
    public $title;
    public $content;
    public $date;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getBlogData($page)
    {
        // 로그 출력
        log_message('info', '==> Blog_model :: getBlogData()');

        $params = array('page' => $page);

        $rBlogQ = "SELECT `blog_id`,`blog_title`,`blog_description` FROM `ci_blog` LIMIT ?, 5";

        $query = $this->db->query($rBlogQ, $params);

        return $query->result_array();
    }

    public function getBlogDataTotal()
    {
        // 로그 출력
        log_message('info', '==> Blog_model :: getBlogDataTotal()');

        $rBlogCountQ = "SELECT COUNT(`blog_id`) `total` FROM `ci_blog`";

        $query = $this->db->query($rBlogCountQ);

        $row = $query->row_array();

        return $row['total'];
    }

    public function insert_entry()
    {
        // 로그 출력 
        log_message('info', '==> Blog_model :: insert_entry()');

        // simple query
        /*
            $blogTitle = '코드이그나이터 테스트(DB)';
            $blogDescription = '코드이그나이터 테스트중입니다. 감사합니다.';

            $cBlogQ = "INSERT INTO `ci_blog` SET
                        `blog_title` = '".$this->db->escape_str($blogTitle)."',
                        `blog_description` = '".$this->db->escape_str($blogDescription)."'";

            $query = $this->db->query($cBlogQ);
         */

        // binding query
        /*
            $inputData = array(
                'blog_title' => 'query Binding Test',
                'blog_description' => '바인딩은 더 편해요! 추천해요!'
            );

            $cBlogQ = "INSERT INTO `ci_blog` (`blog_title`, `blog_description`) VALUES (?, ?)";
            $query = $this->db->query($cBlogQ, $inputData);

            $affectedRows = $this->db->affected_rows();
        */

        // insert 쿼리를 좀 더 쉽게 사용하기
        $inputData = array(
            'blog_title' => 'insert Query를 좀 더 쉽게 사용해볼까요?',
            'blog_description' => '코드이그나이터 편해요!!! 굳굳굳'
        );

        $cBlogQ = $this->db->insert_string('ci_blog', $inputData);
        $query = $this->db->query($cBlogQ);

        $affectedRows = $this->db->affected_rows();

        $this->db->close();

        return $affectedRows;
    }

    public function update_entry($val)
    {
        log_message('info', '==> Blog_model :: update_entry() : ' . $val);
    }

    public function delete_entry($val)
    {
        log_message('info', '==> Blog_model :: delete_entry() : ' . $val);
    }
}
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
        log_message('debug', '==> Blog_model :: getBlogData()');

        $params = array('page' => $page);

        $rBlogQ = "SELECT `blog_id`,`blog_title`,`blog_description` FROM `ci_blog` LIMIT ?, 5";

        $query = $this->db->query($rBlogQ, $params);

        return $query->result_array();
    }

    public function getBlogDataTotal()
    {
        // 로그 출력
        log_message('debug', '==> Blog_model :: getBlogDataTotal()');

        $rBlogCountQ = "SELECT COUNT(`blog_id`) `total` FROM `ci_blog`";

        $query = $this->db->query($rBlogCountQ);

        $row = $query->row_array();

        return $row['total'];
    }

    public function insert_entry()
    {
        // 로그 출력 
        log_message('debug', '==> Blog_model :: insert_entry()');

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

    public function update_entry($blogId)
    {
        $result = 0;

        // 로그출력
        log_message('debug', '==> Blog_model :: update_entry() : ' . $blogId);

        $data = array(
            'blog_title' => 'CI 업데이트 테스트.',
            'blog_description' => 'CI 업데이트 구문은 이렇게- 쿼리빌더로 시도함'
        );

        $this->db->where('blog_id', $blogId);
        $this->db->update('ci_blog', $data);

        $affectedRows = $this->db->affected_rows();

        $this->db->close();

        return $affectedRows;
    }

    public function delete_entry($blogId)
    {
        log_message('debug', '==> Blog_model :: delete_entry() : ' . $blogId);

        $this->db->where('blog_id', $blogId);
        $this->db->delete('ci_blog');

        $affectedRows = $this->db->affected_rows();

        $this->db->close();

        return $affectedRows;
    }

    public function checkBlogId($blogId)
    {
        // 로그출력
        log_message('debug', '==> Blog_model :: checkBlogId() : ' . $blogId);

        // 게시물 고유번호 체크
        //$query = $this->db->get('ci_blog');
        $query = $this->db->get_where('ci_blog', array('blog_id' => $blogId));

        if ($query->num_rows() < 1) {
            // pk가 있는지 체크
            return -1;
        }

        $row = $query->row_array();

        return $row['blog_id'];
    }
}
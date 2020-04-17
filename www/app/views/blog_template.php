<!DOCTYPE html>
<html lang="ko">
    <meta charset="UTF-8">
    <title>{blog_title}</title>
    <body>
        <h3>{blog_heading}</h3>

        {blog_entries}
            <h5>{title}</h5>
            <p>{body}</p>
        {/blog_entries}

        <!-- 페이징 처리 -->
        <?php echo $this->pagination->create_links();?>

    </body>
</html>
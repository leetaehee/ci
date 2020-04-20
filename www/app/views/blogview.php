<!DOCTYPE html>
<html lang="ko">
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <body>
        <h1><?=$blog_title?></h1>

        <h3>My Todo List</h3>


        <ul>
            <?php foreach($blog_description as $item): ?>
                <li>
                    제목 : <?=$item['blog_title']?> <br>
                    내용 : <?=$item['blog_description']?>
                </li>
            <?php endforeach;?>
        </ul>

        <!-- 페이징처리 -->
        <?php echo $this->pagination->create_links();?>
    </body>
</html>
<!DOCTYPE html>
<html lang="ko">
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <body>
        <h1><?=$heading?></h1>

        <h3>My Todo List</h3>

        <ul>
            <?php foreach($todo_list as $item): ?>
                <li><?=$item?></li>
            <?php endforeach;?>
        </ul>

        <!-- 페이징처리 -->
        <?php echo $this->pagination->create_links();?>
    </body>
</html>
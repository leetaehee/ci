<!DOCTYPE html>
<html lang="ko">
    <meta charset="UTF-8">

    <title>XSS Form</title>

    <body>
        <?php
            echo $csrf['name']; // 출력이 안됨
            echo $name; 출력됨
         ?>
        <form id="xss" name="xss" action="xss_proc" method="post">
            <h4>XSS Form.</h4>
            <input type="submit" id="xss_proc" value="xss 테스트">
        </form>
    </body>
</html>
<!DOCTYPE html>
<html lang="ko">
    <meta charset="UTF-8">

    <title>XSS Form</title>

    <body>
        <form id="xss" name="xss" action="xss_proc" method="post">
            <input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>">
            <h4>XSS Form.</h4>
            <input type="submit" id="xss_proc" value="xss 테스트">
        </form>
    </body>
</html>
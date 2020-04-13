<!DOCTYPE html>
<html lang="ko">
    <meta charset="UTF-8">

    <title>Upload Form</title>

    <body>
        <h3>Your file was successfully uploaded!</h3>
        <ul>
            <?php foreach ($upload_data as $item => $value): ?>
                <li><?=$item?>: <?=$value?></li>
            <?php endforeach?>
        </ul>

        <p><?php echo anchor('uploads', 'Upload Another File!'); ?></p>
    </body>
</html>
<!DOCTYPE html>
<html lang="ko">
    <meta charset="UTF-8">

    <title>Upload Form</title>

    <body>
        <?php echo $error;?>
        <?php echo form_open_multipart('upload/do_upload');?>
        <input type="file" name="userfile" size="20" />
        <br /><br />
        <input type="submit" value="upload" />
        </form>
    </body>
</html>
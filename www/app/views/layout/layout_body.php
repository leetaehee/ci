<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php $this->view($htmlHeader); ?>
    </head>
    <body>
        <div id="bodyWrap">
            <div id="header">
                <?php $this->view($layoutHeader);?>
            </div>
            <div id="content">
                <?php $this->view($templateName);?>
            </div>
            <div id="footer">
                <?php $this->view($layoutFooter);?>
            </div>
        </div>
        <?php $this->view($htmlFooter);?>
    </body>
</html>
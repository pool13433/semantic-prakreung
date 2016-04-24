<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="สุดยอดพระเครื่อง">
        <meta name="language" content="th">
        <meta http-equiv="content-language" content="th" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="revisit-after" content="7 days"/>
        <meta name="Copyright" content="Copyright 2016 www.sudyodprakruang.com" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="-1" />
        <meta name="robots" content="index,follow" />
        <meta content="IE=8" http-equiv="X-UA-Compatible" />
        <!-- Semantic UI CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/semantic/semantic.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/dropzone/dropzone.css" rel="stylesheet">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style type="text/css">
            @font-face {
                font-family: 'TH-Dan-Vi-Vek';
                src: url('webfont.eot'); /* IE9 Compat Modes */
                src: url('<?php echo Yii::app()->request->baseUrl; ?>/fonts/TH-Dan-Vi-Vek/TH Dan Vi Vek ver 1.03.ttf') format('truetype');
            }            
            @font-face {
                font-family: 'Supermarket';
                src: url('webfont.eot'); /* IE9 Compat Modes */
                src: url('<?php echo Yii::app()->request->baseUrl; ?>/fonts/supermarket-1-1/supermarket.ttf') format('truetype');
            }       
            body * {
                font-family: 'Supermarket'
            }
        </style>

    </head>

    <body>
        <?php //$this->renderPartial('/navbar-top') ?>
        <?php $this->renderPartial('/sidebar-left') ?>
        <div class="pusher">
            <div id="fb-root"></div>
            <div class="ui container">
                <a href="#" class="sidebar-toggle" data-visible="open">
                    <i class="bordered inverted teal sidebar icon large"></i>
                </a>
                <?php echo $content; ?>
            </div>
        </div> 
        <?php //$this->renderPartial('/footer') ?>
        <?php
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl . '/js/jquery-1.8.3.min.js');
        $cs->registerScriptFile($baseUrl . '/semantic/semantic.min.js');
        $cs->registerScriptFile($baseUrl . '/js/elevatezoom/jquery.elevatezoom.js');
        $cs->registerScriptFile($baseUrl . '/js/dropzone/dropzone.min.js');
        $cs->registerScriptFile($baseUrl . '/js/prakreung-core.js');
        ?>
    </body>
</html>

<?php
$baseUrl = Yii::app()->baseUrl;
?>
<div class="ui left vertical inverted sidebar labeled icon menu sidebar-toggle-close" data-visible="close">
    <div class="item">
        <div id="hide-sidebar" class="button">
            <i class="bordered inverted teal remove icon large"></i>
        </div>
    </div>
    <a class="item" href="<?= Yii::app()->createUrl('site/index') ?>">
        <i class="home icon"></i>
        สุดยอดพระเครื่อง
    </a>
    <a class="item" href="<?= Yii::app()->createUrl('site/news') ?>">
        <i class="sitemap icon"></i>
        ข่าวสารเกี่ยวกับพระเครื่อง
    </a>
    <a class="item" href="<?= Yii::app()->createUrl('site/upload') ?>">
        <i class="chart icon"></i>
        อยากปล่อยเช่า
    </a>
    <a class="item">
        <i class="smile icon"></i>
        อื่น ๆ
    </a>
</div>
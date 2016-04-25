<?php
$baseUrl = Yii::app()->baseUrl;
?>
<div class="ui grid">

    <div class="twelve wide column">     
        <h2 class="ui top attached header">
            <div class="ui huge breadcrumb">
                <a href="<?= Yii::app()->createUrl('site/news') ?>" class="section">หน้าแรก ข่าวสารพระเครื่อง</a>
                <i class="right angle icon divider"></i>
                <div class="active section"> รายละเอียดของข่าว</div>
            </div>
        </h2>       
        <div class="ui attached segment orange">
            <h2 class="ui top header">
                <?= $news->news_title ?>
            </h2>
            <div class="description">
                <?= $news->news_detail ?>
            </div>
            <div class="ui medium images">
                <?php foreach ($listNewsDetail as $index => $img) { ?>
                    <img class="ui image" data-src="<?= $baseUrl . '/images' . $img->img_name ?>">
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Sidebar Right Begin-->
    <div class="four wide column">
        <?php
        $this->renderPartial('/sidebar_right', array(
            'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
            'listSacredType' => $listSacredType,
            'listMemberLastInsert' => $listMemberLastInsert,
            'listRegion' => $listRegion
        ))
        ?>
        <!-- Sidebar Right End -->

    </div>
</div>


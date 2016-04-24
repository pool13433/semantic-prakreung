<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->

<div class="ui grid">
    <div class="twelve wide column">
        <h3 class="ui  top attached header">
            [ แสดง <?= $display_length ?> ชิ้น ต่อ 1 หน้า จากข้อมูลทั้งหมด <?= $total_length ?> ชิ้น ]
        </h3>
        <div class="ui attached segment orange">
            <div class="ui special three cards" id="boxPraKreung">
                <?php if (count($listSacredObject) == 0) { ?>
                    <div class="one wide column">        
                        <div role="alert" class="alert alert-warning alert-dismissible fade in"> 
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                <span aria-hidden="true">×</span></button> 
                            <strong>ไม่พบข้อมูล</strong> ผลการค้นหาไม่พบข้อมูลจากเงื่อนไขการค้นหา
                        </div>
                    </div>
                <?php } else { ?>
                    <?php foreach ($listSacredObject as $index => $object) { ?>
                        <div class="card orange">
                            <div class="content">                                    
                                <span class="header"><i class="heartbeat icon small"></i> <?= $object->obj_name; ?></span>
                            </div>
                            <div class="blurring dimmable image ">
                                <div class="ui dimmer">
                                    <div class="content">
                                        <div class="center">
                                            <a href="<?= Yii::app()->createUrl('site/detail/' . $object->obj_id) ?>" 
                                               class="ui button inverted orange" style="font-size: 1.1em;font-weight: bold">
                                                <i class="fa fa-share-square-o"></i> รายละเอียด...
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <img class="transition visible" style="max-height:300px;"
                                     src="<?= $baseUrl . '/images' . $object->obj_img ?>"  
                                     data-src="<?= $baseUrl . '/images' . $object->obj_img ?>">
                            </div>
                            <div class="content">
                                <a class="header">ราคา <?= $object->obj_price ?> บาท </a>
                                <div class="meta">
                                    <span class="date"><?= date("d/m/Y H:m", strtotime($object->obj_updatedate)) ?></span>
                                </div>
                                <div class="description">
                                    ต้นกำเนิดอยู่ที่จังหวัด <?= $object->province->pro_name_th ?>
                                </div>
                                <div class="description">
                                    ประเภท <?= $object->type->type_name ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="ui large centered inline text loader">
                        Adding more content...
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="four wide column">
        <?php
        $this->renderPartial('/sidebar_right', array(
            'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
            'listSacredType' => $listSacredType,
            'listMemberLastInsert' => $listMemberLastInsert,
            'listRegion' => $listRegion
        ))
        ?>
    </div>
</div>

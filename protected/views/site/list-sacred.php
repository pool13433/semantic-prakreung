<?php
$baseUrl = Yii::app()->baseUrl;
?>
<div class="ui grid">

    <div class="twelve wide column">     
        <h2 class="ui top attached header">
            ข้อมูลพระเครื่องของคุณที่ทำการได้ปล่อยเช่า
        </h2>
        <div class="ui attached segment orange">
            <table class="ui celled striped table orange">
                <thead>
                    <tr>
                        <th>รูป</th>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>ราคา</th>
                        <th>หมวดหมู่</th>
                        <th>ชอบ</th>
                        <th>สถานะ</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listSacredObject as $index => $object) { ?>
                        <tr>
                            <td>
                                <a class="fancybox" href="<?= $baseUrl . '/images' . $object->obj_img ?>">                                       
                                    <img class="lazy img-responsive" alt="Responsive image"
                                         data-original="<?= $baseUrl . '/images' . $object->obj_img ?>"
                                         src="<?= $baseUrl . '/images' . $object->obj_img ?>"
                                         style="max-width: 75%;min-height: 100px;max-height: 100px;">
                                    <noscript>
                                    <img src="<?= $baseUrl . '/images' . $object->obj_img ?>" width="640" heigh="480">
                                    </noscript>
                                </a>         
                            </td>
                            <td><?= ($index + 1) ?></td>
                            <td>
                                <a href="<?= Yii::app()->createUrl('site/detail/' . $object->obj_id) ?>"><?= $object->obj_name ?></a>
                            </td>
                            <td><?= $object->obj_price ?></td>
                            <td><?= $object->type->type_name ?></td>
                            <td><?= $object->obj_like ?></td>
                            <td>
                                <div class="ui buttons small">
                                    <a href="<?= Yii::app()->createUrl('site/upload/' . $object->obj_id) ?>" class="ui button blue small">แก้ไข</a>
                                    <div class="or"></div>
                                    <a href="<?= Yii::app()->createUrl('Site/UserDeleteSacred/' . $object->obj_id) ?>" 
                                           class="ui button red small" onclick="return confirm('ยืนยันการลบข้อมูลออกจากระบบ')">ลบ</a>
                                </div>
                            </td>
                            <td style="width: 15%">
                                <div class="inline fields">
                                    <label for="options<?= $object->obj_id ?>">สถานะ</label>
                                    <div class="field">
                                        <div class="ui radio checkbox <?= ($object->obj_status == 0 ? 'active' : '') ?>" 
                                             onclick="changeSacedStatus(<?= $object->obj_id ?>, 0)">
                                            <input type="radio" name="options<?= $object->obj_id ?>" id="option1" <?= ($object->obj_status == 0 ? 'checked' : '') ?>> 
                                            <label>ส่วนตัว</label>
                                        </div>
                                        <div class="ui radio checkbox  <?= ($object->obj_status == 1 ? 'active' : '') ?>"
                                             onclick="changeSacedStatus(<?= $object->obj_id ?>, 1)">
                                            <input type="radio" name="options<?= $object->obj_id ?>" id="option2" <?= ($object->obj_status == 1 ? 'checked' : '') ?>> 
                                            <label> เผยแพร่</label>
                                        </div>
                                    </div>
                                </div>                                  
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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
    </div>
    <!-- Sidebar Right End -->

</div>
<!-- Co ntent End --> 
<script type="text/javascript">
    function changeSacedStatus(id, status) {
        $.post('<?= Yii::app()->createUrl('helper/UpdateSacredStatus') ?>', {
            id: id,
            status: status
        }, function (response) {
            if (response.status) {
                //window.location.reload(true);
            } else {
                alert('System error');
            }
        }, 'json');
    }
</script>
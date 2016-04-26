<?php
$baseUrl = Yii::app()->baseUrl;
$image = '/image_main.png';
if (!empty($sacred->obj_img)) {
    $image = $sacred->obj_img;
}
?>
<h2 class="ui top attached header">
    จัดการวัตถุมงคล
    <a href="<?= Yii::app()->createUrl('sacred/index') ?>" class="ui button small blue"> 
        <i class="plus icon"></i> ข้อมูลใหม่
    </a>
</h2>
<div class="ui attached segment orange">
    <form class="ui form" method="post" action="<?= Yii::app()->createUrl('sacred/objectSave') ?>" enctype="multipart/form-data">
        <div class="field">
            <label>รูปหลัก</label>
            <div class="box-browse-upload">
                <input type="file" id="fileMain" name="fileMain" <?= (empty($sacred->obj_id) ? 'required' : '') ?> 
                       placeholder="กรุณากรอกข้อมูล รูปหลักสินค้า"
                       accept=".jpg,.png,.jpeg,.gif"  class="ui button blue tiny"/>
                <img id="imgMain" class="ui medium image" src="<?= $baseUrl . '/images' . $image ?>"/>
            </div>                
        </div>
        <div class=" three fields">
            <div class="field">
                <label>ชื่อ</label>
                <input type="hidden" name="id" value="<?= $sacred->obj_id ?>"/>
                <input type="text" class="form-control" name="name" value="<?= $sacred->obj_name ?>" required  placeholder="ชื่อ">
            </div>   
            <div class="field">
                <label>ราคา</label>
                <input type="text" class="form-control" name="price" value="<?= $sacred->obj_price ?>" required placeholder="ราคา">
            </div>
            <div class="field">
                <label>ปีที่สร้าง</label>
                <input type="text" class="form-control" name="year" value="<?= $sacred->obj_born ?>"  
                       maxlength="4" placeholder="ปีที่สร้าง" required>
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label>ประเภทวัตถดิบที่ใช้ทำ</label>
                <select class="ui dropdown" name="type" required>
                    <?php foreach ($listSacredType as $index => $type) { ?>
                        <?php if ($type->type_id == $sacred->type_id) { ?>
                            <option value="<?= $type->type_id ?>" selected><?= $type->type_name ?></option>
                        <?php } else { ?>
                            <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="field">
                <label>ต้นกำเนิดจากจังหวัด</label>
                <select class="ui dropdown" name="province" required>
                    <?php foreach ($listProvince as $index => $province) { ?>
                        <?php if ($province->pro_id == $sacred->pro_id) { ?>
                            <option value="<?= $province->pro_id ?>" selected><?= $province->pro_name_th ?></option>
                        <?php } else { ?>
                            <option value="<?= $province->pro_id ?>"><?= $province->pro_name_th ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="field">
            <label>รายละเอียด</label>
            <textarea class="form-control" name="comment"><?= $sacred->obj_comment ?></textarea>
        </div>
        <div class="actions">
            <button type="submit" class="ui button green"><i class="save icon"></i> บันทึก</button>
            <button type="reset" class="ui button orange"><i class="remove icon"></i> ล้างค่า</button>
        </div>
    </form>
</div>
<div class="ui attached segment orange">
    <table class="ui celled striped table orange">
        <thead>
            <tr>
                <th>ภาพ</th>
                <th>ชื่อ</th>
                <th>ราคา</th>                
                <th>ปีที่สร้าง</th>
                <th>รายละเอียด</th>
                <th style="width: 10%;">รูปที่เกี่ยวข้อง</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listSacredObject as $index => $object) { ?>
                <tr>
                    <td title="<?= $object->obj_img ?>">
                        <a href="<?= $baseUrl . '/images' . $object->obj_img ?>" class="thumbnail fancybox">
                            <img src="<?= $baseUrl . '/images' . $object->obj_img ?>" 
                                 style="max-height: 100px;max-width: 100px;"
                                 alt="...">
                        </a>
                    </td>
                    <td><?= $object->obj_name ?></td>
                    <td><?= $object->obj_price ?></td>                    
                    <td><?= $object->obj_born ?></td>
                    <td><?= $object->obj_comment ?></td>
                    <td style="text-align: center"><?= $object->count_img ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/index/' . $object->obj_id) ?>" class="ui button small blue labeled icon">
                            <i class="pencil icon"></i> แก้ไข
                        </a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/objectDelete/' . $object->obj_id) ?>" class="ui button small red labeled icon" onclick="return confirm('ยืนยันการลบ')">
                            <i class="remove icon"></i> ลบ
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(function () {
        $('#imgMain').on('click', function () {
            $('#fileMain').trigger('click');
        });
        $("#fileMain").change(function () {
            simulateImage(this);
        });
    })
</script>

<h2 class="ui top attached header">
    จัดการภูมิภาค
    <a href="<?= Yii::app()->createUrl('sacred/indexRegion') ?>" class="ui button small blue"> 
        <i class="plus icon"></i> ข้อมูลใหม่
    </a>
</h2>
<div class="ui attached segment orange">
    <form class="ui form" method="post" action="<?= Yii::app()->createUrl('sacred/regionSave') ?>">
        <div class="field">
            <label>ชื่อ</label>
            <input type="hidden" name="id" value="<?= $region->reg_id ?>">
            <input type="text" class="form-control" name="name" value="<?= $region->reg_name ?>" 
                   required autofocus placeholder="ชื่อ">
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
                <th>ลำดับ</th>
                <th>ชื่อไทย</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listRegion as $index => $region) { ?>
                <tr>
                    <td><?= $region->reg_id ?></td>
                    <td><?= $region->reg_name ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/indexRegion/' . $region->reg_id) ?>" class="ui button small blue labeled icon">
                            <i class="pencil icon"></i> แก้ไข</a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/regionDelete/' . $region->reg_id) ?>" class="ui button small red labeled icon" onclick="return confirm('ยืนยันการลบ')">
                            <i class="remove icon"></i> ลบ
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

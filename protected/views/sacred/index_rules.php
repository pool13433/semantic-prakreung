<h2 class="ui top attached header">
    จัดการกฏ
    <a href="<?= Yii::app()->createUrl('sacred/indexRules') ?>" class="ui button small blue"> 
        <i class="plus icon"></i> ข้อมูลใหม่
    </a>
</h2>
<div class="ui attached segment orange">
    <form class="ui form" method="post" action="<?= Yii::app()->createUrl('sacred/rulesSave') ?>">
        <div class="field">
            <label>อธิบาย</label>
            <input type="hidden" name="id" value="<?= $rules->rul_id ?>">
            <textarea name="desc" required><?= $rules->rul_desc ?></textarea>
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
            <?php foreach ($listRules as $index => $rules) { ?>
                <tr>
                    <td><?= $rules->rul_id ?></td>
                    <td><?= $rules->rul_desc ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/indexRules/' . $rules->rul_id) ?>" class="ui button small blue labeled icon">
                            <i class="pencil icon"></i> แก้ไข
                        </a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/rulesDelete/' . $rules->rul_id) ?>" class="ui button small red labeled icon" onclick="return confirm('ยืนยันการลบ')">
                            <i class="remove icon"></i> ลบ
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

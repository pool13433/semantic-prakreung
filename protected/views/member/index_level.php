<h2 class="ui top attached header">
    จัดการระดับ
    <a href="<?= Yii::app()->createUrl('member/indexLevel') ?>" class="ui button small teal"> 
        <i class="plus icon"></i> ข้อมูลใหม่
    </a>
    <a href="<?= Yii::app()->createUrl('member/index') ?>" class="ui button small blue"> 
        <i class="plus icon"></i> จัดการผู้ใช้งาน
    </a>
</h2>
<div class="ui attached segment orange">
    <form class="ui form" method="post" action="<?= Yii::app()->createUrl('member/levelSave') ?>">

        <div class="field">
            <label>ชื่อ</label>
            <input type="hidden" name="id" value="<?= $level->level_id ?>"/>
            <input type="text" name="name" value="<?= $level->level_name ?>" 
                   autofocus required placeholder="ชื่อ">
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
                <th>ชื่อ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listLevel as $index => $level) { ?>
                <tr>
                    <td><?= ($index + 1) ?></td>
                    <td><?= $level->level_name ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('member/indexLevel/' . $level->level_id) ?>" class="ui button small blue">แก้ไข</a>
                    </td>
                    <td>
                        <a onclick="return confirm('ยืนยันการลบ')" href="<?= Yii::app()->createUrl('member/levelDelete/' . $level->level_id) ?>" class="ui button small red">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

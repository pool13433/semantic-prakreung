<h2 class="ui top attached header">
    จัดการสมาชิก
    <a href="<?= Yii::app()->createUrl('member/index') ?>" class="ui button small blue"> 
        <i class="plus icon"></i> ข้อมูลใหม่
    </a>
    <a href="<?= Yii::app()->createUrl('member/indexLevel') ?>" class="ui button small teal"> 
        <i class="plus icon"></i> จัดการระดับ
    </a>
</h2>
<div class="ui attached segment orange">
    <form class="ui form" method="post" action="<?= Yii::app()->createUrl('member/memberSave') ?>">
        <div class="field">
            <label>รูป</label>
            <input type="file" class="ui button blue small" name="img" value="<?= $member->mem_fname ?>">
        </div>
        <div class="two fields">
            <div class="field">
                <label>ชื่อ</label>
                <input type="hidden" name="id" value="<?= $member->mem_id ?>"/>
                <input type="text" name="fname" value="<?= $member->mem_fname ?>" 
                       required placeholder="ชื่อ">
            </div>
            <div class="field">
                <label>สกุล</label>
                <div class="col-sm-3">
                    <input type="text" name="lname" value="<?= $member->mem_lname ?>" 
                           required placeholder="สกุล">
                </div>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>โทร</label>
                <div class="col-sm-2">
                    <input type="text" name="phone" value="<?= $member->mem_phone ?>" 
                           required placeholder="เบอร์โทร">
                </div>
            </div>
            <div class="field">
                <label>อีเมลล์</label>
                <div class="col-sm-3">
                    <input type="email" name="email" value="<?= $member->mem_email ?>" placeholder="อีเมลล์">
                </div>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>เพศ</label>
                <select class="ui dropdown" name="sex" required>
                    <?php if ('F' == $member->mem_sex) { ?>
                        <option value="F" selected>หญิง</option>
                        <option value="M">ชาย</option>
                    <?php } else { ?>
                        <option value="F">หญิง</option>
                        <option value="M" selected>ชาย</option>
                    <?php } ?>
                </select>
            </div>
            <div class="field">
                <label>ระดับ</label>
                <select class="ui dropdown" name="level" required>
                    <?php foreach ($listLevel as $index => $level) { ?>
                        <?php if ($level->level_id == $member->mem_level) { ?>
                            <option value="<?= $level->level_id ?>" selected><?= $level->level_name ?></option>
                        <?php } else { ?>
                            <option value="<?= $level->level_id ?>"><?= $level->level_name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <a href="<?= Yii::app()->createUrl('member/indexLevel') ?>" class="ui button teal small">
                    <i class="plus icon"></i> จัดการระดับ
                </a>
            </div>
            <div class="field">
                <div class="inline fields">
                    <label>สถานะ</label>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="status" value="1" <?= ($member->mem_status == '1' ? 'checked' : '') ?> required>
                            <label> User,Member</label>
                        </div>
                        <div class="ui radio checkbox">
                            <input type="radio" name="status" value="0" <?= ($member->mem_status == '0' ? 'checked' : '') ?>> 
                            <label> Administrator</label>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
        <div class="field">
            <label>ที่อยู่</label>
            <textarea name="address"><?= $member->mem_address ?></textarea>
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
                <th>สกุล</th>
                <th>โทร</th>                
                <th>อีเมลล์</th>
                <th>สถานะ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listMember as $index => $mem) { ?>
                <tr>
                    <td><?= ($index + 1) ?></td>
                    <td><?= $mem->mem_fname ?></td>
                    <td><?= $mem->mem_lname ?></td>
                    <td><?= $mem->mem_phone ?></td>
                    <td><?= $mem->mem_email ?></td>
                    <td><?= $mem->mem_status_desc ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('member/index/' . $mem->mem_id) ?>" class="ui button small blue">แก้ไข</a>
                    </td>
                    <td>
                        <a onclick="return confirm('ยืนยันการลบ')" href="<?= Yii::app()->createUrl('member/memberDelete/' . $mem->mem_id) ?>" class="ui button small red">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<h2 class="ui top attached header">
    จัดการจังหวัด
    <a href="<?= Yii::app()->createUrl('sacred/indexProvince') ?>" class="ui button small blue"> 
        <i class="plus icon"></i> ข้อมูลใหม่
    </a>
</h2>
<div class="ui attached segment orange">
    <form class="ui form" method="post" action="<?= Yii::app()->createUrl('sacred/provinceSave') ?>">
        <div class="field">
            <label>ชื่อ</label>
            <input type="hidden" name="id" value="<?= $province->pro_id ?>">
            <input type="text" class="form-control" name="name_th" value="<?= $province->pro_name_th ?>" 
                   required autofocus placeholder="ชื่อ">
        </div>
        <div class="two fields">
            <div class="field">
                <label>ชื่ออังกฤษ</label>
                <input type="text" name="name_eng" value="<?= $province->pro_name_eng ?>" 
                       required autofocus placeholder="ชื่อ"/>
            </div>
            <div class="field">
                <label>ภูมิภาค</label>
                <select class="ui dropdown" name="region" required>
                    <?php foreach ($listRegion as $index => $region) { ?>
                        <?php if ($region->reg_id == $province->reg_id) { ?>
                            <option value="<?= $region->reg_id ?>" selected><?= $region->reg_name ?></option>
                        <?php } else { ?>
                            <option value="<?= $region->reg_id ?>"><?= $region->reg_name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
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
                <th>ภูมิภาค</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listProvince as $index => $province) { ?>
                <tr>
                    <td><?= $province->pro_id ?></td>
                    <td><?= $province->pro_name_th ?></td>
                    <td><?= $province->region->reg_name ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/indexProvince/' . $province->pro_id) ?>" class="ui button small blue labeled icon">
                           <i class="pencil icon"></i> แก้ไข
                        </a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/provinceDelete/' . $province->pro_id) ?>" class="ui button small red labeled icon" onclick="return confirm('ยืนยันการลบ')">
                           <i class="remove icon"></i>  ลบ
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

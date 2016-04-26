<h2 class="ui top attached header">
    ตั้งค่าการใช้งานระบบ
</h2>
<div class="ui attached segment orange">
    <form class="ui form" action="<?= Yii::app()->createUrl('System/SaveConfig') ?>" method="post">
        <?php foreach ($configs as $config) { ?>
            <div class="field">
                <label for="<?= $config->name ?>"><?= $config->label ?></label>
                <?php if ($config->name == 'image_resize') { ?>
                    <?php $percentResize = WebConfig::getPercentResize(); ?>
                    <select class=" ui dropdown" name="<?= $config->name ?>" id="<?= $config->name ?>">
                        <?php foreach ($percentResize as $key => $value) { ?>
                            <?php if ($key == $config->value) { ?>
                                <option value="<?= $key ?>" selected><?= $value ?></option>
                            <?php } else { ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                <?php } else { ?>
                    <input type="number" id="<?= $config->name; ?>" 
                           value="<?= $config->value; ?>" required 
                           name="<?= $config->name ?>">
                       <?php } ?>
                <label><?= $config->unit ?></label>
            </div>
        <?php } ?>
        <div class="actions">
           <button type="submit" class="ui button green"><i class="save icon"></i> บันทึก</button>
        </div>
    </form>
</div>
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
        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2 col-md-10 col-sm-10 col-xs-10">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-ok"></i> บันทึก
                </button>
            </div>
        </div>
    </form>
</div>
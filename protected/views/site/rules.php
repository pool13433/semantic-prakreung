<h2 class="ui top attached header">
    ข้อตกลงการสมัครสมาชิก
    เว็บไซต์ PrakruengMuengThai
</h2>
<div class="ui attached segment orange">
    <div class="ui form">
        <div class="ui ordered list huge">
            <?php foreach ($listRules as $index => $rules) { ?>
                <a class="item"><?= $rules->rul_desc ?></a>
            <?php } ?>
        </div>

        <div class="ui horizontal divider">
            <div class="ui checked checkbox">
                <input checked="" type="checkbox" id="chkRules" >
                <label>ยอมรับข้อตกลงการใช้งาน</label>
            </div>
        </div>
        <div class="actions ui center aligned segment">
            <a id="btnSubmitRules" disabled href="javascript:void(0)" 
               class="ui button green">
                <i class="glyphicon glyphicon-ok-sign"></i><strong style="font-size: 1.4em"> ตกลง</strong>
            </a>
            <button type="reset" class="ui button orange"><i class="remove icon"></i> ล้างค่า</button>
            <?php
            $finalUrl = str_replace("//", "//www.", Yii::app()->getBaseUrl(true)) . '/site/login';
            $finalUrl = str_replace('www.www.', 'www.', $finalUrl);
            ?>
            <a class=" ui button green" href="<?= $finalUrl ?>" >
                <i class="sign in icon"></i>
                เข้าระบบ
            </a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        submitRules();
        $('#chkRules').on('click', function () {
            submitRules();
        });
    });
    function submitRules() {
        if ($('#chkRules').is(':checked')) {
            $('#btnSubmitRules').attr('disabled', false).attr('href', '<?= Yii::app()->createUrl('site/register') ?>');
        } else {
            $('#btnSubmitRules').attr('disabled', true).attr('href', 'javascript:void(0)');
        }
    }
</script>

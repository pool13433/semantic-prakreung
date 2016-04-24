<div class="">
    <h5 class="ui top attached header">
        ค้นหาพระเครื่องทั่วเมืองไทย
    </h5>
    <div class="ui attached segment orange">
        <form name="form-criteria" id="form-criteria" class="ui form">
            <div class="field">
                <label class="">ชื่อ,อื่นๆ</label>                
                <input type="text" id="freedom" class="form-control" placeholder="ชื่อ,อื่นๆ"/>                                
            </div>
            <hr/>
            <div class="field">
                <label class="">ช่วงราคา</label>                
                <input type="text" id="price_begin" class="form-control" placeholder="ราคาเริ่มต้น"/>                                
            </div>
            <div class="field">          
                <input type="text" id="price_end" class="form-control" placeholder="ราคาสิ้นสุด"/>                
            </div>
            <hr/>
            <div class="field">
                <label class="">ปีที่จัดสร้าง</label>               
                <input type="text" id="born_begin" maxlength="4" class="form-control" placeholder="ปีเริ่มต้น"/>                
            </div>
            <div class="field">                
                <input type="text" id="born_end" maxlength="4" class="form-control" placeholder="ปีสิ้นสุด"/>                
            </div>
            <hr/>
            <button id="btnSubmit" type="button" class="btn btn-warning btn-block">
                <i class="fa fa-search"></i> ค้นหา
            </button>
        </form>
    </div>



    <h5 class="ui top attached header">
        ภูมิภาคของจังหวัดที่จัดสร้างวัตถุ
    </h5>
    <div class="ui attached segment orange">
        <div class="ui styled fluid accordion">
            <?php foreach ($listRegion as $index => $region) { ?>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?= $region->reg_name ?> (<?= $region->cnt ?> จังหวัด)
                </div>
                <div class="content">
                    <div class="ui form">
                        <div class="grouped fields">
                            <?php
                            $listProvinceByRegion = Province::model()->findAllByAttributes(array('reg_id' => $region->reg_id), array('order' => 'pro_name_th'));
                            foreach ($listProvinceByRegion as $key => $province) {
                                ?>
                                <div class="field">
                                    <div class="ui checkbox">
                                        <input name="size" value="<?= $province->pro_id ?>" type="checkbox">
                                        <label><?= $province->pro_name_th ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <h5 class="ui top attached header">
        ประเภทวัตถุมงคล
    </h5>
    <div class="ui attached segment orange">
        <div class="ui form">
            <div class="grouped fields">
                <?php foreach ($listSacredType as $index => $type) { ?>
                    <div class="field">
                        <div class="ui checkbox">
                            <input name="size" value="<?= $type['type_id'] ?>" type="checkbox">
                            <label><?= $type['type_name'] ?></label>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <h5 class="ui top attached header">
        พระเครื่องมาใหม่
    </h5>
    <div class="ui attached segment orange">
        <div class="ui middle aligned divided list">
            <?php foreach ($listSacredObjectLastInsert as $index => $objectLast) { ?>
                <a class="item" href="<?= Yii::app()->createUrl('site/detail/' . $objectLast->obj_id) ?>">                
                    <i class="eye icon"></i>
                    <div class="content">
                        <div class="header"><?= $objectLast->obj_name ?></div>
                        <?= $objectLast->obj_updatedate ?>
                    </div>
                </a>
            <?php } ?>

        </div>
    </div>

    <h5 class="ui top attached header">
        สมาชิกมาใหม่
    </h5>
    <div class="ui attached segment orange">
        <div class="ui middle aligned divided list">
            <?php foreach ($listMemberLastInsert as $index => $objectLast) { ?>
                <a class="item" href="<?= Yii::app()->createUrl('site/index', array('user' => $objectLast->mem_id)) ?>">                
                    <i class="eye icon"></i>
                    <div class="content">
                        <div class="header"><?= empty($objectLast->mem_fname) ? $objectLast->mem_username : $objectLast->mem_fname ?></div>
                        <?= $objectLast->mem_updatedate ?>
                    </div>
                </a>
            <?php } ?>

        </div>
    </div>

    <h5 class="ui top attached header">
        ติดตาม Facebbok Fanpage
    </h5>
    <div class="ui attached segment orange">
        <div class="fb-page" data-href="https://www.facebook.com/sudyodprakruangcom-168585533519090/" data-tabs="timeline" data-width="300" data-height="600" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"></div>
    </div>
    <div id="fb-root"></div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.special.cards .image').dimmer({
            on: 'hover'
        });
        $('.cards .card .image img').visibility({
            type: 'image',
            transition: 'pulse',
            reverse: true,
            interval: 200,
            duration: 1000,
            onTopVisible: function (calculations) {
                if (calculations.topVisible) {

                }
            },
        });
        $('.accordion').accordion({});
    });

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.5&appId=375551315815765";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>
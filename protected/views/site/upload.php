<?php
$baseUrl = Yii::app()->baseUrl;
?>
<h3 class="ui top attached header">
    ลงข้อมูลพระเครื่องเพื่อปล่อยเช่า
</h3>
<div class="ui attached segment orange">
    <form class="ui form" id="formUpload" name="formUpload" method="post" action="<?= Yii::app()->createUrl('site/upload') ?>" enctype="multipart/form-data">
        <div class="field">
            <label>ชื่อสินค้า</label>
            <input type="text" name="name" id="name"  value="<?= $sacredObject->obj_name ?>"/>
        </div>
        <div class="field">
            <label>จัดอยู่ในหมวดหมู่</label>
            <select class="ui dropdown search" name="type" id="type">             
                <option value="" selected>-- กรุณาเลือก --</option>
                <?php foreach ($listSacredType as $index => $type) { ?>
                    <?php if ($type->type_id == $sacredObject->type_id) { ?>
                        <option value="<?= $type->type_id ?>" selected><?= $type->type_name ?></option>
                    <?php } else { ?>
                        <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="field">
            <label>ราคาเช่า</label>
            <input type="number" name="price" id="price" value="<?= $sacredObject->obj_price ?>"/>
        </div>
        <div class="field">
            <label>ปี พ.ศ. ที่จัดสร้าง</label>
            <input type="text" name="born" id="born"  value="<?= $sacredObject->obj_born ?>" />
        </div>
        <div class="field">
            <label>สถานที่รับสินค้า</label>
            <textarea rows="2" name="location" id="location"><?= $sacredObject->obj_location ?></textarea>                    
        </div>
        <div class="field">
            <label>พระถูกสร้างที่จังหวัด</label>
            <select class="ui dropdown search" name="province" id="province">
                <option value="" selected>-- กรุณาเลือก --</option>
                <?php foreach ($listRegion as $index => $region) { ?>
                    <optgroup label=" ภูมิภาค <?= $region->reg_name ?>" style="font-weight: bold;">
                        <?php
                        $listProvince = Province::model()->findAll(array(
                            'condition' => 'reg_id = ' . $region->reg_id,
                            'order' => 'pro_name_th'
                        ));
                        ?>
                        <?php foreach ($listProvince as $index => $province) { ?>
                            <?php if ($province->pro_id == $sacredObject->pro_id) { ?>
                                <option value="<?= $province->pro_id ?>" selected><?= $province->pro_name_th ?></option>
                            <?php } else { ?>
                                <option value="<?= $province->pro_id ?>"><?= $province->pro_name_th ?></option>
                            <?php } ?>
                        <?php } ?>
                    </optgroup>
                <?php } ?>
            </select>
        </div>
        <div class="field">
            <label>รูปหลัก</label>
            <div class="col-lg-3 col-md-6 col-sm-3 col-xs-7 box-browse-upload">
                <?php
                $require = '';
                $pathImage = $baseUrl . '/images/image_main.png';
                if (!empty($sacredObject->obj_img)) {
                    $pathImage = $baseUrl . '/images' . $sacredObject->obj_img;
                    $require = '';
                }
                ?>
                <input type="file" id="fileMain" name="fileMain" <?= $require ?> style="display: none;"/>
                <a class="ui image large">
                    <img id="imgMain" class="img-rounded" style="max-width: 60%;" src="<?= $pathImage ?>"/>
                </a>
            </div>   
        </div>
        <div class="field">
            <label>รูปอื่นๆ ที่เกี่ยวข้อง สูงสุด 5 ไฟล์</label>
            <div class="box-browse-upload  teal ui label fluid">
                <div class="dropzone" id="my-awesome-dropzone" style="font-size:1.5em;">
                    <h3 class="dropzone-previews ui"></h3>
                    <i class="upload icon"></i>กดเลือกภาพ
                    <div class="fallback">
                        <input name="file" type="file" multiple class="form-control"/>
                    </div>                        
                </div>
            </div>
        </div>
        <div class="field">
            <label>รูปภาพเดิม</label>
            <div class="ui tiny images">
                <?php if (!empty($sacredObject->obj_id)) { ?>
                    <?php $relateImage = SacredObjectImg::model()->findAllByAttributes(array('obj_id' => $sacredObject->obj_id)) ?>
                    <?php foreach ($relateImage as $index => $image) { ?>
                        <img class="ui image" src="<?= $baseUrl . '/images' . $image->img_name ?>">
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="field">
            <label>อธิบายเพิ่มเติม</label>
            <textarea rows="5" id="comment" name="comment"><?= $sacredObject->obj_comment ?></textarea>
        </div>
        <div class="ui actions center aligned segment">
            <button type="submit" class="ui button green submit" id="submit-all">
                <i class="save icon"></i> ประกาศปล่อยเช่าทันที
            </button>
            <button type="reset" class="ui button orange">
                <i class="remove icon"></i> เคลีย์ข้อมูล
            </button>
        </div>
    </form>
</div>

<script type="text/javascript">
    var sizeUpload = <?= $sizeUpload ?>;
    var MaximumSizeOfFile = (1024 * 1024) * sizeUpload;
    // The camelized version of the ID of the form element
    var myDropzone = {};
    Dropzone.options.myAwesomeDropzone = {
        // set following configuration
        url: '<?= Yii::app()->createUrl('site/upload') ?>',
        paramName: "fileOther", // The name that will be used to transfer the file
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 10,
        maxFiles: 5,
        addRemoveLinks: true,
        //maxFilesize: sizeUpload, // MB
        previewsContainer: ".dropzone-previews",
        dictRemoveFile: "Remove",
        dictCancelUpload: "Cancel",
        dictDefaultMessage: "เลือกรูปภาพพระเครื่องเพื่ออัพโหลด",
        dictFileTooBig: "Image size is too big. Max size: 10mb.",
        dictMaxFilesExceeded: "Only 10 images allowed per upload.",
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
        // The setting up of the dropzone
        init: function () {
            myDropzone = this;
            // Upload images when submit button is clicked.
            // sending data
            myDropzone.on("sending", function (file, xhr, data) {
                data.append("name", $('#name').val());
                data.append("type", $('#type').val());
                data.append("price", $('#price').val());
                data.append("born", $('#born').val());
                data.append("location", $('#location').val());
                data.append("province", $('#province').val());
                data.append("comment", $('#comment').val());
                data.append("id", $('#id').val());
                data.append("fileMain", $("#fileMain")[0].files[0]);

            });
            myDropzone.on("maxfilesexceeded", function (file) {
                this.removeFile(file);
            });
            myDropzone.on("totaluploadprogress", function (progress) {
                //document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
            });
            // Refresh page when all images are uploaded
            myDropzone.on("complete", function (file) {
                if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                    //window.location.href = '<?= Yii::app()->createUrl('site/index') ?>';
                }
            });
        },
        success: function (file, response) {
            console.log(response);
            var res = eval ("(" + response + ")"); //JSON.parse(response);
            if (!res.status) {
                alert(res.message);
            }
            window.location.href = res.url;
        }
    };
    $(function () {
        $('#imgMain').on('click', function () {
            $('#fileMain').trigger('click');
        });
        $("#fileMain").change(function () {
            simulateImage(this);
        });
        initForm();
        validateFormUpload();
    })
    function validateFormUpload() {
        $('.dropdown').dropdown();

        $('form[name="formUpload"]').form({
            inline: true,
            transition: 'scale',
            on: 'blur',
            fields: {
                name: {
                    identifier: 'name',
                    rules: [
                        {type: 'empty', prompt: 'กรุณากรอกข้อมูล ชื่อสินค้า'},
                        {type: 'maxLength[35]', prompt: 'กรุณากรอกตัวเลขเท่านั้น'},
                    ]
                },
                type: {
                    identifier: 'type',
                    rules: [
                        {type: 'empty', prompt: 'กรุณาเลือก หมวดหมู่'}
                    ]
                },
                price: {
                    identifier: 'price',
                    rules: [
                        {type: 'empty', prompt: 'กรุณากรอกข้อมูล ราคาสินค้า'},
                        {type: 'integer', prompt: 'กรุณากรอกตัวเลขเท่านั้น'}
                    ]
                },
                born: {
                    identifier: 'born',
                    rules: [
                        {type: 'empty', prompt: 'กรุณากรอกข้อมูล password'},
                        {type: 'integer', prompt: 'กรุณากรอกตัวเลขเท่านั้น'},
                        {type: 'maxLength[4]', prompt: 'กรุณากรอกตัวเลข 4 ตำแหน่งเท่านั้น'},
                    ]
                },
                province: {
                    identifier: 'province',
                    rules: [
                        {type: 'empty', prompt: 'กรุณาเลือกจังหวัดที่เริ่มจัดสร้าง'}
                    ]
                },
                fileMain: {
                    identifier: 'fileMain',
                    rules: [
                        {type: 'empty', prompt: 'กรุณาเลือกภาพ'}
                    ]
                },
            },
            onSuccess: function (event, fields) {
                console.log(event);
                event.preventDefault();
                if (myDropzone.getQueuedFiles().length > 0) {
                    console.log(' == myDropzone.processQueue ==');
                    myDropzone.processQueue();
                } else {
                    console.log(' == ajax ==');
                    $.ajax({
                        url: '<?= Yii::app()->createUrl('site/upload') ?>',
                        type: 'POST',
                        data: new FormData($('#formUpload')[0]),
                        dataType: 'json',
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            if (!response.status) {
                                alert(response.message);
                            }
                            window.location.href = response.url;
                        },
                        error: function () {
                            alert("error in ajax form submission");
                        }
                    });
                }
                return false;
            }
        });

    }

    function initForm() {
        var spans = $('form div.panel div.form-group span.label');
        $.each(spans, function (index, span) {
            $(span).css({'display': 'none'});
        });
    }

    function removeImage(imageId) {
        var isConfirm = confirm('ยืนยันการลบข้อมูลรูปนี้');
        if (isConfirm) {
            $.post('<?= Yii::app()->createUrl('Helper/removeImage') ?>', {
                id: imageId
            }, function (response) {
                if (response.status) {
                    window.location.reload();
                }
            }, 'json');
        }
    }

</script>

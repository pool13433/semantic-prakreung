<?php
$baseUrl = Yii::app()->baseUrl;
?>
<h2 class="ui top attached header">
    จัดการข่าวประชาสัมพันธ์
    <a href="<?= Yii::app()->createUrl('sacred/indexNews') ?>" class="ui button small blue"> 
        <i class="plus icon"></i> ข้อมูลใหม่
    </a>
</h2>
<div class="ui attached segment orange">
    <form class="ui form" enctype="multipart/form-data" name="form-news">
        <div class="field">
            <label>ข้อมูล</label>
            <input type="hidden" name="id" value="<?= $news->news_id ?>">
            <input type="text" class="form-control" name="title" value="<?= $news->news_title ?>" required/>
        </div>
        <div class="field">
            <label>รายละเอียด</label>
            <input type="hidden" name="detail" value="<?= $news->news_detail ?>"/>
            <textarea cols="50" id="editor1" name="editor1" rows="10"><?= $news->news_detail ?></textarea>
        </div>
        <div class="field">
            <label>ภาพ</label>
            <div class="box-browse-upload">
                <div class="dropzone" id="my-awesome-dropzone" >
                    <div class="dropzone-previews" style="max-width: 100%"></div>
                    <div class="fallback">
                        <input name="file" type="file" multiple class="ui button small blue"/>
                    </div>                        
                </div>
            </div>
        </div>
        <div class="field">
            <label>ภาพเดิม</label>
            <div class="ui images">
                <?php if (!empty($news->news_id)) { ?>
                    <?php $imgs = SacredNewsImg::model()->findAllByAttributes(array('news_id' => $news->news_id)) ?>
                    <?php foreach ($imgs as $index => $image) { ?>
                        <div class="ui small image image-container" onclick="removeImage(<?= $image->img_id ?>)">
                            <img src="<?= $baseUrl . '/images' . $image->img_name ?>" />
                            <div class="after" title="ลบ">
                                <span class="zoom">
                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                </span>
                            </div>
                        </div>
                    <?php } ?> 
                <?php } ?>
            </div>
        </div>    
        <div class="actions">
            <button type="submit" class="ui button green" id="btnSaveNews"><i class="save icon"></i> บันทึก</button>
            <button type="reset" class="ui button orange"><i class="remove icon"></i> ล้างค่า</button>
        </div>
    </form>
</div>
<div class="ui attached segment orange">
    <table class="ui celled striped table orange">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>หัวข้อ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listNews as $index => $news) { ?>
                <tr>
                    <td><?= $news->news_id ?></td>
                    <td><?= $news->news_title ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/indexNews/' . $news->news_id) ?>" class="ui button small blue labeled icon">
                            <i class="pencil icon"></i> แก้ไข
                        </a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/newsDelete/' . $news->news_id) ?>" class="ui button small red  labeled icon" onclick="return confirm('ยืนยันการลบ')">
                            <i class="remove icon"></i> ลบ
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    var urlUpload = '<?= Yii::app()->createUrl('sacred/newsSave') ?>';

    // The camelized version of the ID of the form element
    var myDropzone = {};
    Dropzone.options.myAwesomeDropzone = {
        // set following configuration
        url: urlUpload,
        paramName: "image", // The name that will be used to transfer the file
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 10,
        maxFiles: 10,
        maxFilesize: sizeUpload, // MB
        addRemoveLinks: true,
        previewsContainer: ".dropzone-previews",
        dictRemoveFile: "ลบ",
        dictCancelUpload: "ยกเลิก",
        dictDefaultMessage: "Drop the images you want to upload here",
        dictFileTooBig: "ขนาดไฟล์อัพโหลด ใหญ่เกินไป จำกัดไว้แค่ " + sizeUpload + " MB เท่านั้น",
        //dictMaxFilesExceeded: "Only 10 images allowed per upload.",
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
        // The setting up of the dropzone
        init: function () {
            myDropzone = this;
            // Upload images when submit button is clicked.
            $("#btnSaveNews").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('form[name="form-news"]').submit();
            });
            // sending data
            myDropzone.on("sending", function (file, xhr, data) {
                data.append("id", $('input[name="id"]').val());
                data.append("title", $('input[name="title"]').val());
                data.append("detail", $('input[name="detail"]').val());
            });

            myDropzone.on("totaluploadprogress", function (progress) {

            });
            // Refresh page when all images are uploaded
            myDropzone.on("complete", function (file) {

            });
            myDropzone.on("addedfile", function (file) {
                console.log(file);
                if (file.size > MaximumSizeOfFile) {
                    alert('ขนาดไฟล์ใหญ่เกินไป จะไม่สามารถอัพโหลดได้');
                    this.removeFile(file);
                }
            });
        },
        accept: function (file, done) {
            if (file.name == "justinbieber.jpg") {
                done("Naha, you don't.");
            }
            done();
        },
        success: function (file, response) {
            console.log(response);
            var res = JSON.parse(response);
            if (!res.status) {
                alert(res.message);
            } else {
                window.location.href = res.url;
            }
        }
    };

    $(function () {
        validateFormUpload();
        initCkiditor();
    });

    function validateFormUpload() {
        $('form[name="form-news"]').validate({
            submitHandler: function (form) {
                var uploadSize = myDropzone.getUploadingFiles().length;
                var queuedSize = myDropzone.getQueuedFiles().length;
                console.log('uploadSize ::==' + uploadSize + ' queuedSize ::==' + queuedSize);
                if (uploadSize === 0 && queuedSize === 0) {
                    $.post(urlUpload, $(form).serialize(), function (resp) {
                        console.log(resp);
                        window.location.href = resp.url;
                    }, 'json');
                } else {
                    myDropzone.processQueue();
                }
            }
        });
    }
    function initCkiditor() {
        CKEDITOR.replace('editor1', {
            skin: 'moono', //กำหนดรูปแบบหน้าตา  
            toolbar: 'Custom'
        }).on('change', function () {
            var data = this.getData();
            $('input[name=detail]').val(data);
        });
    }

    function removeImage(imageId) {
        var isConfirm = confirm('ยืนยันการลบข้อมูลรูปนี้');
        if (isConfirm) {
            $.post('<?= Yii::app()->createUrl('Helper/removeNewsImage') ?>', {
                id: imageId
            }, function (response) {
                if (response.status) {
                    window.location.reload();
                }
            }, 'json');
        }
    }
</script>

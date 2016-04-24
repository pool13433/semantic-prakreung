<?php
$baseUrl = Yii::app()->baseUrl;
?>
<fieldset>
    <legend>จัดการข่าวประชาสัมพันธ์
        <a href="<?= Yii::app()->createUrl('sacred/indexNews') ?>" class="btn btn-primary btn-sm"> 
            <i class=" glyphicon glyphicon-plus"></i> ข้อมูลใหม่
        </a>
    </legend>
    <form class="form-horizontal" enctype="multipart/form-data" name="form-news">
        <div class="form-group">
            <label class="col-sm-2 control-label">ข้อมูล</label>
            <div class="col-sm-10">
                <input type="hidden" name="id" value="<?= $news->news_id ?>">
                <input type="text" class="form-control" name="title" value="<?= $news->news_title ?>" required/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">รายละเอียด</label>
            <div class="col-sm-10">
                <input type="hidden" name="detail" value="<?= $news->news_detail ?>"/>
                <textarea cols="50" id="editor1" name="editor1" rows="10"><?= $news->news_detail ?></textarea>  
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12">ภาพ</label>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 box-browse-upload">
                <div class="dropzone" id="my-awesome-dropzone" >
                    <div class="dropzone-previews" style="max-width: 100%"></div>
                    <div class="fallback">
                        <input name="file" type="file" multiple class="form-control"/>
                    </div>                        
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="row">
                    <h2 class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12">ภาพเดิม</h2>
                </div>
                <div class="row">
                    <?php if (!empty($news->news_id)) { ?>
                        <?php $imgs = SacredNewsImg::model()->findAllByAttributes(array('news_id' => $news->news_id)) ?>
                        <?php foreach ($imgs as $index => $image) { ?>
                            <div class="col-lg-6 image-container" onclick="removeImage(<?= $image->img_id ?>)">
                                <img src="<?= $baseUrl . '/images' . $image->img_name ?>" class="img-thumbnail"/>
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
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-success" id="btnSaveNews">
                    <i class="glyphicon glyphicon-saved"></i> บันทึก
                </button>
            </div>
        </div>
    </form>
</fieldset>
<fieldset>
    <legend>ข้อมูลประเภทวัตถุมงคล</legend>
    <table class="table table-bordered table-striped">
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
                        <a href="<?= Yii::app()->createUrl('sacred/indexNews/' . $news->news_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/newsDelete/' . $news->news_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>

<script type="text/javascript">
    var urlUpload = '<?= Yii::app()->createUrl('sacred/newsSave') ?>';
    var sizeUpload = 3;
    var MaximumSizeOfFile = (1024 * 1024) * sizeUpload;
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

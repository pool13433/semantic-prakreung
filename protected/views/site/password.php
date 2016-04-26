<h2 class="ui top attached header">
    แก้ไชช้อมูลรหัสผ่านใหม่
</h2>
<div class="ui attached segment orange">
    <form  id="form-change" class="ui form">
        <div class="field">
            <label for="username">username<small> *</small></label>
            <input type="hidden" name="id" value="<?= $member->mem_id ?>">
            <input type="text" readonly name="username" id="username" value="<?= $member->mem_username ?>">
        </div>
        <div class="field">
            <label for="password">รหัสผ่าน เก่า <small> *</small></label>
            <input type="password" name="passwordOld" id="passwordOld"  value="<?= $member->mem_password ?>">
        </div>
        <div class="two fields">
            <div class="field">
                <label for="password">รหัสผ่าน ใหม่<small> *</small></label>
                <input type="password" name="passwordNew" id="passwordNew"  value="<?= $member->mem_password ?>">
            </div>
            <div class="field">
                <label for="confirm_password" >ยืนยันรหัสผ่านใหม่ อีกครั้ง <small> *</small></label>
                <input type="password" name="confirmPasswordNew" id="confirmPasswordNew"  value="<?= $member->mem_password ?>">
            </div>
        </div>
        <div class="actions">
            <button type="submit" class="ui button green"><i class="save icon"></i> เปลี่ยนรหัสผ่าน</button>
            <button type="reset" class="ui button orange"><i class="remove icon"></i> ล้างค่า</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#passwordOld').focusout(function () {
            var elePassword = this
            var passwordLength = $(this).val().length;
            if (passwordLength > 0) {
                $.post('<?= Yii::app()->createUrl('Helper/CheckPasswordOld') ?>', {
                    username: $('#username').val(),
                    password: $('#passwordOld').val(),
                }, function (resp) {
                    if (!resp.status) {
                        alert('รหัสผ่านเก่าไม่ถูกต้องกรุณากรอกอีกครั้ง');
                        $(elePassword).val('');
                        $(elePassword).focus();
                    }
                }, 'json')
            }
        });

        $('#form-change').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                username: "required",
                passwordOld: "required",
                passwordNew: {
                    required: true,
                    equalTo: '#confirmPasswordNew'
                },
                confirmPasswordNew: {
                    required: true,
                    equalTo: '#passwordNew'
                },
            },
            messages: {
                username: "กรุณากรอก username",
                passwordOld: "กรุณากรอก รหัสผ่านเก่า",
                passwordNew: {
                    required: "กรุณากรอก รหัสใหม่",
                    equalTo: 'กรุณากรอก รหัสใหม่ ให้ตรงกัน'
                },
                confirmPasswordNew: {
                    required: "กรุณากรอก ยืนยันรหัสผ่านใหม่",
                    equalTo: 'กรุณากรอก ยืนยันรหัสผ่านใหม่ ให้ตรงกัน'
                },
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '<?= Yii::app()->createUrl('Helper/SaveChanePasswordNew') ?>',
                    data: $(form).serialize(),
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.url;
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {

                    }
                });
            }
        });

    });
</script>
<div class="ui small menu fixed stackable">
<!--    <a href="#" class="sidebar-toggle active item" data-visible="open">
        <i class="bordered inverted teal sidebar icon large"></i>
    </a>-->
    <a class="item" href="<?= Yii::app()->createUrl('site/index') ?>">
        <i class="home icon large circular"></i>
        สุดยอดพระเครื่อง
    </a>
    <a class="item" href="<?= Yii::app()->createUrl('site/news') ?>">
        <i class="sitemap icon"></i>
        ข่าวสารเกี่ยวกับพระเครื่อง
    </a>
    <a class="item" href="<?= Yii::app()->createUrl('site/upload') ?>">
        <i class="chart icon"></i>
        อยากปล่อยเช่า
    </a>
    <div class="right menu">
        <?php if (empty(Yii::app()->session['member'])) { ?>
            <?php
            $finalUrl = str_replace("//", "//www.", Yii::app()->getBaseUrl(true)) . '/site/login';
            $finalUrl = str_replace('www.www.', 'www.', $finalUrl);
            ?>
            <div class="item">
                <a href="<?= $finalUrl ?>" class=" ui button green">
                    <i class="sign in icon"></i>
                    เข้าระบบ
                </a>   
            </div>      
            <div  class="item">
                <a href="<?= Yii::app()->createUrl('site/rules') ?>" class="ui primary button">
                    <i class="add user icon"></i> ลงทะเบียน
                </a>
            </div>
        <?php } else { ?>
            <?php $member = Yii::app()->session['member'] ?>
            <div class="ui dropdown item">
                ข้อมูลหลัก <i class="dropdown icon"></i>
                <div class="menu">
                    <a  class="item" href="<?= Yii::app()->createUrl('sacred/index') ?>" ><i class="sitemap icon"></i> พระเครื่อง</a>
                    <a class="item" href="<?= Yii::app()->createUrl('sacred/indexType') ?>"><i class="setting icon"></i> ประเภทพระเครื่อง</a>
                    <a class="item ui divider"></a>
                    <a class="item" href="<?= Yii::app()->createUrl('sacred/indexRegion') ?>"><i class="certificate icon"></i> ภูมิภาค</a>
                    <a class="item" href="<?= Yii::app()->createUrl('sacred/indexProvince') ?>"><i class="cube icon"></i> จังหวัดกำเนิด</a>
                    <a class="item ui divider"></a>
                    <a class="item" href="<?= Yii::app()->createUrl('sacred/indexNews') ?>"><i class="asterisk icon"></i> ข่าว</a>
                    <a class="item" href="<?= Yii::app()->createUrl('sacred/indexRules') ?>"><i class="circle icon"></i> กฏกติกา</a>
                    <a class="item ui divider"></a>
                    <a class="item" href="<?= Yii::app()->createUrl('system/config') ?>"><i class="circle notched icon"></i> ตั้งค่าระบบ</a>                
                </div>
            </div>
            <div class="ui dropdown item">
                ข้อมูลสมาชิก<i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="<?= Yii::app()->createUrl('member/index') ?>"> <i class="user icon"></i> สมาชิก</a>
                    <a class="item" href="<?= Yii::app()->createUrl('member/indexLevel') ?>"><i class="student icon"></i> ระดับสมาชิก</a>                
                </div>
            </div>
            <div class="ui dropdown item">
                <div class="ui button green">
                    <i class="user icon"></i> คุณ <?php echo Yii::app()->session['member']->mem_fname ?> <i class="dropdown icon"></i>
                </div>
                <div class="menu">
                    <a class="item" href="<?= Yii::app()->createUrl('site/usersacredlist') ?>">
                        <i class="sitemap icon"></i>  พระเครื่องที่ปล่อยเช่า
                    </a>
                    <a class="item" href="<?= Yii::app()->createUrl('site/userfavoritelist') ?>">
                        <i class="like icon"></i> พระเครื่องที่ชื่อชอบ
                    </a>
                    <a class="item" href="<?= Yii::app()->createUrl('site/userprofile') ?>">
                        <i class="edit icon"></i> แก้ไขข้อมูลส่วนตัว
                    </a>
                    <?php if (empty($member->facebook_id)) { ?>
                        <a class="item" href="<?= Yii::app()->createUrl('site/passwordChange') ?>">
                            <i class="lock icon"></i> แก้ไขข้อมูลรหัสผ่าน
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="item">
                <a class="ui primary button" id="handleLogout">
                    <i class="sign out icon"></i> ออกจากระบบ
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<?php $config = WebConfig::model()->findByAttributes(array('name' => 'facebook_appid')); ?>
<script type="text/javascript">




    var facebookConnect = false;
    /*
     * http://code.runnable.com/UTlPL1-f2W1TAAAZ/get-user-details-email-address-with-javascript-sdk-for-facebook
     * @type Array|@call;join
     */
    var permissions = [
        'email',
        'user_birthday',
        'user_likes'
    ].join(',');
    var fields = [
        'id',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'locale',
        'languages',
        'link',
        //'username',
        'third_party_id',
        'installed',
        'timezone',
        'updated_time',
        'verified',
        'age_range',
        'bio',
        'birthday'
    ].join(',');

    $(document).ready(function () {
        handleLogout();
    });



    window.fbAsyncInit = function () {
        //SDK loaded, initialize it
        FB.init({
            appId: '<?= $config->value ?>',
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true  // parse XFBML
        });
        //check user session and refresh it
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                //user is authorized
                var accessToken = response.authResponse.accessToken;
                if (accessToken) {
                    facebookConnect = true;
                    FB.logout(function (response) {
                        // user is now logged out
                        console.log('response ::' + response);
                    });
                    handleLogout();
                }
            } else {
                //user is not authorized
            }
        });
    };
    function getUserData() {

        FB.api('/me', {fields: fields}, function (response) {
            console.log(JSON.stringify(response, null, '\t'));
            //document.getElementById('response').innerHTML = 'Hello ' + response.name;
            $.post('<?= Yii::app()->createUrl('site/FacebookAuthorize') ?>', response, function (authorize) {
                if (authorize.status) {
                    window.location.href = authorize.url;
                } else {
                    alert(authorize.message);
                }
            }, 'json');
        });
    }

    function handleLogout() {
        $('#handleLogout').on('click', function () {
            var isConf = confirm('ยืนยันการออกจากระบบ');
            if (isConf) {

                window.location.href = '<?= Yii::app()->createUrl('site/logout') ?>';
            }
        });
    }



    //load the JavaScript SDK
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = '<?= Yii::app()->baseUrl . '/js/facebookSDK.js' ?>'; //"//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    /*
     * *************************** Handle Facebook Login *********************************
     */
</script>
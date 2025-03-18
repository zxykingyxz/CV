<style>
    .box-signin-mx {
        min-width: 350px;
        margin: 0 auto;
        padding: 15px;
        background-color: #eab741;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 8px
    }

    input[data-login] {
        border: 0;
        background-color: #000;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: normal;
        height: 35px;
        color: #fff;
        border-radius: 4px;
        margin-top: 10px;
    }

    .input-group {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-align: stretch;
        align-items: stretch;
        width: 100%;
    }

    .input-group>.form-control {
        position: relative;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        width: 1%;
        margin-bottom: 0;
    }

    .input-group>.form-control::placeholder {
        font-size: 14px;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 37px;
        padding: 0px 10px;
        font-size: 14px !important;
        font-weight: 400;
        line-height: 1.5;
        /* color: #495057; */
        background-color: #fff;
        background-clip: padding-box;
        border: 0;
        border-radius: 0;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .input-group .login-input-group-append .input-group-text {
        border: 1px solid #fff !important;
        border-right: 0px !important;
    }

    .input-group-text {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding: 0px 15px;
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: 400;
        height: 35px;
        line-height: 1.5;
        color: #495057;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #fff;
        border-radius: .25rem;
    }

    .input-group .input-group-text {
        color: #999;
        background-color: #fff;
        margin-right: 2px;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .input-group>.input-group-append:last-child>.btn:not(:last-child):not(.dropdown-toggle),
    .input-group>.input-group-append:last-child>.input-group-text:not(:last-child),
    .input-group>.input-group-append:not(:last-child)>.btn,
    .input-group>.input-group-append:not(:last-child)>.input-group-text,
    .input-group>.input-group-prepend>.btn,
    .input-group>.input-group-prepend>.input-group-text {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .show-password {
        border-radius: 0;
        border: 0;
        height: 37px;
        margin-left: 2px;
    }

    .header {
        text-transform: uppercase;
        font-size: 20px;
        color: #fff;
        text-align: center;
        font-weight: 700;
        padding: 8px;
        border-radius: 0px;

    }

    .form-button {
        text-align: center;
    }

    .form-group-signin {
        margin-bottom: 15px;
    }

    input[data-login]:hover {
        background-color: #2990bb;
        color: #fff;
    }

    .cs-pointer {
        cursor: pointer;
    }

    .justify-content-around {
        -ms-flex-pack: distribute !important;
        justify-content: space-around !important;
    }

    .d-flex {
        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;
    }

    .text-white {
        color: #fff;
    }

    .text-black {
        color: #000;
    }

    .text-decoration {
        text-decode
    }

    .jq-toast-single {
        width: auto !important;
    }
</style>
<main>
    <section class="section-signin clearfix">
        <div class="box-signin-mx">
            <div class="header">
                <span>Đăng nhập quản trị</span>
            </div>
            <div class="box-input-signin">
                <div class="form-group-signin mt10">
                    <div class="input-group">
                        <div class="input-group-append login-input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập">
                    </div>
                </div>
                <div class="form-group-signin">
                    <div class="input-group">
                        <div class="input-group-append login-input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text cs-pointer show-password">
                                <span class="fa fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group-signin form-button">
                    <input class="btn-login" onclick="login('username','password')" data-login="" type="button" value="Đăng nhập" />
                </div>
                <div class="d-flex justify-content-around">
                    <div>
                        <a href="http://<?= $config_url ?>" target="_blank" class="text-black"><i class="far fa-share"></i>&nbsp;Vào website</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="forget-password">
        <div class="box-forget-password" style="position:relative">
            <div class="box-logo text-center">
                <a href="index.html" title="logo"> <img src="images/logo.png" alt="" width="170"
                        <?= ($config['logo'] == true) ? 'class="none"' : '' ?> /> </a>
            </div>
            <button class="close">X</button>
            <div class="box-text" style="margin-top:30px;color:#fff;text-align:center;line-height:20px">
                <p>Chào mừng bạn đến với tính năng cung cấp thông tin mật khẩu của i-web, bạn vui lòng điền thông tin </p>
            </div>
            <div class="wrap-input" style="margin-top:15px">

                <div class="row-input">

                    <input type="text" name="contract" placeholder="Số hợp đồng" />

                </div>

            </div>
            <div class="wrap-input text-center" style="margin-top:15px">

                <div class="row-input">

                    <div class="show-text" style="color:#fff"></div>

                </div>

            </div>
            <div class="wrap-input text-center" style="margin-top:15px">

                <div class="row-input">

                    <button id="submit-forget">Xác nhận</button>

                </div>

            </div>
            <div class="box-text" style="margin-top:15px;color:#fff;text-align:center;line-height:20px">
                <p>Để chúng tôi có thể cung cấp cho quý khách mật khẩu đã bị mất.</p>
                <p>Nếu gặp khó khăn gì trong quá trình cung cấp mật khẩu quý khách vui lòng liên hệ: </p>
                <p>
                    <a style="color:red;font-weight:bold" href="tel:02862717789" title="02862717789">Điện thoại:
                        028.6271.7789</a><br>
                    <a style="color:#0280cc;font-weight:bold" href="mailto:i-web@i-web.vn" title="i-web@i-web.vn">Email:
                        i-web@i-web.vn</a><br>
                    <a style="color:#1c9213;font-weight:bold" target="_blank" href="https://i-web.vn"
                        title="i-web.vn">Website: i-web.vn</a>
                </p>
            </div>
        </div>
    </section>
</main>
<style>
    section.forget-password {
        position: fixed;
        top: 0;
        right: -290px;
        width: 260px;
        background-color: #212529;
        height: 100vh;
        padding: 30px 10px;
        box-shadow: 2px 2px 7px #ccc;
        transition: all 0.4s ease-in-out;
    }

    section.forget-password.active {
        right: 0;
        transition: all 0.4s ease-in-out;
    }

    .text-center {
        text-align: center
    }

    .wrap-input .row-input input {

        border: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        height: 35px;
        line-height: 45px;
        width: 100%;
        padding: 0px 10px;
        box-sizing: border-box;
    }

    .wrap-input .row-input input::placeholder {
        font-size: 13px
    }

    .wrap-input .row-input button {
        border: 0;
        background-color: #1c9213;
        color: #fff;
        font-size: 14px;
        font-family: Arial, Helvetica, sans-serif;
        border-radius: 4px;
        text-transform: uppercase;
        font-weight: normal;
    }

    button.close {
        position: absolute;
        top: -30px;
        left: -10px;
        height: 30px;
        width: 30px;
        background-color: #e2b42e;
        color: #fff;
        opacity: 1;
        font-size: 16px;
        font-family: 'Arial';
    }

    .loading {

        opacity: 1 !important;

        position: relative;

        color: rgba(255, 255, 255, 0) !important;

        pointer-events: none !important;

    }

    .loading:after {

        animation: spin 500ms infinite linear;

        border: 2px solid #ccc;

        border-radius: 32px;

        border-right-color: transparent !important;

        border-top-color: transparent !important;

        content: "";

        display: block;

        height: 16px;

        top: 50%;

        margin-top: -8px;

        left: 50%;

        margin-left: -8px;

        position: absolute;

        width: 16px;

    }

    @keyframes spin {

        0% {

            transform: rotate(0deg)
        }

        100% {

            transform: rotate(360deg)
        }

    }
</style>
<script>
    $(function() {

        $('#forget-pass').click(function() {
            $('section.forget-password').addClass('active');
        });
        $('button.close').click(function() {
            $('section.forget-password').removeClass('active');
        });

        $('#submit-forget').click(function() {
            let _this = $(this);
            let username = $('input[name="contract"]').val();
            let _flag = true;
            if (username == '') {
                alert('Bạn chưa nhập thông tin số hợp đồng hoặc email');
                _flag = false;
                return false;
            }
            if (_flag == true) {

                $.ajax({

                    url: 'ajax/forgetPassword.php',

                    type: 'post',

                    data: {
                        username: username
                    },

                    dataType: 'json',

                    beforeSend: function() {

                        _this.addClass('loading');

                    },

                    error: function() {
                        alert("Lỗi hệ thống");
                    },

                    success: function(res) {

                        if (res.status == 200) {

                            $('.show-text').html('Mật khẩu của quý khách là: <span style="font-weight:bold;color:#f00">' + res.password + '</span>');

                            $('input[name="contract"]').val('')
                        } else {

                            alert(res.message);

                        }

                    },
                    complete: function() {

                        _this.removeClass('loading');
                    }
                })

            }
        });
    })
</script>
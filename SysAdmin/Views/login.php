<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录界面</title>


    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">

    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main-body {top:60%;left:70%;position:absolute;-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%);overflow:hidden;}
        .login-main .login-bottom .center .item input {display:inline-block;width:227px;height:22px;padding:0;position:absolute;border:0;outline:0;font-size:14px;letter-spacing:0;}
        .login-main .login-bottom .center .item .icon-2 {background:url(../images/icon-login.png) no-repeat -54px 0;}
        .login-main .login-bottom .center .item .icon-3 {background:url(../images/icon-login.png) no-repeat -106px 0;}
        .login-main .login-bottom .center .item .icon-4 {background:url(../images/icon-login.png) no-repeat 0 -43px;position:absolute;right:-10px;cursor:pointer;}


        .login-main .login-bottom .center .item .icon {display:inline-block;width:33px;height:22px;}
        .login-main .login-bottom .center .item {width:288px;height:35px;border-bottom:1px solid #dae1e6;margin-bottom:35px;}
        .login-main {width:428px;position:relative;float:left;}
        .login-main .login-top {height:100px;background-color:#148be4;border-radius:12px 12px 0 0;font-family:SourceHanSansCN-Regular;font-size:30px;font-weight:400;font-stretch:normal;letter-spacing:0;color:#fff;line-height:117px;text-align:center;overflow:hidden;-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0);}
        .login-main .login-top .bg1 {display:inline-block;width:74px;height:74px;background:#fff;opacity:.1;border-radius:0 74px 0 0;position:absolute;left:0;top:43px;}
        .login-main .login-top .bg2 {display:inline-block;width:94px;height:94px;background:#fff;opacity:.1;border-radius:50%;position:absolute;right:-16px;top:-16px;}
        .login-main .login-bottom {width:428px;background:#fff;border-radius:0 0 12px 12px;padding-bottom:53px;}
        .login-main .login-bottom .center {width:288px;margin:0 auto;padding-top:40px;padding-bottom:15px;position:relative;}
        .login-main .login-bottom .tip {clear:both;height:16px;line-height:16px;width:288px;margin:0 auto;}
        body {background:url(<?=base_url('statics/img/navbg1.jpg')?>) 0% 0% / cover no-repeat;position:static;font-size:12px;}
        input::-webkit-input-placeholder {color:#a6aebf;}
        input::-moz-placeholder {/* Mozilla Firefox 19+ */            color:#a6aebf;}
        input:-moz-placeholder {/* Mozilla Firefox 4 to 18 */            color:#a6aebf;}
        input:-ms-input-placeholder {/* Internet Explorer 10-11 */            color:#a6aebf;}
        input:-webkit-autofill {/* 取消Chrome记住密码的背景颜色 */            -webkit-box-shadow:0 0 0 1000px white inset !important;}
        html {height:100%;}
        .login-main .login-bottom .login-btn {width:288px;height:40px;background-color:#1E9FFF;border-radius:16px;margin:24px auto 0;text-align:center;line-height:40px;color:#fff;font-size:14px;letter-spacing:0;cursor:pointer;border:none;}
        .login-main .login-bottom .center .item .validateImg {display: inline-block;position:absolute;right:1px;cursor:pointer;height:36px;line-height: 35px; padding-left: 20px; font-size: 24px;}
        .footer {left:0;bottom:0;color:#fff;width:100%;position:absolute;text-align:center;line-height:30px;padding-bottom:10px;text-shadow:#000 0.1em 0.1em 0.1em;font-size:14px;}
        .padding-5 {padding:5px !important;}
        .footer a,.footer span {color:#fff;}

        @media screen and (max-width:428px) {.login-main {width:360px !important;}
            .login-main .login-top {width:360px !important;}
            .login-main .login-bottom {width:360px !important;}
        }
    </style>
</head>
<body>
<div class="main-body">
    <div class="login-main">
        <div class="login-top">
            <span>登录
            </span>
            <span class="bg1"></span>
            <span class="bg2"></span>
        </div>
        <form class="layui-form login-bottom"  METHOD="POST">

            <div class="center">
                <div class="item">
                    <span class="icon icon-2"></span>
                    <input type="text" name="username" lay-verify="required|userName" autocomplete="off" placeholder="请输入登录账号" maxlength="24">
                </div>

                <div class="item">
                    <span class="icon icon-3"></span>
                    <input type="password" name="pwd" lay-verify="required|pass"  placeholder="请输入密码" maxlength="20">
                    <span class="bind-password icon icon-4"></span>
                </div>

<!--                <div class="item" style="width: 180px;">-->
<!--                    <span class="icon icon-2"></span>-->
<!--                    <input type="text" name="captcha" lay-verify="required|captcha" placeholder="请输入验证码" maxlength="4">-->
<!---->
<!--                        <div id="refreshCaptcha" class="validateImg" onclick="zylVerCode()"></div>-->
<!---->
<!--                </div>-->

            </div>
            <div class="layui-form-item" style="text-align:center; width:100%;height:100%;margin:0px;">
                <button class="login-btn"   lay-submit="" lay-filter="login">立即登录1qaz2wsx</button>
<!--                <button class="layui-btn" lay-submit="" lay-filter="login">立即提交<button>-->

<!--                <button class="login-btn" lay-filter="login" type="button" lay-submit="" >立即登录</button>-->
            </div>
        </form>
    </div>
</div>
<div class="footer">
    © 2024<?=(date("Y")=="2024")?'':"-".date("Y")?> 技术支持：X维云途
<!--    <span class="padding-5">|</span>-->
<!--    <a target="_blank" href="https://beian.miit.gov.cn/">蜀ICP备000000000号</a>-->
</div>

<!-- Layui Js -->
<script src="<?=base_url('statics/plugins/layuimini/lib/jquery-3.4.1/jquery-3.4.1.min.js')?>"></script>
<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>
<script src="<?=base_url('statics/login/js/zylVerificationCode.js')?>"></script>
<script src="<?=base_url('statics/login/js/jsencrypt.min.js')?>"></script>

<!-- Layui Js -->


<script>

    layui.use(['jquery','form'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            form = layui.form;
        var publicKey = `MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDCHSuCLh9eCrzyahNgoU9bXP0FGyiJVBtgjRRK97Mv8G1ePlcv0TIwjA1i+axWEht5JoKlhNsBWd+3e+oFtENCRwtEWhOVqAdLJqv3C958RH+BH4W0OQ+UBx7SUj+v/tRpRXSbIb0dsPkU+hyGOhUaE7YbNJv1zHGk70NhHr+L1wIDAQAB`;

        //自定义验证规则
        form.verify({
            userName: function(value){
                if(value.length < 5){
                    return '账号至少得5个字符';
                }
            },
            pass: function(value) {
                if (!value) return; // 若值未填写，不进行后续规则验证
                    // 自定义规则
                if (!/^[\S]{6,16}$/.test(value)) {
                    return '密码必须为 6 到 16 位的非空字符';
                }
            }
            ,captcha: function(value){
                //获取验证码
                var zylVerCode = $("#refreshCaptcha").html();
                if(value!=zylVerCode){
                    return '验证码错误（区分大小写）';
                }
            }
        });
        //监听提交
        form.on('submit(login)', function (data) {
            // layer.alert(JSON.stringify(data.field),{
            //     title: '最终的提交信息'
            // })
            var crypt = new JSEncrypt();
            crypt.setPublicKey(publicKey);
            $('input[name="pwd"]').val(crypt.encrypt(data.field.pwd));
            // return false;
        });

        login_msg='<?=isset($login_msg)?$login_msg:''?>';
        if (login_msg){
            layer.alert(login_msg);
        }

        // 登录过期的时候，跳出ifram框架
        if (top.location != self.location) top.location = self.location;
    });

</script>
</body>
</html>


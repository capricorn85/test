<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>
    </title>


    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
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
        .layui-col-xs6{
            text-align:center;
        }
        .logo{
            text-align:center;
        }
        .navimg img{
            width:120px;
        }
        .logo img{
            max-width:100%;
            max-height:180px;
            margin-top:5%;
        }
        footer{
            position:fixed;
            bottom:2px;
            width:100%;
        }

        footer p{
            text-align:center;
        }
        .layui-container{
            margin-top:8%;
        }
        header{
            /*border-bottom:2px solid #01467C;*/

        }

    </style>
</head>
<body>
<header>
    <div class="logo">
        <img  src="<?=base_url('statics/yjs/img/logo.png')?>">
    </div>
</header>
<div class="layui-container">
    <div class="main-body">
        <ul  class="layui-row">
            <li class="layui-col-xs6" >
                <a class="navimg" href="<?=base_url('yjs/cate/gzq')?>" >
                   <img  src="<?=base_url('statics/yjs/img/gzq.png')?>">
                </a>
            </li>
            <li class="layui-col-xs6" >
                <a class="navimg" href="<?=base_url('yjs/cate/kbcyd')?>" >
                    <img src="<?=base_url('statics/yjs/img/kbcyd.png')?>">
                </a>
            </li>
            <li class="layui-col-xs6" >
                <a class="navimg" href="<?=base_url('yjs/cate/qybg')?>" >
                    <img src="<?=base_url('statics/yjs/img/qybg.png')?>">
                </a>
            </li>
            <li class="layui-col-xs6" >
                <a class="navimg"href="<?=base_url('yjs/cate/qyqy')?>" >
                    <img src="<?=base_url('statics/yjs/img/qyqy.png')?>">
                </a>
            </li>
            <li class="layui-col-xs6" >
                <a class="navimg" href="<?=base_url('yjs/cate/qyzx')?>" >
                    <img src="<?=base_url('statics/yjs/img/qyzx.png')?>">
                </a>
            </li>
            <li class="layui-col-xs6" >
                <a class="navimg" href="<?=base_url('yjs/cate/xy')?>" >
                    <img src="<?=base_url('statics/yjs/img/yx.png')?>">
                </a>
            </li>
        </ul>
    </div>
</div>


<footer>
    <p>一次告知、一表申请<br>一口受理、一网审批、一窗发证、一体管理</p>

</footer>

<!-- Layui Js -->
<script src="<?=base_url('statics/plugins/layuimini/lib/jquery-3.4.1/jquery-3.4.1.min.js')?>"></script>
<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>
<script src="<?=base_url('statics/login/js/zylVerificationCode.js')?>"></script>

<!-- Layui Js -->


<script>

    layui.use(['jquery','form'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            form = layui.form;

        //自定义验证规则
        form.verify({
            userName: function(value){
                if(value.length < 5){
                    return '账号至少得5个字符';
                }
            }
            ,pass: [/^[\S]{6,12}$/,'密码必须6到12位，且不能出现空格']
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


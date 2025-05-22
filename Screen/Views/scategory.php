<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>四川省(德阳)知识产权公共服务平台</title>
    <meta name="keywords" content="四川省(德阳)知识产权公共服务平台">
    <meta name="description" content="四川省(德阳)知识产权公共服务平台">
    <link rel="shortcut icon" href="<?=base_url("/favicon.ico")?>" type="image/x-icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/globali.css?v=1.0')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/default.css?v=1.1')?>">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .a-detail p{
            font-size:29px;
            line-height: 2;
        }
        .a-detail img{
            max-width: 100%;
        }
    </style>
</head>
<body>
<header>
    <div class="logo-box">
        <div class="logo"><h3>
                <a href="<?=site_url()?>">
                    <img src="<?=base_url('asset/img/logo.png')?>" ></a>
                <span>四川省(德阳)知识产权公共服务平台</span></h3>
        </div>
    </div>

</header>
<main>

    <div class="container" id="container">
        <div class="bread-nav">
            <a href="<?=site_url('screen')?>">首页</a>>>
            <a> <?=preg_replace("/<br\s*\/?>/i","",$catlist['cat_name'])?></a>
        </div>
        <div class="list-box">

            <div class="clearfix"></div>
            <div class="a-content  clearfix">
                <H3 class="clD8"><?=preg_replace("/<br\s*\/?>/i","",$catlist['cat_name'])?></H3>
                <div class="a-detail c-scroll">
                    <?php if(isset($catlist['content'])):?>
                        <?=$catlist['content']?>
                    <?php endif;?>

                </div>
            </div>
        </div>


    </div>
</main>
<footer class="alist-footer">
    <ul class="op-btn clearfix">
        <li class="box-slice gradEE_EA"><a href="<?=site_url('screen')?>">返回首页</a></li>
        <li class="box-slice gradEE_EA"><a onclick="javascript:history.go(-1);">返回上级</a></li>
        <li class="box-slice gradEE_EA" id="up"><a>向上浏览</a></li>
        <li class="box-slice gradEE_EA"id="down"><a>向下浏览</a></li>
    </ul>
<!--    <img src="--><?//=base_url('asset/img/BottomDang.png')?><!--">-->

</footer>

<script src="<?=base_url('asset/js/jquery.min.js')?>"></script>
<script src="<?=base_url('asset/js/js.js')?>"></script>
<script>
    $(function(){
        $("#down").click(function(){
            scrollDU(100,".c-scroll",1);
        });
        $("#up").click(function(){
            scrollDU(100,".c-scroll",0);
        });


    })
</script>


</body>
</html>




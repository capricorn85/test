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
        .scaling {
            animation: marquee 2s linear infinite;
        }
        .scaling:hover {
            animation-play-state: paused
        }
        /*.scaling :after{*/
        /*    content: attr(data-text);*/
        /*    margin-left: 4em;*/
        /*}*/
        /* Make it move */
        @keyframes marquee {
            0%    { font-size: 28px; }
            50%   {font-size: 34px; }
            100%  { font-size: 28px;}
    </style>
</head>
<body>
<main>
    <div class="guide-box">

        <div class="guide-header">
            <img src="<?=base_url('asset/img/logo.png')?>" >
            <h3>四川省(德阳)</h3>
            <h2> 知识产权公共服务平台</h2>
        </div>


    <div class="guide_text  clearfix">
        <p class="box-50 scaling fl"><a href="<?=site_url('screen/navHomejg')?>">点击进入<span>机构导航</span></a></p>
        <p class="box-50 scaling fl"><a href="<?=site_url('screen/navHomebs')?>">点击进入<span>办事指南</span></a></p>
    </div>
    <div class="guide-logo-bottom clearfix">
        <p class="arrow"> <img src="asset/img/dylogo.png"></p>

    </div>
    </div>
</main>




<script src="<?=base_url('asset/js/jquery.min.js')?>"></script>
<script>

</script>
</body>
</html>
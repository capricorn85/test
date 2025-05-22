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
        .marquee {
            width: 800px;
            margin: 0 auto;
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
            animation: marquee 40s linear infinite;
        }
        .marquee:hover {
            animation-play-state: paused
        }
        .marquee :after{
            content: attr(data-text);
            margin-left: 4em;
        }
        /* Make it move */
        @keyframes marquee {
            0%   { text-indent: 27.5em }
            100% { text-indent: -55em }
        }
        .nav-text .arrow img{
            width:80px;

        }

        .rotat {
            animation: marquee2 3s linear infinite;
        }
        .rotat:hover {
            animation-play-state: paused
        }
        /*.scaling :after{*/
        /*    content: attr(data-text);*/
        /*    margin-left: 4em;*/
        /*}*/
        /* Make it move */
        @keyframes marquee2 {
            0%    { transform:rotate(0deg); }
            50%   {transform:rotate(180deg); }
            100%  { transform:rotate(360deg);}}
        .scalearrow{
            animation: marquee3 3s linear infinite;
        }
        .scalearrow:hover {
            animation-play-state: paused
        }
        @keyframes marquee3 {
            0%    { transform:scale(0.8); }
            50%    { transform:scale(1.2); }
            100%   { transform:scale(0.8); }
        }
    </style>
</head>
<body>
<header>
    <div class="logo-box">
        <div class="logo"><h3>
                <a href="<?=site_url('screen')?>">
                <img src="<?=base_url('asset/img/logo.png')?>" ></a>
                <span>四川省(德阳)知识产权公共服务平台</span></h3>
        </div>
    </div>
</header>

<main>

    <div class="nav-container">
        <div class="nav-text ">
<!--            <p>欢迎进入触摸查询系统</p>-->
            <p>请点击下面的栏目进行自助查询</p>
            <p class="arrow"> <img src="<?=base_url('asset/img/compass.png')?>" class="rotat"></p>
        </div>
        <div class="nav-box white clearfix">
            <ul>
                <?php foreach ($cat_list as $row):?>

                        <li class="box-slice box-12">
                            <a href="<?=site_url('screen/Category/'.$row['column_ab'].'_'.$row['id'])?>" title="<?=$row['cat_name']?>">
                                <img src="<?=base_url($row['thumb'])?>">


                               </a>
                            </a>
                        </li>

                <?php endforeach;?>
            </ul>
        </div>
        <div class="nav-arrow lf"> <a href="<?=site_url()?>"><img src="<?=base_url('asset/img/arrow_lf.png')?>" class="scalearrow"></a></div>
        <div class="nav-arrow rt"> <a href="<?=site_url('navHomejg')?>"><img src="<?=base_url('asset/img/arrow_rt.png')?>" class="scalearrow"></a></div>

    </div>
</main>

<footer class="index-footer">
<!--    <a class="fl backindex">首页 </a>-->
    <p class="marquee">欢迎来到四川省(德阳)知识产权公共服务平台!</p>
    <span id="time-txt"></span>
<!--    <img src="--><?//=base_url('asset/img/BottomDang.png')?><!--">-->
</footer>


<script src="<?=base_url('asset/js/jquery.min.js')?>"></script>
<script>
    $(function(){
        CurrentTime();
        self.setInterval(function () { CurrentTime() }, 1000);
    })
    function  CurrentTime() {
        var myDate = new Date();
        //获取当前年份
        var year = myDate.getFullYear();
        //获取当前月份
        var month = myDate.getMonth() + 1;
        //获取当前日期
        var date = myDate.getDate();
        //获取当前小时数(0-23)
        var h = myDate.getHours();
        //获取当前分钟数(0-59)
        var m = myDate.getMinutes();
        //获取当前秒数(0-59)
        var s = myDate.getSeconds();
        //拼接时间
        var now = year + '年' + getNow(month) + "月" + getNow(date) + "日" + getNow(h) + ':' + getNow(m) + ":" + getNow(s);
        //绑定时间
        $("#time-txt").text(now);
    }
    //获取时间判断位数，是否在字段前拼接0（time小于10时在字段前拼接0）
    function getNow(Mytime) { return Mytime < 10 ? '0' + Mytime : Mytime; }
</script>
</body>
</html>
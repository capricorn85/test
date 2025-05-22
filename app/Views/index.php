<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>主网站-首页</title>


    <link rel="stylesheet" type="text/css" href="<?=base_url('statics/layui/css/layui.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/global.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/index.css')?>">
    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<header >

    <div class="layui-container">
        <!--    顶部logo区-->
        <div class="layui-clear top">
            <div class="search-box fr ">
                <form action="search.html" method="get">
                    <div class="fl"><input class="search-input" placeholder="请输入搜索关键字" type="text" value="" name="key" id="search"></div>
                    <div class="fr"><input class="search-btn" type="submit" value=""></div>
                </form>
            </div>
            <img border="0" src="<?= (isset($swiper_list['llist']) && array_key_exists('href', $swiper_list['llist'])) ? $swiper_list['llist']['href'] : "assets/img/logo.jpg" ?>">
        </div>
        <!--    顶部logo区完-->
    </div>
    <!--    顶部导航开始-->


    <div class="nav_banner"><img src="assets/img/slide3.jpg"></div>
    <nav class="layui-container">


        <ul class="layui-nav bg_15499a mt-neg-45">
            <?php foreach ($cat_list as $k=>$row):?>
                <li  class="layui-nav-item">
                    <?php $link_url=($row['n_type']==5?$row['link_url']:base_url('cate/'.$row['id']))?>

                    <?php if(isset($row['child'])): ?>
                        <a href="#"><?=$row['label']?></a>
                        <ul class="layui-nav-child">
                            <?php foreach($row['child'] as $row2): ?>
                                <?php $link_url=($row2['n_type']==5?$row2['link_url']:base_url('cate/'.$row2['id']))?>
                                <li><a href="<?=$link_url?>" target="<?=$row2['target']?>"><?=$row2['label']?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else:?>
                        <a href="<?=$link_url?>" target="<?=$row['target']?>"><?=$row['label']?></a>
                    <?php endif;?>
                </li>
            <?php endforeach;?>
        </ul>
    </nav>
    <!--    顶部导航结束-->
</header>
<main >
    <div class="layui-container">
        <div class="m_title">
            <span>产业专利数据库</span>
        </div>
        <div class="image-container" >
            <!-- Banner -->
            <div class="banner"></div>

            <!-- 图片区域 -->
            <div class="image-wrapper">
                <div class="image-item">
                    <img src="assets/img/dzjs.png" alt="图片1">
                    <span>电子技术</span>
                </div>
                <div class="image-item">
                    <img src="assets/img/qjny.png" alt="图片2">
                    <span>清洁能源</span>
                </div>
                <div class="image-item">
                    <img src="assets/img/gdzbzz.png" alt="图片3">
                    <span>高端装备制造</span>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-container">
        <div class="m_title">
            <span>德阳经开区知识产权服务指南</span>
        </div>
        <div class="layui-row zn_module">
            <div class="layui-col-md3 bg_3155ab m_describ">
                <div class="b_title">专利
                    <br>PATENT
                </div>
                <p class="f_bold">专利申请</p>
                <p>专利业务办理系统</p>
                <p>办事指南</p>
                <p>预审管理平台预审案件提交系统</p>
                <p class="f_bold">PCT国际申请</p>
                <p>专利合作条约 （(PCT) 专栏</p>
                <p class="f_bold">信息查询</p>
                <p>专利代理机构查询</p>
                <p>专利检索与分析</p>
                <p>中国专利公布公告</p>
            </div>
            <div class="layui-col-md3 layui-bg-blue m_describ">
                <div class="b_title">商标
                    <br>TRADEMARK
                </div>
                <p class="f_bold">商标申请</p>
                <p>网上申请</p>
                <p>申请指南</p>
                <p class="f_bold">马德里申请</p>
                <p>申请指南</p>
                <p class="f_bold">信息查询</p>
                <p>商标查询</p>
                <p>欧盟商标查询系统</p>
                <p>商标代理机构查询</p>
                <p>商标公告</p>
            </div>
            <div class="layui-col-md3 ">
                <div class="bg_15499a m_describ">
                    <div class="b_title">版权
                        <br>COPYRIGHT
                    </div>
                    <p>国家版权登记门户网</p>
                    <p class="pb-19">全国作品登记信息公示查询</p>
                </div>
                <div class="bg_3535dd m_describ">
                    <div class="b_title">地理标志
                        <p>GEOGRAPHICAL INDICATION</p>
                    </div>
                    <p>地理商标申请网</p>
                    <p>全国作品登记信息公示查询</p>
                    <p class="pb-19">地理标志检索及分析</p>
                </div>
            </div>
            <div class="layui-col-md3">
                <div class="layui-bg-blue m_describ">
                    <div class="b_title">集成电路
                        <p>INTEGRATED CIRCUIT LAYOUT</p>
                    </div>
                    <p>集成电路布图设计电子申请平台</p>
                    <p>集成电路布图设计公告</p>
                    <p class="pb-7">办事指南</p>
                </div>
                <div class="bg_43cf7c m_describ">
                    <div class="b_title">知识产权综合服务
                        <p class="e_sm">Integrated intellectual property services</p>
                    </div>
                    <p>国家知识产权公共服务网</p>
                    <p class="pb-49">知识产权数据资源公共服务系统</p>
                </div>
            </div>
        </div>

    </div>

    <div class="t_center flink-box layui-clear bgee">
        <div class="m_title">
            <span>德阳经开区知识产权服务指南</span>
        </div>
        <div class="layui-container">
            <ul class="layui-row layui-col-space28 ">
                <li class="layui-col-sm4 ">
                    <img src="assets/img/gjzscqzx.png">
                </li>
                <li class="layui-col-sm4">
                    <img src="assets/img/scszscqpx.png">
                </li>
                <li class="layui-col-sm4">
                    <img src="assets/img/cszscq.png">
                </li>
            </ul>
        </div>
    </div>
    <!--        产教融合开始-->

    <!--        产教融合完-->

    <!--友情链接开始-->

    <!--友情链接结束-->
</main>
<footer>
    <div class="layui-container t_center layui-clear">
        <div>
            <p>Copyright © <?=date('Y')?>   德阳市市场监督管理局经开区分局	. All Rights Reserved </p>
            <p>地址：四川省德阳市族阳区城南街道珠江西路187号二重市场本部邮编：618000</p>
            <p  class="foot_link">友情链接：<a>国家知识产权局四川首市场监管局（省知识产权局）</a>
                <a>国家知识产权公共服务网</a>
                <a>德阳市知识产信息服务平台</a></p>


        </div>
    </div>
</footer>

<script src="<?=base_url('statics/layui/layui.js')?>"></script>


<script src="<?=base_url('assets/js/jquery1.42.min.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.SuperSlide.2.1.3.js')?>"></script>
<!--导航菜单下拉菜单js START-->
<script>
    layui.use(['jquery', 'layer', 'miniAdmin'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            miniAdmin = layui.miniAdmin;

        $(".nav li").hover(
            function() {
                $(this).addClass("selected");
                $(this).find("ul").show(100);
            },
            function() {
                $(this).removeClass("selected");
                $(this).find("ul").hide(300);
            }
        );
    }

</script>
<!--导航菜单下拉菜单js END-->

<!--顶部幻灯片js START-->
<script>
    jQuery(".fullSlide").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"leftLoop", vis:"auto", autoPlay:true, autoPage:true, trigger:"click" });
</script>
<!--顶部幻灯片js END-->

</body>
</html>
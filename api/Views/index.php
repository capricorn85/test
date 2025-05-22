<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>主网站-首页</title>

    <link href="assets/css/global.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/default.css')?>">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<header class="clearfix">
    <div class="top-nav bge3 clearfix">
        <div class="container">
            <div class="fl">
                <span>四川省商贸学校 欢迎您！</span>
            </div>
            <div class="fr">
                <span><a>教务平台</a></span>
                <span><a>校区位置</a></span>
                <!--        <span><a>领导邮箱</a></span>-->
            </div>

        </div>
    </div>

    <!--    顶部logo区-->
    <div class="top container">
        <div class="logo ">
            <div class="search-box fr ">
                <form action="search.html" method="get">
                    <div class="fl"><input class="search-input" placeholder="请输入搜索关键字" type="text" value="" name="key" id="search"></div>
                    <div class="fr"><input class="search-btn" type="submit" value=""></div>
                </form>
            </div>
            <img border="0" src="assets/img/logo.jpg">
        </div>
    </div>
    <!--    顶部logo区完-->

    <!--    顶部导航开始-->
    <nav class="navbar bg85 clearfix">
        <ul class="nav container white">
            <li class="active"><a href="index.html">网站首页 </a></li>
            <li><a href="#">校情总览</a>
                <ul>
                    <li><a href="list.html">学校简介</a></li>
                    <li><a href="list.html">新年寄语</a></li>
                    <li><a href="list.html">学校沿革</a></li>
                    <li><a href="list.html">历任领导</a></li>
                    <li><a href="list.html">现任领导</a></li>
                    <li><a href="list.html">组织机构</a></li>
                    <li><a href="list.html">统计资料</a></li>
                </ul>
            </li>
            <li><a href="#">党群建设</a>
                <ul>
                    <li><a href="list.html">党建之窗</a></li>
                    <li><a href="list.html">职工之家</a></li>
                    <li><a href="list.html">团旗飘扬</a></li>
                </ul>
            </li>
            <li><a href="">系部设置</a>
                <ul>
                    <li><a href="list.html">财会金融系</a></li>
                    <li><a href="list.html">商务与艺术系</a></li>
                    <li><a href="list.html">航空旅游系</a></li>
                    <li><a href="list.html">电子机械系</a></li>
                    <li><a href="list.html">基础与升学部</a></li>
                </ul>
            </li>
            <li><a href="#">教学动态</a>
                <ul>
                    <li><a href="list.html">专业建设</a></li>
                    <li><a href="list.html">诊改工作</a></li>
                </ul>
            </li>
            <li><a href="#">招生就业</a>
                <ul>
                    <li><a href="list.html">招生信息网</a></li>
                    <li><a href="list.html">就业信息网</a></li>
                </ul>
            </li>
            <li><a href="#">学生工作</a>
                <ul>
                    <li><a href="list.html">学工在线</a></li>
                    <li><a href="list.html">安全保障</a></li>
                    <li><a href="list.html">学生资助</a></li>
                </ul>
            </li>
            <li><a href="#">科学研究</a>
                <ul>
                    <li><a href="list.html">学术期刊</a></li>
                    <li><a href="list.html">科研项目</a></li>
                    <li><a href="list.html">科研成果</a></li>
                </ul>
            </li>
            <li><a href="#">产教融合</a>
                <ul>
                    <li><a href="list.html">电商研究所</a></li>
                    <li><a href="list.html">农产品电商孵化园</a></li>
                    <li><a href="list.html">农村电子商务协会</a></li>
                    <li><a href="list.html">合作经济研究中心</a></li>
                    <li><a href="list.html">乡村振兴战略研究中心</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!--    顶部导航结束-->

    <!--    顶部幻灯片开始-->
    <div class="fullSlide ">
        <div class="bd">
            <ul>
                <li><a href="#"><img src="assets/img/slide1.jpg"></a></li>
                <li><a href="#"><img src="assets/img/slide2.jpg"></a></li>
                <li><a href="#"><img src="assets/img/slide1.jpg"></a></li>
                <li><a href="#"><img src="assets/img/slide2.jpg"></a></li>

            </ul>
        </div>
        <div class="hd"><ul></ul></div>
        <a class="prev" href="javascript:void(0)"></a>
        <a class="next" href="javascript:void(0)"></a>
    </div>
    <!--    顶部幻灯片结束-->
</header>
<main>
    <!--焦点新闻开始-->
    <div class="focusnews  bgee">
        <div class="container clearfix">
            <!--       焦点新闻左图片新闻 -->
            <div class="tcolumn_title">
                <i class="iconfont">&#xe661;</i> <span>焦点新闻</span><span style="color: #15499a;padding: 0 10px">|</span>
                <a class="focus-more" href="list.html" title="VIEW MORE">VIEW MORE</a>
            </div>
            <div class=" focus-content">
                <div class="focus-left">
                    <div class="inner">
                        <div class="pic">
                            <div class="img" style="background-image:url(assets/img/list.jpg);">
                                <a target="_blank" href="https://news.pku.edu.cn/xwzh/6c6e7a5b0bc24285824d912953d45707.htm"></a>
                            </div>
                        </div>
                        <div class="text">
                            <a target="_blank" href="https://news.pku.edu.cn/xwzh/6c6e7a5b0bc24285824d912953d45707.htm">
                                <div class="h text-overflow">“好久不见，欢迎回家”——我们返校了</div>
                                <div class="date" style="display:none;"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--       焦点新闻右列表新闻 -->
                <div class=" focus-right">
                    <ul>
                        <li >
                            <div class="pic ptime clearfix">
                                <p class="year">2020-07</p>
                                <p class="date">01</p>
                            </div>
                            <div class="focus-txt text-overflow">焦点新闻右列表新闻2焦点新闻右列表焦点新闻右列表新闻2焦点新闻右列表新闻新闻1</div>
                        </li>
                        <li>
                            <div class="pic ptime">
                                <p class="year">2020-07</p>
                                <p class="date">01</p>
                            </div>
                            <div class="focus-txt text-overflow">焦点新闻右列表新闻2</div>
                        </li>

                        <li> <div class="pic ptime">
                            <p class="year">2020-07</p>
                            <p class="date">01</p>
                        </div>
                            <div class="focus-txt text-overflow">焦点新闻右列表新闻3</div>
                        </li>
                        <li> <div class="pic ptime">
                            <p class="year">2020-07</p>
                            <p class="date">01</p>
                        </div>
                            <div class="focus-txt text-overflow">焦点新闻右列表新闻4</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--焦点新闻完-->

    <!--通知公告并行栏目开始-->
    <div class="twins-tab-box  clearfix">
        <div class="container">
            <div class="twins-tab fl">
                <div class="sub-title clearfix">
                    <dl>
                        <dd> <h3 class="fl"> <i class="iconfont" style="font-size: 2em">&#xe63d;</i> <span>通知公告</span></h3><span class="more" ><a>more</a></span></dd>
                    </dl>
                </div>
                <div class="notice-list clearfix">
                    <ul>
                        <li class="clearfix"><a class="text-overflow">这是第一条公告
                            <span class="list_time">2020-07-01</span>
                        </a></li>
                        <li class="clearfix"><a class="text-overflow">这是第一条公告
                            <span class="list_time">2020-07-01</span>
                        </a></li>
                        <li class="clearfix"><a class="text-overflow">这是第一这是第一条公告这是第一条公告这是第一条公告这是第一条公告这是第一条公告这是第一条公告这是第一条公告条公告
                            <span class="list_time">2020-07-01</span>
                        </a>
                        </li>
                        <li class="clearfix"><a class="text-overflow">这是第这是第一条公告一条公告
                            <span class="list_time">2020-07-01</span>
                        </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="twins-tab fr">
                <div class="sub-title clearfix">
                    <dl>
                        <dd> <h3 class="fl"> <i class="iconfont" style="font-size: 2em">&#xe610;</i><span>通知公告</span></h3><span class="more"><a>more</a></span></dd>
                    </dl>
                </div>
                <div class="notice-list clearfix">
                    <ul>
                        <li class="clearfix"><a class="text-overflow">这是第一条公告
                            <span class="list_time">2020-07-01</span>
                        </a></li>
                        <li class="clearfix"><a class="text-overflow">这是第一条公告
                            <span class="list_time">2020-07-01</span>
                        </a></li>
                        <li class="clearfix"><a class="text-overflow">这是第一这是第一条公告这是第一条公告这是第一条公告这是第一条公告这是第一条公告这是第一条公告这是第一条公告条公告
                            <span class="list_time">2020-07-01</span>
                        </a>
                        </li>
                        <li class="clearfix"><a class="text-overflow">这是第这是第一条公告一条公告
                            <span class="list_time">2020-07-01</span>
                        </a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
    <!--通知公告并行栏目结束-->

    <!--        产教融合开始-->
    <div class="science  bgee clearfix">
        <div class="container  clearfix">
            <div class="tcolumn_title">
                <i class="iconfont">&#xe60a;</i> <span>产教融合</span>
            </div>
            <div class="science-content">
                <ul>
                    <li style=""><span>电商研究所</span><a>
                        <p class="ellipsis3">
                            四川省农村电子商务研究所始建于2014 年，是经四川省供销社批准，依托四川省商贸学校现有资源，立足四川省供销系统、联合省内外农村电商专家、优质涉农电商企业共同组成的农村电子商务科研机构。
                        </p>
                    </a>
                        <div class="square_more"><a href="list.html" title=""></a><div class="clear"></div></div>
                    </li>
                    <li class="acolor"><a><span>农产品电商孵化园</span>
                        <p class="ellipsis3">
                            农产品电子商务孵化园始建于2014年，在四川省供销合作社联合社、四川省商贸学校大力支持下创建，是深化教学改革、产教深度融合的综合创服平台，园区以“创新创业、产教融合、立足行业、服务地方”为宗旨，为全省小微涉农企业和农民专合社提供电子商务孵化服务，为人驻企业提供政策资源、智库资源、资本资源等创业资源，为在校电子商务专业学生提供电子商务实战岗位和电子商务创新创业的场所和园地。
                        </p>
                    </a>
                        <div class="square_more"><a href="list.html" title=""></a><div class="clear"></div></div>
                    </li>
                    <li><a><span>农村电子商务协会</span>
                        <p class="ellipsis3">
                            四川省农村电子商务协会始建于2015年，是省供销社、省民政厅批准，四川省商贸学校牵头成立的面向全省非盈利性协会，以遵守国家法律、法规和政策，发扬社会主义道德风尚，推动本省农村电子商务行业的健康发展为宗旨，依法开展电子商务知识普及、技术学术交流、技能培训、咨询服务等。现有会员单位156个，协会会员遍及全省20个市州96个县市区。
                        </p>
                    </a>
                        <div class="square_more"><a href="list.html" title=""></a><div class="clear"></div></div>
                    </li>
                    <li class="acolor"><a><span>合作经济研究中心</span>
                        <p class="ellipsis3">
                            合作经济研究中心以“传承和弘扬合作经济文化、传播合作经济知识、培育合作经济研究成果、服务区域经济社会”为宗旨，本着“经济为体、管理为用、互助为本、合作为源、三农为根、实践为要”的理念，在合作经济、合作金融、现代农业服务体系、合作社治理、农产品品牌建设、供销社产业发展、供销社企业运行等领域开展科学研究。
                        </p>
                    </a>
                        <div class="square_more"><a href="list.html" title=""></a><div class="clear"></div></div>
                    </li>
                    <li ><a><span>乡村振兴战略研究中心</span>
                        <p class="ellipsis3">
                            乡村振兴战略研究中心将聚焦和服务四川乡村振兴战略，对新时代的乡村振兴发展进行理论和实践层面的研究，围绕现代农业产业体系、生产体系、经营体系、服务体系，一二三产业融合发展、乡村旅游、特色小镇建设、城乡融合与减贫、乡村治理、农村人才队伍建设方略等方面开展研究与实践。
                        </p>
                    </a>
                        <div class="square_more"><a href="list.html" title=""></a><div class="clear"></div></div>
                    </li>
                    <li  class="acolor"><a class="focus-more" href="list.html" title="VIEW MORE">>>VIEW MORE</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--        产教融合完-->

    <!--友情链接开始-->
    <div class="flink-box">
        <div class="container clearfix">
            <div class="tcolumn_title">
                <i class="iconfont">&#xe662;</i> <span>友情链接</span>
            </div>
            <div class="foot-nav  clearfix">
                    <div class="flink"><a href="" target="_blank"><div class="title">四川合作经济网</div></a></div>
                    <div class="flink"><a href="" target="_blank"><div class="title">四川教育网</div></a></div>
                    <div class="flink"><a href="" target="_blank"><div class="title">四川省教育考试院</div></a></div>
                    <div class="flink"><a href="" target="_blank"><div class="title">中国民航飞行学院</div></a></div>
                    <div class="flink"><a href="" target="_blank"><div class="title">中国职业技术教育网</div></a></div>
                    <div class="flink"><a href="" target="_blank"><div class="title">四川省贸易学校</div></a></div>
            </div>
        </div>
    </div>
    <!--友情链接结束-->
</main>
<footer>
    <div class="container clearfix">
        <div class="footer-l fl ">
            <div  class="fl">
                <img src="assets/img/blue.png">
            </div>
            <div class="f-msg fr clearfix">
                <p>Copyright © 2018 四川省商贸学校. All Rights Reserved </p>
                <p>四川省德阳市千山街399号 邮编：618000 服务热线：0838-2559031</p>
            </div>
        </div>
        <div class="footer-r fr">
            <p><i class="iconfont">&#xe74e;</i>备案号：蜀ICP备07000348号</p>
        </div>
    </div>
</footer>

<script src="<?=base_url('assets/js/jquery1.42.min.js')?>"></script>

<script src="<?=base_url('assets/js/jquery.SuperSlide.2.1.3.js')?>"></script>
<!--导航菜单下拉菜单js START-->
<script>
    $(function() {
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
    });
</script>
<!--导航菜单下拉菜单js END-->

<!--顶部幻灯片js START-->
<script>
    jQuery(".fullSlide").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"leftLoop", vis:"auto", autoPlay:true, autoPage:true, trigger:"click" });
</script>
<!--顶部幻灯片js END-->

</body>
</html>
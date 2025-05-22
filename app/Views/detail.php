<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>主网站-详情</title>
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


  <!--    顶部logo区完-->
  <!--    顶部导航开始-->
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
                <img border="0" src="<?= base_url((isset($swiper_list['llist']) && array_key_exists('href', $swiper_list['llist'])) ? $swiper_list['llist']['href'] : "assets/img/logo.jpg" )?>">
            </div>
            <!--    顶部logo区完-->
        </div>
        <!--    顶部导航开始-->
        <div class="nav_banner"><img src="<?=base_url('assets/img/slide3.jpg')?>"></div>
        <nav class="layui-container">
            <ul class="layui-nav bg_15499a mt-neg-45">
                <?php $c_nav=[];?>
                <?php foreach ($cat_list as $k=>$row):?>
                    <li  class="layui-nav-item <?php if ($row['id']==($cur_cat)[0]['cid']):?>layui-this<?php endif;?>">
                        <?php $link_url=($row['n_type']==5?$row['link_url']:base_url('cate/'.$row['id']))?>
                        <?php if(isset($row['child'])): ?>
                            <a href="#"><?=$row['label']?></a>
                            <?php ($row['id']==($cur_cat)[0]['cid'])?$c_nav=$row['child']:'';?>
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
  <!--    顶部图片banner开始-->

  <!--    顶部图片banner结束-->
</header>
<main>
  <div class="list-p clearfix">
    <div class="l-sub-nav container clearfix">
      <div class="nav-detail clearfix">
        <!--<span class="fl">机构新闻</span>-->
        <div class="breadnav">
            <i class="layui-icon layui-icon-home"></i>


                <a href="<?=base_url()?>">首页</a>
                <?php foreach ($cur_cat as $k=>$v):?>
                    ><a href="<?=($v['cid']===$c_cat['cid'])?base_url('cate/'.$v['cid']):'#'?>"> <?=$v['label']?></a>
                <?php endforeach;?>
                >正文
        </div>
      </div>
    </div>
    <div class=" container clearfix">
      <div class="bgff list-box-r">
        <div class="article">
          <div class="article-title">
            <h1><?=$article['article_title']?></h1>
            <p class="c85">
              来源：<span><?=$article['author']?></span>   发布日期：<span><?=date('Y-m-d', strtotime($article['atime']))?></span>
            </p>
          </div>
          <div class="article-detail">
              <?=$article['content']?>

          </div>
        </div>

      </div>
    </div>
  </div>
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

</body>
</html>
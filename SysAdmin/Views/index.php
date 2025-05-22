<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>德阳经开区智慧监管</title>


    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/layuimini.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/css/themes/default.css')?>">
    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/font-awesome-4.7.0/css/font-awesome.min.css')?>">
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style id="layuimini-bg-color">
    </style>
    <style>
        .layui-nav-tree .layui-nav-item>a .layui-nav-more {
            padding: 0;
        }
        .layuimini-menu-left .layui-nav .layui-nav-more {
            top: 50%;
        }
        .layui-nav-child{
        left: -10%}

    </style>
</head>
<body class="layui-layout-body layuimini-all">
<div class="layui-layout layui-layout-admin">

    <div class="layui-header header">
        <div class="layui-logo layuimini-logo"></div>

        <div class="layuimini-header-content">
            <a>
                <div class="layuimini-tool"><i title="展开" class="fa fa-outdent" data-side-fold="1"></i></div>
            </a>

            <!--电脑端头部菜单-->
            <ul class="layui-nav layui-layout-left layuimini-header-menu layuimini-menu-header-pc layuimini-pc-show">
            </ul>

            <!--手机端头部菜单-->
            <ul class="layui-nav layui-layout-left layuimini-header-menu layuimini-mobile-show">
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="fa fa-list-ul"></i> 选择模块</a>
                    <dl class="layui-nav-child layuimini-menu-header-mobile">
                    </dl>
                </li>
            </ul>

            <ul class="layui-nav layui-layout-right">

                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;" data-refresh="刷新"><i class="fa fa-refresh"></i></a>
                </li>
           
                <li class="layui-nav-item mobile layui-hide-xs" lay-unselect>
                    <a href="javascript:;" data-check-screen="full"><i class="fa fa-arrows-alt"></i></a>
                </li>
<!--                <li class="layui-nav-item" lay-unselect style="color: #888;">-->
<!--                    --><?php //=$_SESSION['admin']['username']?>
<!--                </li>-->

                <li class="layui-nav-item layuimini-setting" style="color: #888;">

                    <a href="javascript:;"> <?=$_SESSION['admin']['username']?> </a>

                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" layuimini-content-href="<?=site_url('xccmssys/pwdReset')?>" data-title="修改密码" data-icon="fa fa-gears">修改密码</a>
                        </dd>
                        <dd>
                            <hr>
                        </dd>
                        <dd>
                            <a href="javascript:;" class="login-out">退出登录</a>
                        </dd>
                    </dl>
                </li>

                <li><span>&nbsp;</span></li>
<!--                <li class="layui-nav-item layuimini-select-bgcolor" lay-unselect>-->
<!--                    <a href="javascript:;" data-bgcolor="配色方案"><i class="fa fa-ellipsis-v"></i></a>-->
<!--                </li>-->
            </ul>
        </div>
    </div>

    <!--无限极左侧菜单-->
    <div class="layui-side layui-bg-black layuimini-menu-left">


    </div>
<!--<div style="position: fixed;width: 100%;bottom: 0;text-align: center;line-height:30px ;z-index: 9999;">-->
<!--     <a target="_blank" href="https://beian.miit.gov.cn/" style="color: #333;cursor: default;">蜀ICP备19032763号-6</a>-->
<!--</div>-->
    <!--初始化加载层-->
    <div class="layuimini-loader">
        <div class="layuimini-loader-inner"></div>
    </div>

    <!--手机端遮罩层-->
    <div class="layuimini-make"></div>

    <!-- 移动导航 -->
    <div class="layuimini-site-mobile"><i class="layui-icon"></i></div>

    <div class="layui-body">

        <div class="layuimini-tab layui-tab-rollTool layui-tab" lay-filter="layuiminiTab" lay-allowclose="true">
            <ul class="layui-tab-title">
                <li class="layui-this" id="layuiminiHomeTabId" lay-id=""></li>
            </ul>
            <div class="layui-tab-control">
                <li class="layuimini-tab-roll-left layui-icon layui-icon-left"></li>
                <li class="layuimini-tab-roll-right layui-icon layui-icon-right"></li>
                <li class="layui-tab-tool layui-icon layui-icon-down">
                    <ul class="layui-nav close-box">
                        <li class="layui-nav-item">
                            <a href="javascript:;"><span class="layui-nav-more"></span></a>
                            <dl class="layui-nav-child">
                                <dd><a href="javascript:;" layuimini-tab-close="current">关 闭 当 前</a></dd>
                                <dd><a href="javascript:;" layuimini-tab-close="other">关 闭 其 他</a></dd>
                                <dd><a href="javascript:;" layuimini-tab-close="all">关 闭 全 部</a></dd>
                            </dl>
                        </li>
                    </ul>
                </li>
            </div>
            <div class="layui-tab-content">
                <div id="layuiminiHomeTabIframe" class="layui-tab-item layui-show"></div>
            </div>
        </div>

    </div>
</div>
<script src="<?=base_url('statics/plugins/layuimini/lib/jquery-3.4.1/jquery-3.4.1.min.js')?>"></script>

<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>
<script src="<?=base_url('statics/plugins/layuimini/js/lay-config.js')?>"></script>


<script>
    layui.use(['jquery', 'layer', 'miniAdmin'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            miniAdmin = layui.miniAdmin;

        var options = {
            iniUrl: "<?=site_url('xccmssys/getSystemInit')?>",    // 初始化接口
            clearUrl: "<?=base_url('statics/plugins/layuimini/api/clear.json')?>", // 缓存清理接口
            urlHashLocation: false,      // 是否打开hash定位
            bgColorDefault: false,      // 主题默认配置
            multiModule: true,          // 是否开启多模块
            menuChildOpen: false,       // 是否默认展开菜单
            loadingTime: 0,             // 初始化加载时间
            pageAnim: true,             // iframe窗口动画
            maxTabNum: 20,              // 最大的tab打开数量
        };
        miniAdmin.render(options);




        $('.login-out').on("click", function () {
            layer.msg('退出登录成功'
                , {
                    icon: 1,
                    time:500 //1秒关闭（如果不配置，默认是3秒）
                }
                ,function () {
                window.location = "<?=base_url('login/logout')?>";
            });
        });
    });
</script>
</body>
</html>


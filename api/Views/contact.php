<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>联系我们</title>
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
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #e8b627;
        }

        .layui-container {
            padding: 0;
        }

        .img-container {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .img-container img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        footer {
            position: fixed;
            bottom: 5px;
            right: 5px;
            z-index: 1000;
        }

        footer a {
            display: block;
            box-shadow: 0 0 10px #fff;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
        }

        footer a img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="layui-container">
        <div class="main-body">
            <ul class="img-container">
                <li>
                    <img src="<?=base_url('statics/yjs/material/link.jpg')?>" alt="联系方式">
                </li>
            </ul>
        </div>
    </div>

    <footer>
        <a href="<?=base_url('yjs/cate')?>">
            <img src="<?=base_url('statics/yjs/material/back.png')?>" alt="返回">
        </a>
    </footer>

    <script src="<?=base_url('statics/plugins/layuimini/lib/jquery-3.4.1/jquery-3.4.1.min.js')?>"></script>
    <script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>
    <script>
    layui.use(['jquery'], function() {
        const $ = layui.jquery;
        
        // 防抖函数
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        // 更新footer图标大小
        const updateFooterIcon = debounce(() => {
            const scale = 1 / (window.visualViewport?.scale || 1);
            $('footer a').css({
                'transform': `scale(${scale})`,
                'transform-origin': 'bottom right'
            });
        }, 100);

        // 初始化
        updateFooterIcon();

        // 事件监听
        if (window.visualViewport) {
            window.visualViewport.addEventListener('resize', updateFooterIcon);
            window.visualViewport.addEventListener('scroll', updateFooterIcon);
        } else {
            window.addEventListener('resize', updateFooterIcon);
        }
    });
    </script>
</body>
</html>


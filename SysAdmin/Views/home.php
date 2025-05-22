<!DOCTYPE html >
<html >

<head>
	<title>首页</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	    <link rel="stylesheet" href="<?=base_url('statics/plugins/layuimini/lib/layui/css/layui.css')?>">

	<style type="text/css">
		*{
			margin:0;
			padding:0;
		}
		body{
			background: #fafafa;
			font-family: "微软雅黑", "Microsoft YaHei" , "宋体", "SimSun", Tahoma, Verdana, sans-serif;
			/*min-width:800px;*/

		}
		h3 span{
			color:#fc8213;}
		.top{
			background: white;
			margin:2%;
			padding:15px 20px 20px;
			line-height: 40px;
			box-shadow: 0px 0px 2px 1px rgba(0,0,0,0.15);
		}

		h3{
			margin: 2%;
			font-size: 16px;
			color: #595757;
		}
		.top_title{
			font-size: 20px;
			margin-bottom: 20px;
		}
		.top_title span{
			margin-left: 1%;
		}

		.top_title img{
			width: 25px;
			vertical-align: middle;
			margin-bottom: 2px;
		}
		.top_content{
			background: #f5f5f5;
			border: 1px #e3e3e3 solid;
			text-indent: 2em;
			line-height: 1.5em;
			font-size: 14px;
			padding: 15px 10px;
			box-shadow: 0px 0px 1px 1px rgba(0,0,0,0.05);
		}
        .top_content_img{
            background: #f5f5f5;
            border: 1px #e3e3e3 solid;
            line-height: 1.5em;
            font-size: 14px;

            box-shadow: 0px 0px 1px 1px rgba(0,0,0,0.05);
        }
        .layui-tab-content{
        	text-align: center;
        }
        .layui-tab-content img{
        	max-width: 100%;
        }
		.clear{clea15px 10r:both;}
		.fa{
			color:#7266ba;
		}
	.layui-carousel	.title{
		position: absolute;
		top: 5px;
		left: 5px;
	}

	</style>

</head>
<body>
<div class="top">
	<p class="top_title"><i class="fa fa-laptop"></i><span>系统简介</span></p>
	<p class="top_content">
		欢迎来到“X维云途CMS"管理系统后台。为快速使用系统，建议阅读用户手册与首页流程示意。
	</p>
</div>

<div class="clear"></div>
<div class="top">
    <p class="top_title"><i class="fa fa-laptop"></i><span>流程示意</span></p>
    	<div class="layui-tab layui-tab-card">
  <ul class="layui-tab-title">
    <li class="layui-this">模块1</li>
     <li class="layui-this">模块2</li>
  </ul>
  <div class="layui-tab-content" style="margin:0;padding: 0;">
    <div class="layui-tab-item layui-show">
<!--     <img src="--><?php //=base_url('statics/img/diagram/canyin.png')?><!--" layer-src="--><?php //=base_url('statics/img/diagram/canyin1.png')?><!--">-->
    </div>
     <div class="layui-tab-item">
<!--     <img src="--><?php //=base_url('statics/img/diagram/yaodian.png')?><!--" layer-src="--><?php //=base_url('statics/img/diagram/canyin1.png')?><!--">-->
    </div>
  </div>
</div>
   

      
    
</div>

<!-- 全局js -->
<script src="<?=base_url('statics/plugins/layuimini/lib/layui/layui.js')?>"></script>

<!-- 自定义js -->
<script type="text/javascript">
	 // 轮播图
    layui.use(['jquery', 'layer','carousel'], function () {
        var layer = layui.layer,
        carousel = layui.carousel;
        ins=carousel.render({
            elem: '#timg',
            width: '100%', //设置容器宽度
            height: '440',
            arrow: 'always', //始终显示箭头
            indicator: 'none',
            //,anim: 'updown' //切换动画方式
        });
        layer.photos({
            photos: '#timg'
            ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
        });
    });
</script>
</body>
</html>

